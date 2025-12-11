<?php

namespace Modules\Cargo\Services;

use Modules\Cargo\Models\Cargo;
use Modules\Supplier\Models\Supplier;

class CargoService
{
    public function handle() {}

    public function searchCargo()
    {
        $term = trim(request()->q);
        $type = trim(request()->type);

        if (empty($term)) {
            return [];
        }

        $cargos = Cargo::where('name', 'LIKE', "%{$term}%")
            ->where('original',0)
            ->where('type',$type)
            ->limit(20)->get();

        $data = [];

        foreach ($cargos as $cargo) {
            $data[] = ['id' => $cargo->id, 'text' => $cargo->name.' ( '.$cargo->volume.' ml, '.$cargo->alcohol.' % )'];
        }

        return $data;
    }
}
