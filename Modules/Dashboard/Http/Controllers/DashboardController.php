<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Cargo\Models\Cargo;
use Modules\Cargo\Models\CargoLastState;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barId = request()->session()->get('bar');
        $userId = auth()->id();

        $cargos = Cargo::orderBy('name')->get();
        $itemCount = CargoLastState::where('bar_id', $barId)->count();

        $items = $itemCount > 0
            ? DB::table('cargo_last_states')
                ->where('cargo_last_states.user_id', $userId)
                ->where('cargo_last_states.bar_id', $barId)
                ->leftJoin('cargos', 'cargo_last_states.cargo_id', '=', 'cargos.id')
                ->leftJoin('suppliers', 'cargo_last_states.supplier_id', '=', 'suppliers.id')
                ->select([
                    'cargo_last_states.id',
                    'cargo_last_states.cargo_id',
                    'cargo_last_states.supplier_id as suppliers_id',
                    'cargo_last_states.last_stocktake',
                    'cargo_last_states.weight_last_stocktake',
                    'cargo_last_states.full_pack_last_stocktake',
                    'cargo_last_states.weight_count',
                    'cargos.name',
                    'cargos.volume',
                    'cargos.alcohol',
                    'cargos.weight_full',
                    'cargos.weight_empty',
                    'cargos.ean',
                    DB::raw('IFNULL(suppliers.name_supplier, "Nepridelený") as name_supplier'), // Zmenené na name_supplier
                ])
                ->get()
                ->map(function ($item) {
                    // Ošetrenie nullable hodnôt
                    $item->last_stocktake = $item->last_stocktake ?? null;
                    $item->weight_last_stocktake = $item->weight_last_stocktake ?? null;
                    $item->weight_count = ($item->weight_count ?? 0) + ($item->volume * $item->full_pack_last_stocktake);
                    $item->weight_full = $item->weight_full ?? null;
                    $item->weight_empty = $item->weight_empty ?? null;
                    $item->ean = $item->ean ?? null;

                    return $item;
                })
            : [];
    $data = [
        'storage_item_count' => $itemCount,
        'cargos' => $cargos,
        'items' => $items,
    ];
        return view('dashboard::index', $data);
    }
}
