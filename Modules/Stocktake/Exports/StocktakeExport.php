<?php

namespace Modules\Stocktake\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StocktakeExport implements FromCollection, WithHeadings
{
    protected $items;
    protected $totalProfit;

    public function __construct($items, $totalProfit)
    {
        $this->items = $items;
        $this->totalProfit = $totalProfit;
    }

    public function collection()
    {
        $data = [];
        $total_stock_cost = 0;
        foreach ($this->items as $item) {
            $total_stock_cost = $total_stock_cost + $item['stocktake_data']['financial_data']['total_stock_cost'];
            $row = [
                'name' => $item['stocktake_data']['name'],
                'volume' => $item['stocktake_data']['type'] == 0 ?
                    number_format($item['stocktake_data']['volume'], 2) : '',
                'alcohol' => $item['stocktake_data']['type'] == 0 ?
                    number_format($item['stocktake_data']['alcohol'], 2) : '',
                'weight' => $item['stocktake_data']['show_in_grams'] || $item['stocktake_data']['type'] == 1 ?
                    number_format($item['stocktake_data']['weight'], 2) : '',
                'opened_bottle' => !$item['stocktake_data']['show_in_grams'] && $item['stocktake_data']['type'] == 0  ?
                    number_format($item['stocktake_data']['weight'], 2) : '',
                'full_packs' => number_format($item['stocktake_data']['full_packs'], 2),
                'current_volume' => $item['stocktake_data']['type'] == 0 ?
                    number_format(($item['stocktake_data']['weight'] +
                            ($item['stocktake_data']['volume'] * $item['stocktake_data']['full_packs'])) / 1000, 2) : '',
                'scanned_by' => $item['stocktake_data']['scanned_by'],
                'ean' => $item['stocktake_data']['ean'],
            ];

            if (isset($item['stocktake_data']['financial_data'])) {
                $row = array_merge($row, [
                    'total_cost' => number_format($item['stocktake_data']['financial_data']['total_cost'], 2),
                    'total_revenue' => number_format($item['stocktake_data']['financial_data']['total_revenue'], 2),
                    'total_profit' => number_format($item['stocktake_data']['financial_data']['total_profit'], 2),
                    'total_stock_price' => number_format($item['stocktake_data']['financial_data']['total_stock_cost'], 2),
                ]);
            } else {
                $row = array_merge($row, [
                    'total_cost' => '',
                    'total_revenue' => '',
                    'total_profit' => '',
                    'total_stock_price' => '',
                ]);
            }

            $data[] = $row;
        }

        // Add summary row
        $data[] = [
            'name' => 'Celková tržba',
            'volume' => '',
            'alcohol' => '',
            'weight' => '',
            'opened_bottle' => '',
            'full_packs' => '',
            'current_volume' => '',
            'scanned_by' => '',
            'ean' => '',
            'total_cost' => '',
            'total_revenue' => '',
            'total_profit' => number_format($this->totalProfit, 2),
            'total_stock_price' => '',
        ];
        $data[] = [
            'name' => 'Celková hodnota skladu',
            'volume' => '',
            'alcohol' => '',
            'weight' => '',
            'opened_bottle' => '',
            'full_packs' => '',
            'current_volume' => '',
            'scanned_by' => '',
            'ean' => '',
            'total_cost' => '',
            'total_revenue' => '',
            'total_profit' => '',
            'total_stock_price' => number_format($total_stock_cost, 2),
        ];

        return collect($data);
    }

    protected function calculateOpenedBottleWeight($item)
    {
        if (!isset($item['stocktake_data']['empty_bottle_weight']) ||
            !isset($item['stocktake_data']['full_bottle_weight'])) {
            return 0;
        }

        $emptyWeight = $item['stocktake_data']['empty_bottle_weight'];
        $fullWeight = $item['stocktake_data']['full_bottle_weight'];
        $currentWeight = $item['stocktake_data']['weight'];

        // Calculate how much liquid is in the opened bottle
        return $currentWeight - $emptyWeight;
    }

    public function headings(): array
    {
        return [
            'Názov',
            'Objem (ml)',
            'Alkohol (%)',
            'Váha (g)',
            'Otvorená flaša (ml)',
            'Počet balení (ks)',
            'Aktuálny objem (L)',
            'Naskenoval',
            'EAN',
            'Náklady (€)',
            'Tržba (€)',
            'Zisk/Strata (€)',
            'Hodnota skladu (€)',
        ];
    }
}
