<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Services\UnapprovedProductsService;

class UnapprovedProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::unapproved-products.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnapprovedProductsService $unapprovedProductsService, $id)
    {
        $data = $unapprovedProductsService->edit($id);
        if($data){
            return view('admin::unapproved-products.edit', $data);
        }
        return back()->with('warning','Nastala chyba');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnapprovedProductsService $unapprovedProductsService, $id) {
        $data = $unapprovedProductsService->update($id);
        if($data){
            return redirect()->route('admin.unapproved-products.index')->with('message',__('warehouse.messages.success.product-update'));
        }
        return back()->with('warning','Nastala chyba');
    }

    public function unhide(UnapprovedProductsService $unapprovedProductsService, $id) {
        $data = $unapprovedProductsService->unhide($id);
        if($data){
            return back()->with('message', __('admin.messages.success.unapproved-products-unhide'));
        }
        return back()->with('warning','Nastala chyba');

    }

    public function destroy($id, UnapprovedProductsService $unapprovedProductsService)
    {
        $data = $unapprovedProductsService->destory($id);
        if($data){
            return back()->with('message', __('admin.messages.success.products-delete'));
        }
        return back()->with('warning','Nastala chyba');
    }
}
