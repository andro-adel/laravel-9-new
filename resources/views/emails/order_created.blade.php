<!DOCTYPE html>
<html>
    <head>
        <title>Order Completed</title>
        <style>
            .title{
                color:#143250;
            }
            .center{
                width: auto;
                margin: auto;
                text-align: center;
            }

            .details{
                font-size: medium;
            }

            .row{
                display: flex;
                justify-content: space-between;
                align-content: center;
                width: 100%;
            }


        </style>

    </head>
    <body>
        <div class="center">
            <h4 class="title"> {{ $langg->order_title }}</h4>
        </div>
        <br>
        <div>
            <p class="details">{{ $langg->lang301 }} {{date('d-M-Y',strtotime($order->created_at))}}</p>
        </div>

    <div class="row">

        <div>
                <h5>{{ $langg->lang287 }}</h5>
                <address>
                    {{ $langg->lang288 }} {{$order->customer_name}}<br>
                    {{ $langg->lang289 }} {{$order->customer_email}}<br>
                    {{ $langg->lang290 }} {{$order->customer_phone}}<br>
                    {{ $langg->lang291 }} {{$order->customer_address}}<br>
                    {{$order->customer_city}}-{{$order->customer_zip}}
                </address>
        </div>

        <div>
            <h5>{{ $langg->lang292 }}</h5>
            <p>{{ $langg->lang293 }} {{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</p>
            <p>{{ $langg->lang294 }} {{$order->method}}</p>

            @if($order->method != "Cash On Delivery")
                @if($order->method=="Stripe")
                    {{$order->method}} {{ $langg->lang295 }} <p>{{$order->charge_id}}</p>
                @endif
                {{$order->method}} {{ $langg->lang296 }} <p id="ttn">{{$order->txnid}}</p>

            @endif
        </div>

    </div>

    </body>
</html>