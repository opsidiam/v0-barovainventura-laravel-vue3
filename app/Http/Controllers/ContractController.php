<?php

namespace App\Http\Controllers;

use App\Models\SmsNotifications;
use App\Models\User;
use App\Models\UserFile;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Modules\Admin\Emails\DeviceContractMail;
use Modules\Admin\Emails\DeviceContractPdfMail;
use Modules\Admin\Models\ContractForm;

class ContractController extends Controller
{
    public function contract($hash)
    {
        $data['contract'] = ContractForm::where('hash', $hash)->first();
        return view('web.contract.contractForm',$data);
    }

    public function requestContract($hash)
    {
        $user = User::find(base64_decode($hash));
        if(ContractForm::where('user_id', $user->id)->exists()){
            return view('web.contract-false');
        }
        $recipient = $this->getRecipient($user);
        $hash = base64_encode(time());
        $content = [
            'user' => $user,
            'hash' => $hash
        ];
        ContractForm::create([
            'user_id' => $user->id,
            'hash' => $hash
        ]);
        Mail::to($recipient['email'])->send(
            new DeviceContractMail(
                subject: 'Potvrdenie výpožičky: Dokončite formulár',
                recipient: $recipient,
                content: $content
            )
        );

        return view('web.contract-true');
    }

    public function contractFormPost(Request $request)
    {
        $data = $request->validate([
            'hash'              => ['required','string','max:191'],
            'company'           => ['nullable','string','max:191'],
            'name'              => ['required','string','max:191'],
            'surname'           => ['required','string','max:191'],
            'date_ico'          => ['nullable','string','max:191'],
            'address'           => ['required','string','max:255'],
            'city'           => ['required','string','max:191'],
            'postal'           => ['required','string','max:50'],
            'country'           => ['required','string','max:191'],
            'phone'             => ['nullable','string','max:50'],

            'delivery_name'     => ['required','string','max:191'],
            'delivery_address'  => ['required','string','max:255'],
            'delivery_city'     => ['required','string','max:191'],
            'delivery_postal'   => ['required','string','max:50'],
            'delivery_country'  => ['required','string','max:191'],
            'delivery_phone'    => ['nullable','string','max:50'],

            'vop'               => ['accepted'],
        ]);
        $data['param1'] = 30;
        $contractForm = ContractForm::where('hash', request()->hash)->first();
        if(!$contractForm->name){
            $payload = Arr::only($data, [
                'company','name','surname','date_ico','address','city','postal','country','phone',
                'delivery_name','delivery_address','delivery_city','delivery_postal','delivery_country','delivery_phone',
            ]);
            $contractForm->update($payload);
            $contract = $this->generateContractWeight($contractForm,'contract_default',$data);
            $contractForm->file_id = $contract['file_id'];
            $contractForm->save();
            $user = User::find($contractForm->user_id);
            $content = [
                'user' => $user,
                'hash' => $contractForm->hash
            ];

            $recipient = $this->getRecipient($user);
            Mail::to($recipient['email'])->send(
                new DeviceContractPdfMail(
                    subject: 'Zmluva o výpožičke',
                    recipient: $recipient,
                    content: $content,
                    attachmentDisk: 'public',
                    attachmentPath: $contract['path'],
                    attachmentName: $contract['name']
                )
            );
            return redirect()->route('contract',['hash' => $contractForm->hash])->with('success', 'Formulár bol úspešne uložený.');
        }
        return redirect()->route('contract',['hash' => $contractForm->hash]);
    }

    public function contractDownload($hash)
    {
        $contract = ContractForm::where('hash', $hash)->first();
        $file = UserFile::find($contract->file_id);
        return Storage::disk($file->disk)->download($file->path, $file->original_name);
    }

