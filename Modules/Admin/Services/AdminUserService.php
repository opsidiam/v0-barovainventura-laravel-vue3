<?php

namespace Modules\Admin\Services;

use App\Helpers\ApiInvoice;
use App\Helpers\Postal;
use App\Models\PostPackages;
use App\Models\User;
use App\Models\UserFile;
use Modules\Admin\Services\ApiInvoiceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Modules\Admin\Emails\DeviceContractMail;
use Modules\Admin\Http\Requests\StoreDeviceLoanRequest;
use Modules\Admin\Models\ContractForm;
use Modules\License\Models\License;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AdminUserService
{
    public function handle() {}

    public function resetLicence($id)
    {
        $user = User::find($id);
        $user->licence_expire = now();
        $user->save();
        return true;
    }

    public function assignLicence()
    {
        $request = request();

        $user = User::find($request->user);
        $licence = License::find($request->licence);

        $currentDate = now();
        $licenceDurationInSeconds = $licence->time;

        if ($user->licence_expire && $user->licence_expire->gt($currentDate)) {
            $newExpireDate = $user->licence_expire->copy()->addSeconds($licenceDurationInSeconds);
        } else {
            $newExpireDate = $currentDate->copy()->addSeconds($licenceDurationInSeconds);
        }

        try {
            $user->licence_expire = $newExpireDate;
            $user->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function destroy($id)
    {
        if (User::find($id)->exists()) {
            User::where('id',$id)->delete();
            return back()->with('message', __('admin.messagess.success.user-delete'));
        }
        return back()->with('message', __('admin.messagess.failure.user-delete'));
    }

    public function storeFile($user)
    {
        $request = request();

        $data = $request->validate([
            'file'  => ['required','file','max:10240'], // 10 MB; adjust
            'label' => ['nullable','string','max:100'],
            'notes' => ['nullable','string','max:2000'],
        ]);

        $file = $data['file'];
        $disk = 'public';
        $path = $file->store("user-files/{$user->id}", $disk);

        $mime = $file->getClientMimeType();
        $type = $this->humanFileType($file, $mime);

        $user->files()->create([
            'original_name' => $file->getClientOriginalName(),
            'disk'          => $disk,
            'path'          => $path,
            'mime'          => $type,
            'size'          => $file->getSize(),
            'label'         => $data['label'] ?? null,
            'notes'         => $data['notes'] ?? null,
            'uploaded_by'   => $request->user()->id,
        ]);

        return back()->with('status', __('File uploaded.'));
    }

    public function downloadFile($user, $file)
    {
        abort_unless($file->user_id === $user->id, 404);

        return Storage::disk($file->disk)->download($file->path, $file->original_name);
    }

    public function destroyFile($user, $file)
    {
        abort_unless($file->user_id === $user->id, 404);

        Storage::disk($file->disk)->delete($file->path);
        $file->delete();

        return back()->with('status', __('File deleted.'));
    }

    private function humanFileType($file, ?string $mime = null): string
    {
        $ext  = strtolower($file->getClientOriginalExtension() ?: '');
        $mime = $mime ?: $file->getClientMimeType();

        $map = [
            // dokumenty
            'pdf' => 'PDF',
            'doc' => 'WORD', 'docx' => 'WORD',
            'xls' => 'EXCEL','xlsx' => 'EXCEL','csv' => 'EXCEL',
            'ppt' => 'POWERPOINT','pptx' => 'POWERPOINT',
            'rtf' => 'TEXT','txt' => 'TEXT','md' => 'TEXT',

            // obrázky
            'jpg' => 'IMAGE','jpeg' => 'IMAGE','png' => 'IMAGE','gif' => 'IMAGE',
            'webp' => 'IMAGE','bmp' => 'IMAGE','tif' => 'IMAGE','tiff' => 'IMAGE','heic' => 'IMAGE',

            // dáta
            'json' => 'DATA','xml' => 'DATA','yaml' => 'DATA','yml' => 'DATA',

            // archívy
            'zip' => 'ARCHIVE','rar' => 'ARCHIVE','7z' => 'ARCHIVE','gz' => 'ARCHIVE','tar' => 'ARCHIVE',

            // audio/video (ak chceš rozlišovať)
            'mp3' => 'AUDIO','wav' => 'AUDIO','flac' => 'AUDIO','aac' => 'AUDIO','ogg' => 'AUDIO',
            'mp4' => 'VIDEO','mov' => 'VIDEO','avi' => 'VIDEO','mkv' => 'VIDEO','webm' => 'VIDEO',
        ];

        if (isset($map[$ext])) return $map[$ext];

        if ($mime) {
            $primary = strtoupper(Str::before($mime, '/'));
            if (in_array($primary, ['IMAGE','AUDIO','VIDEO','APPLICATION','TEXT'])) {
                return $primary === 'APPLICATION' ? 'FILE' : $primary;
            }
        }

        return $ext ? strtoupper($ext) : 'FILE';
    }

    /**
     * @param  User   $user
     * @param  string $templateKey   key from config('contracts.templates')
     * @param  array  $params        ['param1' => ..., 'param2' => ...]
     * @param  string|null $fileName optional custom file name
     * @return array                 ['path' => 'public-disk-path', 'name' => 'file.pdf']
     */
    private function generateContractWeight($user, string $templateKey, array $params = [], ?string $fileName = null): array
    {
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

        if (method_exists($user, 'files')) {
            $user->files()->create([
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
            'disk'   => $disk,
            'path'   => $relPath,
            'type'   => 'contract-weight',
            'name'   => $final,
            'bytes'  => Storage::disk($disk)->size($relPath),
            'url'    => Storage::disk($disk)->url($relPath), // vyžaduje storage:link
            'title'  => $title,
        ];
    }

    public function storeContracts($user)
    {
        $request = request();

        $data = $request->validate([
            'template' => ['required', 'string'], // must be in config whitelist
            'param1'   => ['required', 'string', 'max:255'],
            'label'    => ['nullable', 'string', 'max:100'],
            'notes'    => ['nullable', 'string', 'max:2000'],
        ]);

        $this->generateContractWeight($user, $data['template'], $data);

        return redirect()
            ->route('admin.users.show', $user)
            ->with('status', __('Contract generated and attached to user files.'));
    }

    public function storeDeviceLoan(User $user)
    {
        $data = request()->all();

        DB::transaction(function () use ($user, $data) {
            $user->device_loan_start_at     = $data['device_loan_start_at'];
            $user->device_loan_serial       = $data['device_loan_serial'] ?? '';
            $user->device_loan_days         = (int) $data['device_loan_days'];
            $user->device_loan_purchased_at = null;
            $user->device_loan_returned_at  = null;
            $user->save();
        });

        Log::info('[DeviceLoan] Stored', [
            'user_id' => $user->id,
            'start'   => (string) $user->device_loan_start_at,
            'serial'  => $user->device_loan_serial,
            'days'    => $user->device_loan_days,
        ]);

        return back()->with('status', 'Zápožičanie uložené.');
    }

    public function markDeviceLoanPurchased(User $user)
    {
        // aktívna zápožička?
        if (! $this->isActiveLoan($user)) {
            return back()->withErrors('Zápožička nie je aktívna alebo už bola ukončená.');
        }

        $user->device_loan_purchased_at = now();
        $user->save();

        Log::info('[DeviceLoan] Marked as purchased', ['user_id' => $user->id]);

        return back()->with('status', 'Zariadenie označené ako zakúpené.');
    }

    public function markDeviceLoanReturned(User $user)
    {
        if (! $this->isActiveLoan($user)) {
            return back()->withErrors('Zápožička nie je aktívna alebo už bola ukončená.');
        }

        $user->device_loan_returned_at = now();
        $user->save();

        Log::info('[DeviceLoan] Marked as returned', ['user_id' => $user->id]);

        return back()->with('status', 'Zariadenie označené ako vrátené.');
    }

    public function deviceLoanContract(User $user)
    {
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


        Log::channel('success')->info('Odoslany mail s linkom na zmluvu: ' . $user->id);
        return true;
    }

    public function createPostalSheet($user)
    {
        try {
            $contract = ContractForm::where('user_id', $user->id)->whereNotNull('file_id')->orderBy('id', 'desc')->first();

            if (!$contract) {
                $message = 'Pre používateľa ID: ' . $user->id . ' nebol nájdený žiadny hotový kontrakt';
                Log::error($message);
                return ['error' => $message];
            }

            $postal = new Postal();

            $sheet = $postal->createSheet();
            if (!$sheet || !isset($sheet->sheet)) {
                $message = 'Nepodarilo sa vytvoriť poštový sheet pre používateľa ID: ' . $user->id;
                Log::error($message);
                return ['error' => $message];
            }

            $postalPackages = PostPackages::create([
                'user_id' => $user->id,
                'sheet_id' => $sheet->sheet->id,
                'state' => $sheet->sheet->state,
                'status' => $sheet->status,
                'data' => json_encode($sheet),
            ]);

            if (!$postalPackages) {
                $message = 'Nepodarilo sa vytvoriť záznam PostPackages pre používateľa ID: ' . $user->id;
                Log::error($message);
                return ['error' => $message];
            }

            $invoiceService = new ApiService();
            $invoiceUser = $invoiceService->invoiceCheckIfExistUser(($contract->company ?? ($contract->name .' '.$contract->surname)), $user->email);

            if (!$invoiceUser) {
                $invoiceUser = $invoiceService->invoiceCreateUser($contract, $user);
            }

            $invoiceData = $invoiceService->invoiceStageCreate($invoiceUser);

            if ($invoiceData->status != 'success') {
                $message = 'Nepodarilo sa vytvoriť faktúru pre používateľa ID: ' . $user->id;
                Log::error($message);
                $postalPackages->delete();
                return ['error' => $message];
            }
            $invoiceSendEmail = $invoiceService->invoiceSendToMail($invoiceData->id, $user->email);

            if ($invoiceSendEmail->status != 'success') {
                $message = 'Nepodarilo sa odoslať faktúru pre používateľa ID: ' . $user->id;
                Log::error($message);
                $postalPackages->delete();
                return ['error' => $message];
            }

            $postalPackages->invoice_url = $invoiceData->file;

            $parcel = $postal->createParcel($postalPackages->sheet_id, $contract, $user->email, $invoiceData->variable_symbol);
            if (!$parcel || !isset($parcel->parcel)) {
                $message = 'Nepodarilo sa vytvoriť balík pre sheet ID: ' . $postalPackages->sheet_id;
                Log::error($message);
                $postalPackages->delete();
                return ['error' => $message];
            }

            $postalPackages->parcel_id = $parcel->parcel->id;
            $postalPackages->status = $parcel->status;
            $postalPackages->parcel_number = $parcel->parcel->parcel_number;
            $postalPackages->data = json_encode($parcel);

            if (!$postalPackages->save()) {
                $message = 'Nepodarilo sa aktualizovať PostPackages s údajmi balíka ID: ' . $postalPackages->id;
                Log::error($message);
                $postalPackages->delete();
                return ['error' => $message];
            }

            $label = $postal->createLabel($postalPackages->sheet_id, $postalPackages->parcel_id);
            if (!$label || !isset($label->labels)) {
                $message = 'Nepodarilo sa vytvoriť štítok pre balík ID: ' . $postalPackages->parcel_id;
                Log::error($message);
                $postalPackages->delete();
                return ['error' => $message];
            }

            $postalPackages->status = $label->status;
            $postalPackages->label_url = $label->labels->url;

            if (!$postalPackages->save()) {
                $message = 'Nepodarilo sa uložiť URL štítku pre balík ID: ' . $postalPackages->parcel_id;
                Log::error($message);
                $postalPackages->delete();
                return ['error' => $message];
            }

            $message = 'Poštový sheet a štítok úspešne vytvorené pre používateľa ID: ' . $user->id;
            Log::info($message);
            return ['success' => $message];

        } catch (\Exception $e) {
            $message = 'Chyba pri vytváraní poštového sheetu pre používateľa ID: ' . $user->id . ': ' . $e->getMessage();
            Log::error($message);
            return ['error' => $message];
        }
    }

    protected function isActiveLoan(User $user): bool
    {
        return $user->device_loan_start_at
            && $user->device_loan_serial
            && $user->device_loan_days
            && is_null($user->device_loan_purchased_at)
            && is_null($user->device_loan_returned_at);
    }

    private function getRecipient($user)
    {
        return [
            'email' => $user->email_info_verify == 3 ? $user->email_info : $user->email,
            'name' => $user->name . ' ' . $user->surname
        ];
    }
}
