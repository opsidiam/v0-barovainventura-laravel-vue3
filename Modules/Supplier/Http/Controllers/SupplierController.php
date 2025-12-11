<?php

namespace Modules\Supplier\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Supplier\Services\SupplierService;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SupplierService $supplierService)
    {
        $data['suppliers'] = $supplierService->index();
        return view('supplier::index', $data);
    }

    /**
     * Display a listing of the tutorial.
     */
    public function tutorial()
    {
        return view('supplier::tutorial');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierService $supplierService) {
        $data = $supplierService->store();
        if($data){
            return back()->with('message','Dodávateľ bol vytvorený.');
        }else{
            return back()->with('warning','Dodávateľ nebol vytvorený. ');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierService $supplierService, $id)
    {
        $data['supplier'] = $supplierService->edit($id);
        return view('supplier::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierService $supplierService, $id) {
        $data = $supplierService->update($id);
        if($data){
            return back()->with('message','Dodávateľ bol upravený.');
        }else{
            return back()->with('warning','Dodávateľ nebol upravený. ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierService $supplierService, $id) {
        $data = $supplierService->destroy($id);
        if($data){
            return redirect(route('supplier.index'))->with('message','Dodávateľ bol vymazaný.');
        }else{
            return back()->with('warning','Dodávateľ nebol vymazaný. ');
        }
    }

    public function searchSupplier(SupplierService $supplierService)
    {
        $data = $supplierService->searchSupplier();
        return response()->json($data);
    }
}
