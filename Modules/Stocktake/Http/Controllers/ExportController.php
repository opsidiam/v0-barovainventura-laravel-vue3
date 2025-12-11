<?php

namespace Modules\Stocktake\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Stocktake\Services\ExportService;

class ExportController extends Controller
{
    public function export(ExportService $exportService, $id, $type)
    {
        switch ($type) {
            case 'pdf':
                return $exportService->exportPdf($id);
            case 'excel':
                return $exportService->exportExcel($id);
            case 'csv':
                return $exportService->exportCsv($id);
            default:
                throw new \InvalidArgumentException("Nepodporovaný typ exportu: $type");
        }
    }
}
