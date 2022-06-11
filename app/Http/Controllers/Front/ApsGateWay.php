<?php

namespace App\Http\Controllers\Front;

use App\Models\Currency;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\User;
use App\Models\UserSubscription;
use Auth;
use Carbon\Carbon;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;

class ApsGateWay extends Controller
{

    public function store(Request $request){
        $curr = Currency::find(Session::get('currency'));
        $code = $curr->code;
        $curl = curl_init();
        $item_number =   str_random(4).time();
        $item_amount = $request->total;
         if($curr->code == 368){
             if(strrpos($item_amount, ".")){
                $arr =  explode(".",$item_amount);
                $new_cent = $arr[1];
                $len = strlen($arr[1]);
                for($len;$len < 3;$len++ )
                {
                    $new_cent.='0';
                }

                (int)$price_iqd = (int)$arr[0].(int)$new_cent;
             }
             else{
              (int)$price_iqd = $new_price.'00'; 
             }
             
        }
        else
        {
              $price_iqd = $item_amount; 
              if(strrpos($price_iqd, ".")){
                $arr =  explode(".",$price_iqd);
                $new_cent = $arr[1];
                $len = strlen($arr[1]);
                for($len;$len < 2;$len++ )
                {
                    $newcent.='0';
                }
                (int)$price_iqd = (int)$arr[0].(int)$new_cent;
                
             }
              else{
              (int)$price_iqd = $new_price.'00'; 
             }
        }
        
        $fail = route('payment.cancle');
        $return =  route('apsreturn');
        $link = "https://uat-proxy.aps.iq:5443/rest/register.do?userName=api_alqeitharah&password=123456&";
        $link .="orderNumber=$item_number&amount=$price_iqd&currency=$code&returnUrl=$return&failUrl=$fail";
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$link",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $data = json_decode($response,true);
        $url = $data['formUrl'];
        Session::put('orderid', $data['orderId']);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }
        foreach($cart->items as $key => $prod)
        {
        if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
        {
                foreach($prod['item']['license_qty']as $ttl => $dtl)
                {
                    if($dtl != 0)
                    {
                        $dtl--;
                        $produc = Product::findOrFail($prod['item']['id']);
                        $temp = $produc->license_qty;
                        $temp[$ttl] = $dtl;
                        $final = implode(',', $temp);
                        $produc->license_qty = $final;
                        $produc->update();
                        $temp =  $produc->license;
                        $license = $temp[$ttl];
                         $oldCart = Session::has('cart') ? Session::get('cart') : null;
                         $cart = new Cart($oldCart);
                         $cart->updateLicense($prod['item']['id'],$license);  
                         Session::put('cart',$cart);
                        break;
                    }                    
                }
        }
        }
        $settings = Generalsetting::findOrFail(1);
        $order = new Order;
        $item_name = $settings->title." Order";
        $item_number = str_random(4).time();
        $item_amount = $request->total;
        // Redirect to paypal IPN
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round($item_amount / $curr->value, 2);
        $order['method'] = $request->method;
        $order['customer_email'] = $request->email;
        $order['customer_name'] = $request->name;
        $order['customer_phone'] = $request->phone;
        $order['order_number'] = $item_number;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        $order['customer_zip'] = $request->zip;
        $order['shipping_email'] = $request->shipping_email;
        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_country'] = $request->shipping_country;
        $order['shipping_city'] = $request->shipping_city;
        $order['shipping_zip'] = $request->shipping_zip;
        $order['order_note'] = $request->order_notes;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['payment_status'] = "Pending";
        $order['currency_sign'] = $curr->sign;
        $order['currency_value'] = $curr->value;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['tax'] = $request->tax;
        $order['dp'] = $request->dp;
        
        $order['vendor_shipping_id'] = $request->vendor_shipping_id;
        $order['vendor_packing_id'] = $request->vendor_packing_id;
        
        if (Session::has('affilate')) 
        {
        $val = $request->total / $curr->value;
        $val = $val / 100;
        $sub = $val * $settings->affilate_charge;
        $user = User::findOrFail(Session::get('affilate'));
        $user->affilate_income += $sub;
        $user->update();
        $order['affilate_user'] = $user->name;
        $order['affilate_charge'] = $sub;
        }
        $order->save();
        return redirect($url);
        

    }

    public function paycancle(){
        return redirect()->back()->with('unsuccess','Payment Cancelled.');
    }

    public function apsreturn(){
        $order =  Order::find(session('orderid'));
        $status = ['payment_status'=>'Completed'];
        $order->update($status);
        return redirect()->route('user-dashboard')->with('success','Vendor Account Activated Successfully');
    }



}
