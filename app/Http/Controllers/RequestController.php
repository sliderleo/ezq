<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class RequestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Requests::all();
    }

    public function webIndex(){
        $pending= Requests::all()->where('status',0);
        $requestNew =Requests::whereDate('created_at', Carbon::today())->get();
        $requestNewCount = count($requestNew);
        return view('admin/pending', compact('requestNewCount','pending'));
    }

    public function showRequest($id){
        $pending = Requests::select("requests.id","requests.store_name","requests.address","requests.contact","requests.desc","requests.email","requests.status","vendors.name as vendor_name")
                                ->leftJoin("vendors","vendors.id","=","requests.vendor_id")->where('requests.id',$id)->get();  
        return view('admin/viewPending', compact('pending'));
    }

    public function approve($id){
        try{
            $pending = Requests::find($id);
            $pending->status = 1;
            $pending->save();
            Toastr::success('Request Approved!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('Try Again!', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->action([RequestController::class, 'webIndex']);
    }

    public function reject($id){
        try{
            $pending = Requests::find($id);
            $pending->status = 2;
            $pending->save();
            Toastr::success('Request Rejected!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('Try Again!', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->action([RequestController::class, 'webIndex']);
    }

}
