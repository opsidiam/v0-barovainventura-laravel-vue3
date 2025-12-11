<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Product\Services\ProductService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductService $productService)
    {
        $data = $productService->getIndex();
        return view('product::index', $data);
    }

    public function addToCart(ProductService $productService, $id)
    {
        if($productService->addToCart($id)){
            return back()->with('message','Produkt bol pridaný do košíka.');
        }
        return back()->with('warning','Produkt nebol pridaný do košíka.');
    }

    public function removeToCart(ProductService $productService)
    {
        if($productService->removeToCart()){
            return back()->with('message','Produkt bol odstránený z košíka.');
        }
        return back()->with('warning','Produkt nebol odstránený z košíka.');
    }

    public function cart(ProductService $productService)
    {
        $data = $productService->getCart();
        return view('product::cart', $data);
    }

    public function checkout(ProductService $productService)
    {
        $orderId = request()->order_id;
        $data = $productService->checkout($orderId);
        if(isset($data['error'])){
            return back()->with('error', $data['error']['message']);
        }

        return redirect()->route('product.order.checkout',$data);
    }

    public function orderCheckout(ProductService $productService, $order_id)
    {
        $data = $productService->checkoudShow($order_id);

        return view('product::order-checkout', $data);
    }

}