    public function contractUploadFormPost(Request $request)
    {
        $data = $request->validate([
            'hash'     => ['required', 'string'],
            'signed_contract' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
        ]);
        $contractForm = ContractForm::where('hash', $data['hash'])->firstOrFail();
        $user = User::findOrFail($contractForm->user_id);

        $disk = 'public';
        $dir  = "contracts/{$user->id}";
        Storage::disk($disk)->makeDirectory($dir);

        $files = $request->file('signed_contract');
        if (!is_array($files)) {
            $files = [$files];
        }

        $createdFileIds = [];
        foreach ($files as $file) {
            if (!$file) continue;

            $title    = 'Signed contract';
            $baseName = Str::slug($title.'-'.now()->format('Ymd-His')).'-'.Str::lower(Str::random(4));
            $ext      = strtolower($file->getClientOriginalExtension() ?: 'pdf');
            $final    = "{$baseName}.{$ext}";
            $relPath  = "{$dir}/{$final}";

            $file->storeAs($dir, $final, $disk);

            $size = Storage::disk($disk)->size($relPath);
            $mime = $file->getClientMimeType() ?: 'application/octet-stream';

            if (method_exists($user, 'files')) {
                $uf = $user->files()->create([
                    'original_name' => $final,
                    'disk'          => $disk,
                    'path'          => $relPath,
                    'mime'          => $mime,
                    'type'          => 'contract-weight',
                    'size'          => $size,
                    'label'         => 'Signed contract',
                    'notes'         => null,
                    'uploaded_by'   => auth()->id(),
                ]);
                $createdFileIds[] = $uf->id;
            }
        }

        $contractForm->update(['signed' => true]);

        $phones = Arr::wrap(config('app.phones'));

        $normalizeName = function ($first, $last) {
            $s = trim(($first ?? '') . ' ' . ($last ?? ''));
            if ($s === '') return '';
            if (function_exists('transliterator_transliterate')) {
                return transliterator_transliterate('Any-Latin; Latin-ASCII', $s);
            }
            if (function_exists('iconv')) {
                $t = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s);
                if ($t !== false) return $t;
            }
            return $s;
        };

        $message = 'Bola nahrana zmluva na BarovaInventura.sk%0A' .
            $normalizeName($user->name ?? '', $user->surname ?? '');

        foreach ($phones as $phone) {
            if (!is_string($phone) || trim($phone) === '') continue;

            rescue(
                function () use ($phone, $user, $message) {
                    SmsNotifications::create([
                        'phone'      => $phone,
                        'user_id'    => $user->id,
                        'send_allow' => 1,
                        'message'    => $message,
                    ]);
                },
                function (\Throwable $e) use ($phone, $user) {
                    Log::warning('Zlyhalo vytvorenie SMS notifikácie', [
                        'phone'   => $phone,
                        'user_id' => $user->id,
                        'error'   => $e->getMessage(),
                    ]);
                    return null;
                }
            );
        }
        return back()->with(
            'success',
            'Podpísaná zmluva bola úspešne nahraná. Súborov: ' . count($createdFileIds)
        );
    }


    private function generateContractWeight($contractForm, string $templateKey, array $params = [], ?string $fileName = null): array
    {
        $user = User::find($contractForm->user_id);
        $templates = config('contracts.templates', []);
        abort_unless(isset($templates[$templateKey]), 404, 'Unknown contract template.');

        $viewName = $templates[$templateKey]['source'] ?? null;
        abort_unless(is_string($viewName) && View::exists($viewName), 404, 'Template view not set or not found.');

        $title = $templates[$templateKey]['name'] ?? 'Contract';

        $data = array_merge((array) $params, [
            'user' => $user,
            'now'  => Carbon::now('Europe/Bratislava')->format('d.m.Y'),
            'title'=> $title,
            'logo_path' => 'https://web-place.sk/public/new/images/Dark.png',
            'signature_lender_path' => public_path('img/webplace_sign.png'),
        ]);

        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'dpi'                  => 96,
            'chroot'               => public_path(),
            'defaultFont'          => 'DejaVu Sans',
        ])
            ->loadView($viewName, $data)
            ->setPaper('a4', 'portrait');

        $binary = $pdf->output();

        $baseName = $fileName ?: Str::slug($title . '-' . now()->format('Ymd-His'));
        $final    = "{$baseName}.pdf";
        $disk     = 'public';
        $dir      = "contracts/{$user->id}";
        $relPath  = "{$dir}/{$final}";

        Storage::disk($disk)->makeDirectory($dir);
        Storage::disk($disk)->put($relPath, $binary);
        $file = null;

        if (method_exists($user, 'files')) {
            $file = $user->files()->create([
                'original_name' => $final,
                'disk'          => $disk,
                'path'          => $relPath,
                'mime'          => 'application/pdf',
                'type'          => 'contract-weight',
                'size'          => Storage::disk($disk)->size($relPath),
                'label'         => $params['label'] ?? 'Contract',
                'notes'         => $params['notes'] ?? null,
                'uploaded_by'   => auth()->id(),
            ]);
        }
        return [
            'file_id'=> $file->id ?? null,
            'disk'   => $disk,
            'path'   => $relPath,
            'type'   => 'contract-weight',
            'name'   => $final,
            'bytes'  => Storage::disk($disk)->size($relPath),
            'url'    => Storage::disk($disk)->url($relPath), // vyžaduje storage:link
            'title'  => $title,
        ];
    }

    private function getRecipient($user)
    {
        return [
            'email' => $user->email_info_verify == 3 ? $user->email_info : $user->email,
            'name' => $user->name . ' ' . $user->surname
        ];
    }
}
