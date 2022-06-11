<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\User;
use App\Models\Order;
use App\Models\Fines;
use Auth;
use App\Models\Generalsetting;
use Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CommissionController extends Controller
{
    private $order;
    
    function __construct(){
     $this->order = new Order;   
    }
    //*** JSON Request
    public function datatables($status)
    {
        if($status == 'pending'){
            $datas = Order::where('status','=','pending')->get();
        }
        elseif($status == 'processing') {
            $datas = Order::where('status','=','processing')->get();
        }
        elseif($status == 'completed') {
            $datas = Order::where('status','=','completed')->get();
        }
        elseif($status == 'declined') {
            $datas = Order::where('status','=','declined')->get();
        }
        else{
            $datas = Order::orderBy('id','desc')->get();
        }

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('id', function(Order $data) {
                $id = '<a href="'.route('admin-order-invoice',$data->id).'">'.$data->order_number.'</a>';
                return $id;
            })
            ->editColumn('pay_amount', function(Order $data) {
                return $data->currency_sign . round($data->pay_amount * $data->currency_value , 2);
            })
            ->addColumn('commission', function(Order $data) {
                $commission = round($data->pay_amount*.10,2);
                return $data->currency_sign.$commission;
            })
            ->addColumn('action', function(Order $data) {
                $orders = '<a href="javascript:;" data-href="'. route('admin-order-edit',$data->id) .'" class="delivery" data-toggle="modal" data-target="#modal1"><i class="fas fa-dollar-sign"></i> Delivery Status</a>';
                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-order-show',$data->id) . '" > <i class="fas fa-eye"></i> Details</a><a href="javascript:;" class="send" data-email="'. $data->customer_email .'" data-toggle="modal" data-target="#vendorform"><i class="fas fa-envelope"></i> Send</a><a href="javascript:;" data-href="'. route('admin-order-track',$data->id) .'" class="track" data-toggle="modal" data-target="#modal1"><i class="fas fa-truck"></i> Track Order</a>'.$orders.'</div></div>';
            })
            ->rawColumns(['id','action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    function index(){
        return view('admin.commission.index');
    }

    function all_pending(){
        return view('admin.commission.pending');
    }

    function all_processing(){
        return view('admin.commission.processing');
    }

    function all_completed(){
        return view('admin.commission.completed');
    }

    function collectible(){

    }
}