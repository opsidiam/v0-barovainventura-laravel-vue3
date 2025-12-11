<?php

namespace Modules\Admin\Services;

use Modules\Cargo\Models\Cargo;

class ApprovedProductsService
{
    public function handle() {}

    public function edit($id)
    {
        if(Cargo::where( 'id' , $id )->exists()) {
            $data['cargo'] = Cargo::where('id',$id)->first();
            return $data;
        }

        return false;
    }

    public function update($id)
    {
        request()->validate([
            "name" => 'required|string',
            "brand" => 'nullable|string',
            "type" => 'required|numeric',
            "volume" => 'required|numeric',
            "alcohol" => 'required|numeric',
        ]);
        Cargo::where('id',$id)->update([
            "name" => request()->name,
            "brand" => request()->brand,
            "type" => request()->type,
            "volume" => request()->volume,
            "alcohol" => request()->alcohol,
            "weight_full" => request()->weight_full,
            "weight_empty" => request()->weight_empty,
            "weight_tolerance" => request()->weight_tolerance,
        ]);
        return true;
    }

    public function hide($id)
    {
        if (Cargo::find($id)->exists()) {
            Cargo::where('id', $id)
                ->update([
                    'original' => 1
                ]);
            return true;
        }
        return false;
    }
}
