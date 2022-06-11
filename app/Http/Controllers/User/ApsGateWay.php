<?php

namespace App\Http\Controllers\User;


use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Subscription;
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
     $username = 'api_alqeitharah';
     $pass = '123456';
     $return_url = 'www.facebook.com';
     $cancel_url = 'wwww.youtube.com';
     $notify_url = 'www.google.com';
     //$item_name = $subs->title." Plan";
     $item_number = str_random(4).time();
     $item_amount = $subs->price; 
    $curl = curl_init();
    $id =  time();
    
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://uat-proxy.aps.iq:5443/rest/register.do?userName=$username&password=$pass&orderNumber=$id&amount=500&currency=840&returnUrl=$return_url&failUrl=$cancel_url",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    $data =  json_decode($response,true);
    $url = $data['formUrl'];
     $user = Auth::user();
     $subs = Subscription::findOrFail($request->subs_id);
     $settings = Generalsetting::findOrFail(1);
  

     return redirect($url);
     //header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);

 }


     public function paycancle(){
         return redirect()->back()->with('unsuccess','Payment Cancelled.');
     }

     public function payreturn(){
         return redirect()->route('user-dashboard')->with('success','Vendor Account Activated Successfully');
     }


public function notify(Request $request){

    $raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }
    //return $myPost;


    // Read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';
    if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
    }
    foreach ($myPost as $key => $value) {
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }
        $req .= "&$key=$value";
    }

    /*
     * Post IPN data back to PayPal to validate the IPN data is genuine
     * Without this step anyone can fake IPN data
     */
    $paypalURL = "https://www.paypal.com/cgi-bin/webscr";
    $ch = curl_init($paypalURL);
    if ($ch == FALSE) {
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
    $res = curl_exec($ch);

    /*
     * Inspect IPN validation result and act accordingly
     * Split response headers and payload, a better way for strcmp
     */
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));
    if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

        $order = UserSubscription::where('user_id','=',$_POST['custom'])
            ->orderBy('created_at','desc')->first();


        $user = User::findOrFail($_POST['custom']);
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($order->subscription_id);
        $settings = Generalsetting::findOrFail(1);


        $today = Carbon::now()->format('Y-m-d');
        $date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
        $input = $request->all();
        $user->is_vendor = 2;
        if(!empty($package))
        {
            if($package->subscription_id == $request->subs_id)
            {
                $newday = strtotime($today);
                $lastday = strtotime($user->date);
                $secs = $lastday-$newday;
                $days = $secs / 86400;
                $total = $days+$subs->days;
                $user->date = date('Y-m-d', strtotime($today.' + '.$total.' days'));
            }
            else
            {
                $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
            }
        }
        else
        {
            $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
        }
        $user->mail_sent = 1;
        $user->update($input);


        $data['txnid'] = $_POST['txn_id'];
        $data['status'] = 1;
        $order->update($data);

        if($settings->is_smtp == 1)
        {
            $maildata = [
                'to' => $user->email,
                'type' => "vendor_accept",
                'cname' => $user->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'onumber' => "",
            ];
            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($maildata);
        }
        else
        {
            $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
            mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
        }


    }else{
        $payment = UserSubscription::where('user_id','=',$_POST['custom'])
            ->orderBy('created_at','desc')->first();
        $payment->delete();


    }
}

}
