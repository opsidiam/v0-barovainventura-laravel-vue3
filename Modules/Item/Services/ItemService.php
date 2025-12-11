<?php

namespace Modules\Item\Services;

use Modules\Cargo\Models\Cargo;
use Modules\Item\Models\Item;
use Modules\Supplier\Models\Supplier;

class ItemService
{
    public function handle() {}

    public function index()
    {
        $data['items'] = Item::where('user_id', auth()->user()->id)
            ->where('bar_id', request()->session()->get('bar'))
            ->with('cargo')->get();
        $data['suppliers'] = Supplier::where('user_id', auth()->user()->id)->get();
        return $data;
    }

    public function edit($id)
    {
        $data['item'] = Item::find($id);
        $data['suppliers'] = Supplier::where('user_id', auth()->user()->id)->get();
        return $data;
    }
    public function update($id)
    {
        $fields = [
            'service_id' => 'supplier_id',
            'product_key_supplier' => 'product_key_supplier',
            'price_buy' => 'price_buy',
            'price_sell' => 'price_sell',
            'weight_sell' => 'weight_sell',
        ];

        $updates = [];

        foreach ($fields as $input => $column) {
            $updates[$column] = request()->input($input) ?? null;
        }

        foreach (['price_buy', 'price_sell', 'weight_sell'] as $numField) {
            if (array_key_exists($numField, $updates) && $updates[$numField] !== null) {
                $normalized = str_replace(',', '.', (string) $updates[$numField]);
                $updates[$numField] = is_numeric($normalized) ? (float) $normalized : null;
            }
        }

        if (!empty($updates)) {
            return (bool) Item::where('id', $id)
                ->update($updates);
        }

        return false;
    }
    public function store()
    {
        $cargo = Cargo::find(request()->input('cargo_id'));

        if(!$cargo) return false;

        return (bool) Item::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'bar_id' => request()->session()->get('bar'),
                'cargo_id' => request()->input('cargo_id')
            ],
            [
                'weight_count' => request()->input('open_botle') ?? null,
                'price_buy' => request()->input('price_buy') ?? null,
                'price_sell' => request()->input('price_sell') ?? null,
                'weight_sell' => request()->input('weight_sell') ?? null,
                'full_pack_count' => request()->input('botle') ?? null,
                'product_key_supplier' => request()->input('product_key_supplier') ?? null,
            ]
        );

    }

    public function destroy($id)
    {
        $userId = auth()->user()->id;
        $barId = request()->session()->get('bar');

        return (bool) Item::where('id', $id)
            ->where('user_id', $userId)
            ->where('bar_id', $barId)
            ->delete();
    }

    public function supplierUpdate()
    {

        $term = trim(request()->id);
        $term2 = trim(request()->supplier_id);

        if (empty($term) and empty($term2)) {
            return [
                'success' => $term
            ];
        }
        if(Item::where('id',$term)->update(['supplier_id' => $term2])){
            $formatted_tags = [
                'success' => true
            ];
        }else{
            $formatted_tags = [
                'successa' => [$term,$term2]
            ];
        }

        return $formatted_tags;
    }
}
