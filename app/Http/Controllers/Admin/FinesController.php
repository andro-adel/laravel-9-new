<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Currency;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Fines;
use Auth;
use App\Models\Generalsetting;
use Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class FinesController extends Controller
{
    public function  __construct(){
        
    }
    
    //*** JSON Request
    public function datatables(){
        $datas = Fines::all();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(Fines $data) {
                                $name = mb_strlen(strip_tags($data->vendor->name),'utf-8') > 50 ? mb_substr(strip_tags($data->vendor->name),0,50,'utf-8').'...' : strip_tags($data->vendor->name);
                                return $name;
                            })
                            ->editColumn('fine', function(Fines $data) {
                                $sign = Currency::where('is_default','=',1)->first();
                                $price = round($data->fine * $sign->value , 2);
                                $price = $sign->sign.$price ;
                                return  $price;
                            })
                            ->editColumn('comment', function(Fines $data) {
                                 $comment = mb_strlen(strip_tags($data->comment),'utf-8') > 50 ? mb_substr(strip_tags($data->comment),0,50,'utf-8').'...' : strip_tags($data->comment);
                                return $comment;
                            })
                            ->addColumn('action', function(Fines $data) {
                                $catalog = $data->type == 'Physical' ? ($data->is_catalog == 1 ? '<a href="javascript:;" data-href="' . route('admin-prod-catalog',['id1' => $data->id, 'id2' => 0]) . '" data-toggle="modal" data-target="#catalog-modal" class="delete"><i class="fas fa-trash-alt"></i> Remove Catalog</a>' : '<a href="javascript:;" data-href="'. route('admin-prod-catalog',['id1' => $data->id, 'id2' => 1]) .'" data-toggle="modal" data-target="#catalog-modal"> <i class="fas fa-plus"></i> Add To Catalog</a>') : '';
                                return '
                                <div class="godropdown">
                                    <button class="go-dropdown-toggle"> 
                                            Actions
                                            <i class="fas fa-chevron-down">
                                            </i>
                                    </button>
                                <div class="action-list">
                                <a href="' . route('admin.fine.imposed',$data->user_id) . '">
                                    <i class="fas fa-edit"></i>
                                    Add new fine
                                </a>
                                    <a href="' . route('admin.fine.destroy',$data->id) . '" class="delete">
                                    <i class="fas fa-trash-alt"></i>
                                    Delete
                                    </a>
                                </div>
                                </div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    
    //*** JSON Request
    public function datatables_vendor(){
        $datas = User::where('is_vendor','=','2')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(User $data) {
                                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                                return $name;
                            })
                            ->editColumn('email', function(User $data) {
                                $name = mb_strlen(strip_tags($data->email),'utf-8') > 50 ? mb_substr(strip_tags($data->email),0,50,'utf-8').'...' : strip_tags($data->email);
                                return $name;
                            })
                            ->addColumn('action', function(User $data) {
                                return '
                                <div class="godropdown">
                                    <button class="go-dropdown-toggle"> 
                                            Actions
                                            <i class="fas fa-chevron-down">
                                            </i>
                                    </button>
                                <div class="action-list">
                                    <a href="'. route('admin.fine.imposed',$data->id) . '"class="delete">
                                     <i class="fas fa-edit"></i>
                                    Add Fine
                                    </a>
                                </div>
                                </div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    
    public function index(){
        $fines = Fines::all();
        return view('admin.fines.index');
    }
    
    public function create(){
        
        $vendors = User::where('is_vendor','=','2')->get();

        return view('admin.fines.create',compact('vendors',$vendors)); 
    }
    
    public function imposed($id){
        $user = User::find($id);
        $fines = $user->fines;
        return view('admin.fines.imposed',['user'=>$user,'fines'=>$fines]); 
    }
    
    public function store(Request $request,$id){
        
        $fine = new Fines();
        
        $fine->fine = $request->fine;
        
        $fine->comment = $request->comment;
        
        $fine->user_id = $id;
        
        $fine->save();
        
        return redirect(route('admin.fines'));
    }
    
    public function edit(){
        $fine = Generalsetting::all();
        return response()->json(array('data'=> $fine[0]->fine_value), 200);
    }
    
    public function update(Request $request){
        $fine = Generalsetting::all();
        //$fine[0]->fine_value = empty($fine[0]->fine_value) ? json_encode(array($request->fine_value)) :json_encode([json_decode($fine[0]->fine_value,true),$request->fine_value]);
        
        $fine_arr = [];
        if(empty($fine[0]->fine_value)){
            $fine_arr = array('fines'=>array($request->fine_value));
        }
        else{
            $arr = json_decode($fine[0]->fine_value,true);
            $arr [] = $request->fine_value;
            $arr[] = $request->new_val;
            $fine_arr = $arr;
        }
        $fine[0]->fine_value = json_encode($fine_arr);
        $fine[0]->save();
        return redirect(route('admin.fines'));
    }
    
    public function destroy(Fines $id){
        $id->delete();
        return redirect()->back();
    }
}