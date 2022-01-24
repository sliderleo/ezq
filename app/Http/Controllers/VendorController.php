<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use App\Models\Receipt;
use App\Models\Store;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->session()->get('LoggedUser');
        $store = Store::select('id','name','status')->where('vendor_id',$value)->get();
        $receipt = Receipt::whereDate('created_at', Carbon::today())->get();
        $receiptM = Receipt::whereMonth('created_at', date('m'))->get();
        $receiptCount= count($receipt);
        $receiptMCount= count($receiptM);
        return view('vendors/vendorHome',compact('receiptCount','store','receiptMCount'));
        
    }

    public function webIndex(){
        $vendor = Vendor::select("id","username","name",'email','contact','status')->paginate(5);  
        return view('admin/viewVendor', compact('vendor'));
    }

    public function bannedIndex(){
        $vendor = Vendor::select("id","username","name",'email','contact','status')->where('status',2)->get();  
        return view('admin/bannedVendor', compact('vendor'));
    }

    public function showVendor(Request $request){
        $vendor_id= $request->session()->get('LoggedUser');
        $vendor = Vendor::select("username","name",'email','contact','status')->where('id',$vendor_id)->get();
        return view('vendors/profile', compact('vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $fields=$request->validate([
                'username'=>'required|max:255|min:4|unique:vendors,username',
                'name'=>'required|max:255|min:4',
                'email'=>'required|email|unique:vendors,email',
                'password'=>'required|string|confirmed',
                'nric'=>'required|string|min:12|max:12|unique:vendors,nric',
                'contact'=>'required|string|min:10|max:12|unique:vendors,contact',
            ]);
                $vendor = Vendor::create([
                    'username' => $fields['username'],
                    'name' => $fields['name'],
                    'email' => $fields['email'],
                    'password' => bcrypt($fields['password']),
                    'nric' => $fields['nric'],
                    'contact' => $fields['contact'],
                ]);
                Toastr::success('Successfully Registered', 'Yay!', ["positionClass" => "toast-top-right"]);
                return redirect()->route('vendorLogin');
        
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Vendor::find($id);
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
        $vendor= Vendor::find($id);
        $vendor= update($request->all());
        return $vendor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Vendor::destroy($id);
    }

    public function banVendor($id){
        try{
            $vendor = Vendor::find($id);
            $vendor->status = 2;
            $vendor->save();
            Toastr::warning('Vendor Banned', 'Banned', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    public function unbanVendor($id){
        try{
            $vendor = Vendor::find($id);
            $vendor->status = 1;
            $vendor->save();
            Toastr::success('Vendor Unbanned', 'Unbanned', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    public function superSearch(Request $request)
    {
        $search= $request->search;
        $vendor = Vendor::where('id','like', '%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%')->get();
        if(count($vendor)>0){
            return view('admin/searchVendor', compact('vendor'));
        }else return view ('admin/searchVendor')->with('message','No Details found. Try to search again !');
    }


    public function check(Request $request){
        try{
            $fields= $request->validate([
                'username'=>'required|max:255',
                'password'=>'required|string|min:8',
            ]);
                //check email first 
                $user = Vendor::where('username',$fields['username'])->first();
                //check password 
                if($user && Hash::check($fields['password'], $user->password)){
                    Toastr::success('Logged In', 'Welcome', ["positionClass" => "toast-top-right"]);
                    $request->session()->put('LoggedUser',$user->id);
                    return redirect('/vendor/home');
                }
        }catch(Exception $e){
            Toastr::warning('Invalid Credentials', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
}
