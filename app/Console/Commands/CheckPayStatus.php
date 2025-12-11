<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\License\Models\Order;
use Modules\License\Services\Api\ApiOrderService;
use Modules\License\Emails\SendActivationLicenseEmail;
use Modules\Notification\Models\Notification;
use function GuzzleHttp\json_decode;
use Illuminate\Support\Facades\DB;
use JsonException;

class CheckPayStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-pay-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Načítaj len relevantné stĺpce, šetrí pamäť
        $orders = Order::query()
            ->where('type', 'license')
            ->whereNull('payed')
            ->whereNotNull('pay_order_id')
            ->get(['id', 'user_id', 'data', 'pay_order_id', 'payed']);

        foreach ($orders as $order) {
            try {
                $payed = (new ApiOrderService())->payStatus($order->pay_order_id);
                if (! $payed) {
                    continue;
                }

                $user = User::find($order->user_id);
                if (! $user) {
                    throw new \RuntimeException('User not found for order');
                }

                try {
                    $data = json_decode($order->data ?? '{}', false, 512, JSON_THROW_ON_ERROR);
                } catch (JsonException $je) {
                    throw new \RuntimeException('Invalid order->data JSON', 0, $je);
                }

                $license = null;
                if (isset($data->license_custome)) {
                    $license = $data->license_custome;
                    $user->licence_bar_count = (int) ($license->count ?? 0);
                } elseif (isset($data->license)) {
                    $license = $data->license;
                    $user->licence_bar_count = 1;
                }

                if (! $license || ! isset($license->time) || ! is_numeric($license->time)) {
                    throw new \RuntimeException('Missing or invalid license time'.$license);
                }

                $seconds = (int) $license->time;

                DB::transaction(function () use ($user, $order, $seconds) {
                    if ($user->licence_expire && Carbon::parse($user->licence_expire)->greaterThan(now())) {
                        $user->licence_expire = Carbon::parse($user->licence_expire)->addSeconds($seconds);
                    } else {
                        $user->licence_expire = now()->addSeconds($seconds);
                    }

                    $user->save();

                    $order->payed = now();
                    $order->save();
                });

                $mailOk = false;
                try {
                    $mailOk = (bool) $this->sendMailChangeInfoMail($user);
                } catch (\Throwable $mailEx) {
                    Log::error('{Commands/CheckPayStatus} Email sending failed.', [
                        'user_id'  => $user->id,
                        'order_id' => $order->id,
                        'error'    => $mailEx->getMessage(),
                        'trace'    => $mailEx->getTraceAsString(),
                    ]);
                }

                $this->createNotification($user, $mailOk);

                Log::channel('success')->info('{Commands/CheckPayStatus} Activate license success.', [
                    'user_id'   => $user->id,
                    'user_mail' => $user->email,
                    'order_id'  => $order->id,
                    'expires'   => (string) $user->licence_expire,
                    'mail_sent' => $mailOk,
                ]);

            } catch (\Throwable $e) {
                Log::error('{Commands/CheckPayStatus} Activate license failed.', [
                    'order_id' => $order->id ?? null,
                    'user_id'  => $order->user_id ?? null,
                    'pay_order_id' => $order->pay_order_id ?? null,
                    'error'    => $e->getMessage(),
                    'exception'=> $e,
                ]);

                // (voliteľné) Ak chceš zabrániť nekonečnému cyklu,
                // môžeš tu pridať flag na objednávku, že zlyhala a netreba ju skúšať donekonečna.
                // $order->update(['failed_at' => now(), 'fail_reason' => Str::limit($e->getMessage(), 255)]);
            }
        }
    }

    private function createNotification(User $user, $state)
    {

        Notification::create([
            'type' => $state ? 'success' : 'error',
            'scope' => 'user',
            'message' => $state ? 'Licencia bola predĺžená do: <strong>'.$user->licence_expire->format("d.m.Y").'</strong>' : 'Nastala chyba počas predĺženia licencie. Prosím, kontaktujte podporu na info@barovainventura.sk.',
            'user_id' => $user->id,
            'bar_id' => null,
            'url' => null
        ]);
    }

    private function sendMailChangeInfoMail($user)
    {
        try {
            $recipient = $this->getRecipient($user);
            $email = new SendActivationLicenseEmail(
                subject: 'Aktivácia licencie',
                recipient: $recipient,
                content: ['user' => $user] ?? null,
            );

            $send = (bool)Mail::to($recipient['email'])->send($email);
            Log::channel('success')->info('{Commands/CheckPayStatus} Email sending success to:'. $recipient['email']);
            return $send;

        } catch (\Exception $e) {
            Log::error('{Commands/CheckPayStatus} Email sending failed: '.$e->getMessage());
            return false;
        }


    }
    private function getRecipient($user)
    {
        return [
            'email' => $user->email_info_verify == 3 ? $user->email_info : $user->email,
            'name' => $user->name.' '.$user->surname
        ];
    }
}
