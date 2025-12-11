<?php

namespace Modules\Stocktake\Services;

use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Modules\Bar\Models\Bar;
use Modules\Stocktake\Models\ArchiveScan;
use Modules\Stocktake\Models\Stocktake;
use Modules\Stocktake\Models\StocktakeUser;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Stocktake\Exports\StocktakeExport;

class ExportService
{
    public function handle() {}

    public function exportPdf($id)
    {
        $data = $this->getInventoryData($id);
        $filename = $data['stocktake']->name_formated. '.pdf';
        $pdf = $this->generatePdf($data, $filename);

        return $pdf->download($filename);
    }

    public function exportPdfToMail($id)
    {
        $data = $this->getInventoryData($id);
        $filename = $data['stocktake']->name_formated. '.pdf';
        $pdf = $this->generatePdf($data, $filename);
        return $pdf->output();
    }

    private function generatePdf($data, $filename)
    {
        return PDF::loadView('stocktake::export.pdf', $data, [], [
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'title'         => $filename,
            'margin_top'    => 5,
            'margin_header' => 5,
            'margin_bottom' => 5,
            'default_font'  => 'dejavusans'
        ]);
    }

    public function exportExcel($id)
    {
        $data = $this->getInventoryData($id);
        $filename = $data['stocktake']->name_formated . '.xlsx';

        return Excel::download(
            new StocktakeExport($data['items'], $data['total_profit']),
            $filename
        );
    }

    public function exportCsv($id)
    {
        $data = $this->getInventoryData($id);
        $filename = $data['stocktake']->name_formated . '.csv';

        return Excel::download(
            new StocktakeExport($data['items'], $data['total_profit']),
            $filename,
            \Maatwebsite\Excel\Excel::CSV,
            [
                'Content-Type' => 'text/csv',
            ]
        );
    }

    private function calculateTopMargin($usersCount)
    {
        if ($usersCount == 0) return 80;
        if ($usersCount < 5) return 120;
        if ($usersCount < 9) return 140;
        return 140;
    }

    private function getInventoryData($id)
    {
        $users = StocktakeUser::where('stocktake_id', $id)->get();
        $stocktake = Stocktake::find($id);
        $mineUser = StocktakeUser::find($stocktake->mine_user);
        return [
            'bar'           => Bar::find($stocktake->bar_id),
            'stocktake'     => $stocktake,
            'users'         => $users,
            'users_count'   => $users->count(),
            'items'         => ArchiveScan::where('stocktake_id', $id)->get()->toArray(),
            'total_profit'   => $stocktake->total_profit,
            'mine_user'       => $mineUser->name . ' ' . $mineUser->surname
        ];
    }
}
