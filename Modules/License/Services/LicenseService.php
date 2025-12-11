<?php

namespace Modules\License\Services;

use Modules\License\Models\License;
use Modules\License\Models\Order;
use Modules\License\Services\Api\ApiOrderService;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class LicenseService
{
    public function handle() {}

    public function index()
    {
        return License::where('category',auth()->user()->licences_category)->get();
    }

    public function getAll()
    {
        return License::where('category',3)->where('show',1)->get();
    }

    public function select($existLicense)
    {
        $user = auth()->user();
        $licenseCategory = $user->licences_category;
        if ($existLicense) {
            $license = License::where([
                ['id', request()->id],
                ['show', 1],
                ['category', $licenseCategory]
            ])->first();

            if (!$license) {
                return ['error' => ['message' => 'Neoprávnený požiadavok.']];
            }
            $data = $this->prepareOrderData($license, $license->price);
            $data['order_id'] = $this->createOrder($user->id, $data, $license->price);

            return $data;
        }

        $validated = request()->validate([
            'time' => 'integer|required',
            'count' => 'integer|required',
        ]);

        $license = License::where('category', $licenseCategory)->where('time', ($validated['time']*86400))->firstOrFail();
        $basePrice = $license->price * $validated['count'];

        $price = $validated['count'] > 1 ? $basePrice * 0.95 : $basePrice;
        $priceOff = $validated['count'] > 1 ? 5 : 0;

        $licenseCustom = [
            'name' => 'Plán na mieru',
            'price' => $price,
            'count' => $validated['count'],
            'price_off' => $priceOff,
            'time' => $validated['time'] * 86400
        ];

        $data = $this->prepareOrderData($license, $price, $licenseCustom);
        $data['order_id'] = $this->createOrder($user->id, $data, $price);

        return $data;
    }

    public function selectShow($order_id)
    {
        $order = Order::find($order_id);
        return json_decode($order->data, true);

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
        return [
            'url' => $order->pay_url,
            'invoice_data' => json_decode($order->invoice_data,true),
            'price' => format_price($order->price),
            'payed' => $order->payed,
            'items' => json_decode($order->data,true),
        ];
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
        $user = auth()->user();
        $fields = [
            'invoice_phone' => ['Telefónne číslo', 'string'],
            'invoice_name' => ['Meno / Názov fakturanta', 'string'],
            'invoice_surname' => ['Priezvisko', 'string'],
            'invoice_address' => ['Adresa fakturanta', 'string'],
            'invoice_psc' => ['PSČ fakturanta', 'string'],
            'invoice_city' => ['Mesto fakturanta', 'string'],
            'invoice_stat' => ['Štát fakturanta', 'string'],
            'invoice_ico' => ['IČO', 'string'],
            'invoice_dic' => ['DIČ', 'string'],
            'invoice_icdph' => ['IČ DPH', 'string']
        ];

        foreach ($fields as $field => [$label, $type]) {
            if ($user->$field == null) {
                $user->$field = request()->$field;
            }
        }

        $user->save();

        $order->fill([
            'number' => 'ZB' . $this->generateVariableSymbol(),
            'variable_symbol' => $this->generateVariableSymbol(),
            'type' => 'license',
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
            'description' => 'Licencia',
            'id' => $order->id,
            'customer' => json_encode($customerData),
            'shipping' => 0,
            'discount' => 0,
            'items' => json_encode($items),
        ];

        return (new ApiOrderService())->create($paymentData);
    }

    protected function prepareOrderItems(Order $order)
    {
        $data = json_decode($order->data);
        $isCustomPlan = isset($data->license_custome);

        return [[
            'name' => ($isCustomPlan ? $data->license_custome->name : $data->license->name) . ' (barovainventura.sk)',
            'description' => 'Licencia pre počet podnikov: ' . ($isCustomPlan ? $data->license_custome->count : 1),
            'quantity' => 1,
            'price' => $isCustomPlan ? $data->license_custome->price : (int)$data->license->price,
        ]];
    }

// Pomocné metódy
    protected function prepareOrderData($license, $price, $licenseCustom = null)
    {
        return [
            'license' => $license,
            'license_custome' => $licenseCustom,
            'total_price' => $price,
            'user' => auth()->user(),
        ];
    }

    protected function createOrder($userId, $data, $price)
    {
        return Order::create([
            'user_id' => $userId,
            'data' => json_encode($data),
            'type' => 'license',
            'price' => $price
        ])->id;
    }
}
