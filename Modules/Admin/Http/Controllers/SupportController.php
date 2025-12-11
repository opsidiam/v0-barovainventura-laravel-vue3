<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Services\SupportService;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::support.index');
    }

    public function done(SupportService $supportService, $id)
    {
        $data = $supportService->done($id);
        if($data){
            return back()->with('message',__('admin.messages.success.support.done'));
        }
        return back()->with('warning','Nastala chyba');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportService $supportService, $id)
    {
        $data = $supportService->destroy($id);
        if($data){
            return back()->with('message',__('admin.messages.success.support.delete'));
        }
        return back()->with('warning','Nastala chyba');
    }
}
