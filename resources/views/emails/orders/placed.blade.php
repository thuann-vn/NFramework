@component('mail::message')
# Order Received

Thank you for your order.

**Order ID:** {{ $order->id }}

**Order Email:** {{ $order->billing_email }}

**Order Name:** {{ $order->billing_name }}

**Order Subtotal:** {{ priceFormat($order->billing_subtotal) }}

**Discount:** {{ priceFormat($order->billing_discount) }}

**Order Total:** {{ priceFormat($order->billing_total) }}

**Items Ordered**

@foreach ($order->products as $product)
Name: {{ $product->name }} <br>
Price: {{ priceFormat($product->price)}} <br>
Quantity: {{ $product->pivot->quantity }} <br>
@endforeach

You can get further details about your order by logging into our website.

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent
