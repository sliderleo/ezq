<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

class AdminController extends Controller
{
    public function login(Request $request){
        $fields= $request->validate([
            'username'=>'required|max:255',
            'password'=>'required|string|min:8',
        ]);

        //check email first 
        $user = Admin::where('username',$fields['username'])->first();

        //check password 
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message'=>'Invalid Credentials!',
            ],401);
        }

        $token = $user->createToken('ezqAdmin')->plainTextToken;

        $response = [
            'user'=> $user,
            'token'=> $token
        ];

        return response($response,201);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Admin::all();
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
            'username'=>'required|unique|max:255',
            'name'=>'required|max:255',
            'password'=>'required|min:8'
        ]);
        return Admin::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Admin::find($id);
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
        $admin= Admin::find($id);
        $admin= update($request->all());
        return $admin;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Admin::destroy($id);
    }

    public function check(Request $request){
        try{
            $fields= $request->validate([
                'username'=>'required|max:255',
                'password'=>'required|string|min:8',
            ]);
    
            //check email first 
            $user = Admin::where('username',$fields['username'])->first();
            //check password 
            if($user && Hash::check($fields['password'], $user->password)){
                Toastr::success('Logged In', 'Welcome', ["positionClass" => "toast-top-right"]);
                $request->session()->put('LoggedUser',$user->id);
                return redirect('/admin/home');
            }
    
        }catch(Exception $e){
            Toastr::warning('Invalid Credentials', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function adminHome(){
        $data = ['LoggedUserInfo'=>Admin::where('id','=',session('LoggedUser'))->first()];
        return view('admin/adminHome',$data);
    }


    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/admin/login');
        }
    }
}

