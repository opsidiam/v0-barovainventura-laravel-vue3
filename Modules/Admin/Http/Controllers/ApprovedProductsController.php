<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Modules\Admin\Services\AdminDataTableService;
use Modules\Admin\Services\ApprovedProductsService;

class ApprovedProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::approved-products.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApprovedProductsService $approvedProductsService, $id)
    {
        $data = $approvedProductsService->edit($id);
        if($data){
            return view('admin::approved-products.edit', $data);
        }
        return back()->with('warning','Nastala chyba');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApprovedProductsService $approvedProductsService, $id) {
        $data = $approvedProductsService->update($id);
        if($data){
            return redirect()->route('admin.approved-products.index')->with('message',__('warehouse.messages.success.product-update'));
        }
        return back()->with('warning','Nastala chyba');
    }

    public function hide(ApprovedProductsService $approvedProductsService, $id) {
        $data = $approvedProductsService->hide($id);
        if($data){
            return back()->with('message', __('admin.messages.success.approved-products-hide'));
        }
        return back()->with('warning','Nastala chyba');

    }
}
