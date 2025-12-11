<?php

namespace Modules\License\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Bar\Models\Bar;
use Modules\License\Models\License;
use Modules\License\Models\Order;
use Modules\License\Services\LicenseService;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LicenseService $licenseService)
    {
        $data['licenses'] = $licenseService->index();
        $data['barCount'] = Bar::where('user_id',Auth::id())->count();
        return view('license::index', $data);
    }

    public function select(LicenseService $licenseService)
    {
        $existLicense = request()->has('id');
        $data = $licenseService->select($existLicense);
        if(isset($data['error'])){
            return back()->with('error', $data['error']['message']);
        }
        return redirect()->route('license.select.show',$data['order_id']);
    }


    public function selectShow(LicenseService $licenseService, $order_id)
    {
        $data = $licenseService->selectShow($order_id);
        $data['order_id'] = $order_id;

        return view('license::order', $data);
    }

    public function checkout(LicenseService $licenseService)
    {
        $orderId = request()->order_id;
        $data = $licenseService->checkout($orderId);
        if(isset($data['error'])){
            return back()->with('error', $data['error']['message']);
        }

        return redirect()->route('license.order.checkout',$data);
    }

    public function orderCheckout(LicenseService $licenseService, $order_id)
    {
        $data = $licenseService->checkoudShow($order_id);

        return view('license::order-checkout', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('license::create');
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
        return view('license::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('license::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
