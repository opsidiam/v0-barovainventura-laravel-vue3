<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\License\Emails\SendActivationLicenseEmail;
use Modules\Stocktake\Emails\StocktakePdfMail;
use Modules\Stocktake\Models\Stocktake;
use Modules\Stocktake\Services\ExportService;

class SendStocktakeToMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-stocktake-to-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posiela inventúrne PDF na e-mail';

    /**
     * Execute the console command.
     */
    public function handle(ExportService $exportService)
    {
        $stocktakes = Stocktake::where('send_mail', 1)
            ->where('ready', 1)->get();
        if ($stocktakes->isEmpty()) {
            $this->info('Žiadne inventúry na odoslanie.');
            return;
        }

        foreach ($stocktakes as $stocktake) {
            try {
                $pdfContent = $exportService->exportPdfToMail($stocktake->id);
                $filename = $stocktake->name_formated . '.pdf';

                $user = $stocktake->user;
                $recipient = $this->getRecipient($user);
                Mail::to($recipient['email'])->send(
                    new StocktakePdfMail(
                        subject: 'Inventúra - PDF export',
                        recipient: $recipient,
                        content: $stocktake,
                        pdfContent: $pdfContent,
                        filename: $filename
                    )
                );

                $stocktake->send_mail = 0;
                $stocktake->save();

                $this->info('Inventúra č. ' . $stocktake->id . ' bola odoslaná na ' . $recipient['email']);
                Log::channel('success')->info('Inventúra odoslaná: ' . $stocktake->id);

            } catch (\Exception $e) {
                Log::error('Chyba pri odosielaní inventúry ' . $stocktake->id . ': ' . $e->getMessage());
                $this->error('Chyba pri odosielaní inventúry ' . $stocktake->id);
            }
        }
    }

    private function getRecipient($user)
    {
        return [
            'email' => $user->email_info_verify == 3 ? $user->email_info : $user->email,
            'name' => $user->name . ' ' . $user->surname
        ];
    }
}
