<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Admin;
use App\Charts\UsersChart;
use App\Models\Requests;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeWeb(UsersChart $chart, Request $request){
        $user = User::all();  
        $userCount = count($user);
        $userNew =User::whereDate('created_at', Carbon::today())->get();
        $userNewCount = count($userNew);
        $vendor = Vendor::all();
        $vendorCount = count($vendor);
        $vendorNew =Vendor::whereDate('created_at', Carbon::today())->get();
        $vendorNewCount = count($vendorNew);
        $requestNew =Requests::all()->where('status',0);
        $requestNewCount = count($requestNew);
        $admin_id= $request->session()->get('LoggedUser');
        $admin = Admin::select("name")->where('id',$admin_id)->get();
        $sales = Receipt::all();
        $salesCount = count($sales);
        return view('admin/adminHome', compact('salesCount','userCount','userNewCount','vendorCount','vendorNewCount','requestNewCount','admin'), ['chart' => $chart->lineBuild()]);
    }

    public function analyticsWeb(UsersChart $chart){
        return view('admin/analytics', ['pieChart' => $chart->build(),'lineChart' => $chart->lineBuild(), 'monthlyBar'=>$chart->adminMonthly()]);
    }

    public function webIndex(){
        $user = User::select("id","username","name",'email','contact','status')->get();  
        return view('admin/viewUser', compact('user'));
    }

    public function bannedIndex(){
        $user = User::select("id","username","name",'email','contact','status')->where('status',2)->get();  
        return view('admin/bannedUser', compact('user'));
    }
    public function index()
    {
        return  User::all()->where('status',1);
    }

    public function profileAPI($id){
        $user = User::select("name",'nric','email','contact','status')->where('id',$id)->get();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=>'required|max:255|min:4|unique:users,username',
            'name'=>'required|max:255|min:4',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|confirmed',
            'nric'=>'required|string|min:12|max:12|unique:users,nric',
            'contact'=>'required|string|min:10|max:12|unique:users,contact',
        ]);
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user= User::find($id);
        $user= update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }


    public function search($id)
    {
        return Store::where('id','like', '%'.$id.'%')->get();
    }


    public function banUser($id){
        try{
            $user = User::find($id);
            $user->status = 2;
            $user->save();
            Toastr::warning('User Banned', 'Banned', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    public function unbanUser($id){
        try{
            $user = User::find($id);
            $user->status = 1;
            $user->save();
            Toastr::success('User Unbanned', 'Unbanned', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    public function superSearch(Request $request)
    {
        $search= $request->search;
        $user = User::where('id','like', '%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%')->get();
        if(count($user)>0){
            return view('admin/searchUser', compact('user'));
        }else return view ('admin/searchUser')->with('message','No Details found. Try to search again !');
    }
}
