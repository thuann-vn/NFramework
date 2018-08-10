<?php

namespace App\Jobs;

use App\Order;
use App\Services\FbBot;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendOrderNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        //
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $bot = new FbBot();
        if ($this->attempts() <= config('queue.max_tries')) {
            $order = Order::findOrFail($this->orderId);
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

            $receiveList = User::where('send_notify',1)->whereNotNull('messenger_id')->get();
            foreach ($receiveList as $admin){
                $message= [
                    'messaging_type' => 'MESSAGE_TAG',
                    'tag' => 'PERSONAL_FINANCE_UPDATE',
                    'recipient' => ['id' => $admin->messenger_id],
                    'message' => [
                        'attachment' => [
                            'type' => 'template',
                            'payload' => $payload
                        ]
                    ]
                ];
                $bot->sendGraphAPI('me/messages', $message);
            }
        }
    }
}
