<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Modules\Cargo\Models\Cargo;

class GenerateEanXmlFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-ean-xml-feed';

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
        $eans = Cargo::query()
            ->whereNotNull('ean')
            ->pluck('ean')
            ->map(fn ($v) => trim((string)$v))
            ->filter(fn ($v) => $v !== '')
            ->unique()
            ->values();

        if ($eans->isEmpty()) {
            $this->warn('Žiadne EANy neboli nájdené.');
            return self::SUCCESS;
        }

        // 2) Vyrenderuj Blade šablónu
        $xml = view('xml.ean-feed', ['eans' => $eans])->render();

        // 3) Cieľová cesta v public/
        $path = public_path('ean-feed.xml');

        // 4) Zapíš do súboru
        file_put_contents($path, $xml);

        $this->info("XML feed uložený do: {$path}");
        return self::SUCCESS;
    }
}
