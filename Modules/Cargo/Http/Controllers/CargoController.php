<?php

namespace Modules\Cargo\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cargo\Services\CargoService;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CargoService $cargoService)
    {
        $data = $cargoService->index();
        return view('cargo::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cargo::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('cargo::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('cargo::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function searchCargo(CargoService $cargoService)
    {
        $data = $cargoService->searchCargo();
        return response()->json($data);
    }
}
