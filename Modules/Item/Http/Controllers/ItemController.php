<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Item\Services\ItemService;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ItemService $itemService)
    {
        $data = $itemService->index();
        return view('item::index', $data);
    }
    public function supplierUpdate(ItemService $itemService)
    {
        $data = $itemService->supplierUpdate();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemService $itemService) {
        $data = $itemService->store();
        if ($data) {
            return back()->with('message', 'Produkt bol pridaný do skladu.');
        } else {
            return back()->with('warning', 'Produkt sa nepodarilo pridať do skladu.');
        }
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('item::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemService $itemService, $id)
    {
        $data = $itemService->edit($id);
        return view('item::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemService $itemService, $id) {
        $data = $itemService->update($id);
        if ($data) {
            return back()->with('message', 'Dodávateľ bol upravený.');
        } else {
            return back()->with('warning', 'Dodávateľ nebol upravený. ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemService $itemService, $id) {
        $data = $itemService->destroy($id);
        if($data){
            return redirect(route('item.index'))->with('message','Produkt bol vymazaný.');
        }else{
            return back()->with('warning','Produkt nebol vymazaný. ');
        }
    }
}
