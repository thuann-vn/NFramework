<?php

namespace App\Services;

use App\Order;
use App\User;
use Illuminate\Support\Facades\Log;

class FbBot
{
    private $accessToken = null;
    function __construct($accessToken=null)
    {
        if (!empty($accessToken)) {
            $this->accessToken = $accessToken;
        } else {
            $this->accessToken = config('shop.fb_token');
        }
    }

    public function sendMessage($message)
    {
        try
        {
            Log::info('SENDING MESSENGER:',  ['url'=> env('APP_URL'), 'receiver'=> $message['recipient']]);

            $message['access_token'] =  $this->accessToken;

            $client = new \GuzzleHttp\Client();
            $url = "https://graph.facebook.com/v2.6/me/messages";
            $header = array(
                'content-type' => 'application/json'
            );

            $result = $client->post($url, ['query' => $message, 'headers' => $header]);
            Log::info('SENDING MESSENGER DONE:',  ['url'=> env('APP_URL'), 'result'=> $result]);
        }
        catch(\GuzzleHttp\Exception\RequestException $e)
        {
            Log::alert('Send messenger error', ['code' => $e->getCode(),'message' => $e->getMessage()]);
        }
    }

    /**
     * @param $receivePhoneNumber
     * @param $order Order
     */
    public function sendOrderNotifyMessage($orderId){
        $order = Order::findOrFail($orderId);
        $payload = [
            'template_type' => 'receipt',
            'sharable' => true,
            'recipient_name' => $order->billing_name,
            'order_number' => $order->id,
            'currency' => 'VND',
            'order_url' => route('voyager.orders.show', $order->id),
            "payment_method"=>$order->payment_method=='cash'?__('frontend.checkout.payment.cash'):__('frontend.checkout.payment.transfer'),
            'timestamp' => $order->created_at->timestamp,
            'address' => [
                "street_1" => $order->billing_address,
                "street_2" => "ABC",
                "city" => $order->billing_city,
                "postal_code" => "70000",
                "state" => $order->billing_province,
                "country"=>"Viet Nam"
            ],
            "summary" => [
                "subtotal" => $order->billing_subtotal,
                "total_cost" => $order->billing_subtotal
            ]
        ];

        if(!empty($order->billing_discount_code)){
            $payload['adjustments']=[
                [
                    "name"=>$order->billing_discount_code,
                    "amount"=>$order->billing_discount
                ]
            ];
        }

        $elements = [];
        foreach ($order->products as $product)
        {
            $elements[]=[
                "title" => $product->name,
                "subtitle" => $product->details,
                "quantity" => $product->pivot->quantity,
                "price" => $product->price,
                "currency" => "VND",
                "image_url" => asset('storage/'.$product->image)
            ];
        }

        $payload['elements'] = $elements;

        $receiveList = User::where('send_notify',1)->whereNotNull('phone_number')->get();
        foreach ($receiveList as $admin){
            $message= [
                'messaging_type' => 'MESSAGE_TAG',
                'tag' => 'PERSONAL_FINANCE_UPDATE',
                'recipient' => ['phone_number' => $admin->phone_number],
                'message' => [
                    'attachment' => [
                        'type' => 'template',
                        'payload' => $payload
                    ]
                ]
            ];
            $this->sendMessage($message);
        }
    }

    /**
     * @param $url
     * @param $params
     * @param $method
     */

    public function sendGraphAPI($url, $params, $method = 'POST'){
        $params['access_token'] =  $this->accessToken;
        if($method=='POST'){
            $url = config('shop.fb_graph') .  $url . '?access_token='.config('shop.fb_token');

            $data = ['json' => $params];

            $client = new \GuzzleHttp\Client;
            return $client->request($method , $url,  $data);
        }else{
            $url = config('shop.fb_graph') .  $url . '?access_token='.config('shop.fb_token');
            foreach ($params as $key=> $param){
                $url. '&'.$key . '=' . $param;
            }

            $client = new \GuzzleHttp\Client();
            $header = array(
                'content-type' => 'application/json'
            );

            $response =  $client->get($url, ['headers' => $header]);
            return json_decode($response->getBody()->getContents());
        }
    }
}
