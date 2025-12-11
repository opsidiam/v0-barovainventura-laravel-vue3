<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Stocktake\Models\Stocktake;

class CheckStocktake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-stocktake';

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
        $stocktakes = Stocktake::with('scan_history')->where('expire', '<', now())->get();

        $stocktakes->each(function($stocktake) {
            $stocktake->scan_history()->delete();

            $stocktake->delete();
        });

        $this->info('Deleted '.$stocktakes->count().' expired stocktakes and their related scans.');
    }
}
