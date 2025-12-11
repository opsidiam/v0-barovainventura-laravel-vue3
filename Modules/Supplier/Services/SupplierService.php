<?php

namespace Modules\Supplier\Services;

use Modules\Supplier\Models\Supplier;

class SupplierService
{
    public function handle() {}

    public function index()
    {
        $data = Supplier::where('user_id', auth()->user()->id)
            ->where('bar_id', request()->session()->get('bar'))
            ->get();
        return $data;
    }

    public function store()
    {
        $requiredFields = ['name', 'email'];
        $hasAllRequired = collect($requiredFields)->every(fn($field) => !empty(request()->input($field)));

        if ($hasAllRequired) {
            $insertData = [
                "name_supplier" => request()->name,
                "user_id" => auth()->user()->id,
                'bar_id' => request()->session()->get('bar'),
                "address" => request()->address,
                "address_number" => request()->address_number,
                "city" => request()->city,
                "psc" => request()->psc,
                "stat" => request()->stat,
                "email" => request()->email,
                "phone" => request()->phone,
                "note" => request()->note,
            ];

            return (bool)Supplier::insert($insertData);
        }
        return false;
    }

    public function destroy($id)
    {
        $userId = auth()->user()->id;
        $barId = request()->session()->get('bar');

        return (bool) Supplier::where('id', $id)
            ->where('user_id', $userId)
            ->where('bar_id', $barId)
            ->delete();
    }

    public function edit($id)
    {
        return Supplier::find($id);
    }
    public function update($id)
    {
        $fields = [
            'name' => 'name_supplier',
            'address' => 'address',
            'address_number' => 'address_number',
            'city' => 'city',
            'psc' => 'psc',
            'stat' => 'stat',
            'email' => 'email',
            'phone' => 'phone',
            'note' => 'note'
        ];

        $updates = [];

        foreach ($fields as $input => $column) {
            $updates[$column] = request()->input($input) ?? null;
        }

        if (!empty($updates)) {
            return (bool) Supplier::where('id', $id)
                ->update($updates);
        }

        return false;
    }
    public function searchSupplier()
    {
        $term = trim(request()->q);
        $barId = request()->session()->get('bar');

        if (empty($term)) {
            $formatted_tags = [];
            $suppliers = Supplier::where('bar_id', $barId)->get(['id', 'name_supplier']);
            foreach ($suppliers as $supplier) {
                $formatted_tags[] = ['id' => $supplier->id, 'text' => $supplier->name_supplier];
            }
            return $formatted_tags;
        }

        $suppliers = Supplier::where('bar_id', $barId)
            ->where('name_supplier', 'LIKE', "%{$term}%")
            ->orwhere('email', 'LIKE', "%{$term}%")->get();

        $formatted_tags = [];

        foreach ($suppliers as $supplier) {
            $formatted_tags[] = ['id' => $supplier->id, 'text' => $supplier->name_supplier];
        }
        return $formatted_tags;
    }
}
