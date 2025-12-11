<?php

namespace Modules\Admin\Services;

use App\Models\User;
use Modules\Cargo\Models\Cargo;
use Modules\Stocktake\Models\Stocktake;
use Modules\User\Models\Support;

class AdminService
{
    public function handle() {}

    public function index()
    {
        $currentYear = date('Y');
        $months = range(1, 12);

        // Get counts for current year's inventures grouped by month
        $graf_inv_data = array_fill_keys($months, 0);
        Stocktake::query()
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get()
            ->each(function ($item) use (&$graf_inv_data) {
                $graf_inv_data[$item->month] = $item->count;
            });

        // Get counts for current year's users grouped by month
        $graf_usr_data = array_fill_keys($months, 0);
        User::query()
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get()
            ->each(function ($item) use (&$graf_usr_data) {
                $graf_usr_data[$item->month] = $item->count;
            });

        // Get other counts in single queries
        $productCounts = Cargo::selectRaw('SUM(original = 0) as success_count, SUM(original != 0) as nosuccess_count')
            ->first();

        return [
                'graf_inv_data' => $graf_inv_data,
                'graf_usr_data' => $graf_usr_data,
                'product_success_count' => $productCounts->success_count,
                'product_nosuccess_count' => $productCounts->nosuccess_count,
                'inv_count' => Stocktake::count(),
                'support_count' => Support::count(),
            ];
    }
}
