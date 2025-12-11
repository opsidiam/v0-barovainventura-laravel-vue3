<?php

namespace Modules\Product\Services;

use Modules\License\Models\Order;
use Modules\License\Services\Api\ApiOrderService;
use Modules\Product\Models\Product;
use function GuzzleHttp\json_encode;

class ProductService
{
    public function handle() {}
    public function getIndex()
    {
        $cart = request()->session()->get('bi_cart_data.products');
        $money = 0;
        if (request()->session()->exists('bi_cart_data')) {
            if(request()->session()->exists('bi_cart_data.money')){
                $money = request()->session()->get('bi_cart_data.money');
            }
        }
        return [
            'money' => $money,
            'cart' => $cart,
            'products' => Product::all()
        ];
    }

    public function addToCart($id)
    {
        $session = request()->session();
        $cartData = $session->get('bi_cart_data', ['products' => [], 'money' => 0]);
        $cart = $cartData['products'];
        $cart[$id] = ($cart[$id] ?? 0) + 1;

        $totalMoney = 0;
        foreach ($cart as $productId => $quantity) {
            $totalMoney += Product::find($productId)->price * $quantity;
        }

        $session->put('bi_cart_data', [
            'products' => $cart,
            'money' => $totalMoney,
            'order_id' => $cartData['order_id'] ?? null,
        ]);

        return true;
    }
    public function removeToCart()
    {
        $id = request()->input('id');
        if (!$id) {
            return false;
        }

        $id = (int)$id;
        $cartProducts = request()->session()->get('bi_cart_data.products', []);

        if (!array_key_exists($id, $cartProducts)) {
            return false;
        }

        unset($cartProducts[$id]);

        $money = 0;
        if (!empty($cartProducts)) {
            $productIds = array_keys($cartProducts);
            $products = Product::whereIn('id', $productIds)->pluck('price', 'id');

            foreach ($cartProducts as $productId => $quantity) {
                if (isset($products[$productId])) {
                    $money += $products[$productId] * $quantity;
                }
            }
        }

        request()->session()->put('bi_cart_data', [
            'products' => $cartProducts,
            'money' => $money,
            'order_id' => $cartData['order_id'] ?? null,
        ]);

        return true;
    }

    public function getCart()
    {
        $user = auth()->user();

        $shipping = [
            'name' => 'Slovenská pošta',
            'img' => 'https://www.posta.sk/images/site/sl-posta-logo.svg',
            'short_description' => 'Doprava',
            'description' => 'Doprava',
            'count' => 1,
            'price' => 8,
            'total_price' => 8
        ];

        $cart = [$shipping];
        $totalPrice = $shipping['price'];

        $cartItems = request()->session()->get('bi_cart_data.products', []);
        $productIds = array_keys($cartItems);

        if (!empty($productIds)) {
            $products = Product::whereIn('id', $productIds)->get();
            foreach ($products as $product) {
                $quantity = $cartItems[$product->id];
                $productTotalPrice = $product->price * $quantity;

                $cart[$product->id] = [
                    'name' => $product->name,
                    'img' => $product->img,
                    'short_description' => $product->short_description,
                    'description' => $product->description,
                    'count' => $quantity,
                    'price' => $product->price,
                    'total_price' => $productTotalPrice,
                ];

                $totalPrice += $productTotalPrice;
            }
        }
        if(!request()->session()->has('bi_cart_data.order_id')){
            $cartData = request()->session()->get('bi_cart_data', []);
            $order = Order::create([
                'user_id' => $user->id,
                'type' => 'product',
                'data' => json_encode([
                    'products' => $cartData['products'] ?? [],
                    'total_price' => $cartData['money'] ?? 0,
                    'user' => $user
                ]),
                'price' => $totalPrice
            ]);

            $cartData['order_id'] = $order->id;
            $cartData['products'] = $cartItems;
            request()->session()->put('bi_cart_data', $cartData);
        } else {
            $cartData = request()->session()->get('bi_cart_data', []);
            Order::find($cartData['order_id'])->update([
                'data' => json_encode([
                    'products' => $cartData['products'],
                    'total_price' => $totalPrice,
                    'user' => $user
                ]),
                'price' => $totalPrice,
            ]);
        }

        return [
            'cart' => $cart,
            'money' => request()->session()->get('bi_cart_data.money', 0) + $shipping['price'],
            'order_id' => $cartData['order_id'],
            'count' => count($cart) - 1,
            'user' => $user
        ];
    }

    public function checkout($orderId)
    {
        request()->validate([
            'order_id' => 'required|integer',
            'email_invoice' => 'required|email',
            'invoice_phone' => 'required|regex:/^[0-9+\-\(\) ]{7,15}$/',
            'invoice_name' => 'required',
            'invoice_surname' => 'required',
            'invoice_address' => 'required',
            'invoice_psc' => 'required',
            'invoice_city' => 'required',
            'invoice_stat' => 'required',
        ]);

        $order = $this->updateOrderDetails($orderId, request()->all());

        $paymentResponse = $this->processPayment($order);

        if ($paymentResponse['url'] ?? false) {
            request()->session()->forget('bi_cart_data');
            $order->pay_url = $paymentResponse['url'];
            $order->pay_order_id = $paymentResponse['order_id'];
            $order->save();
            return $order->id;
        }

        return ['error' => ['message' => 'Payment processing failed']];
    }
    public function checkoudShow($orderId)
    {
        $order = Order::find($orderId);
        $items['products'] = $this->prepareOrderItems($order);
        $items['products'][] = [
            'name' => 'Slovenská pošta',
            'description' => 'Doprava',
            'quantity' => 1,
            'price' => 8,
        ];
        return [
            'url' => $order->pay_url,
            'invoice_data' => json_decode($order->invoice_data,true),
            'price' => format_price($order->price),
            'payed' => $order->payed,
            'items' => $items,
        ];
    }

    protected function updateOrderDetails($order_id, array $data)
    {
        $order = Order::find($order_id);
        $invoiceData = [
            'fa_email' => $data['email_invoice'],
            'fa_phone' => $data['invoice_phone'],
            'fa_name' => $data['invoice_company_name'] ?? $data['invoice_name'],
            'fa_surname' => $data['invoice_company_name'] ? null :$data['invoice_surname'],
            'fa_address' => $data['invoice_address'],
            'fa_psc' => $data['invoice_psc'],
            'fa_city' => $data['invoice_city'],
            'fa_stat' => $data['invoice_stat'],
            'fa_ico' => $data['invoice_ico'] ?? null,
            'fa_dic' => $data['invoice_dic'] ?? null,
            'fa_icdph' => $data['invoice_icdph'] ?? null,
        ];
        $order->fill([
            'number' => 'ZB' . $this->generateVariableSymbol(),
            'variable_symbol' => $this->generateVariableSymbol(),
            'month' => date('m'),
            'year' => date('Y'),
            'email_fa' => $data['email_invoice'],
            'invoice_data' => json_encode($invoiceData),
            'invoice_id' => 0,
            'customer_id' => 0,
            'send' => 0
        ])->save();
        return $order;
    }

    protected function processPayment(Order $order)
    {
        $customerData = json_decode($order->invoice_data,true);
        $items = $this->prepareOrderItems($order);

        $paymentData = [
            'description' => 'Produkty',
            'id' => $order->id,
            'customer' => json_encode($customerData),
            'shipping' => 8,
            'postal' => 1,
            'discount' => 0,
            'items' => json_encode($items),
        ];

        return (new ApiOrderService())->create($paymentData);
    }
    protected function generateVariableSymbol()
    {
        $year = date('Y');
        $month = date('m');

        $lastOrder = Order::where('year', $year)
            ->orderBy('id', 'desc')
            ->first();

        return $lastOrder
            ? $lastOrder->variable_symbol + 1
            : $year . $month . str_pad(1, 4, "0", STR_PAD_LEFT);
    }
    protected function prepareOrderItems(Order $order)
    {
        $data = json_decode($order->data);
        $items = [];

        foreach ($data->products as $productId => $quantity) {
            $product = Product::find($productId);

            if ($product) {
                $items[] = [
                    'name' => $product->name . ' (barovainventura.sk)',
                    'description' => $product->description,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ];
            }
        }

        return $items;
    }
}
