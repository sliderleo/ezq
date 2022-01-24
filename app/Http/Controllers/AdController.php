<?php

namespace App\Http\Controllers;
use App\Models\Ad;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad= Ad::select('id','status','ads_img')->orderBy('status','desc')->paginate(3);
        return view('admin/viewAd', compact('ad'));
    }

    public function apiIndex()
    {
        return Ad::all()->where('status',1);
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
            $request->validate([
                'ads_img'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $input = $request->all();
            if ($image = $request->file('ads_img')) {
                $destinationPath = 'image/pic_ads/';
                $sImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sImage);
                $input['ads_img'] = "$sImage";
            } 
            Ad::create($input);
            Toastr::success('Ad Added!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ad::find($id);
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
        try{
            $ad= Ad::find($id);
            $request->validate([
                'ads_img'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $input = $request->all();
            if ($image = $request->file('ads_img')) {
                $destination = 'image/pic_ads/'.$ad->ads_img;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $destinationPath = 'image/pic_ads/';
                $sImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sImage);
                $input['ads_img'] = "$sImage";
            }else{
                unset($input['ads_img']);
            }  
            $ad->update($input);
            Toastr::success('Ad Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $ad= Ad::find($id);
            $destination = 'image/pic_ads/'.$ad->ads_img;
            if(File::exists($destination)){
                File::delete($destination);
            }
            Ad::destroy($id);
            Toastr::success('Ad Deleted!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    /**
     * Search with name
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Ad::where('name','like', '$'.$name.'$')->get();
    }

    public function edit($id)
    {
        $ads = Ad::find($id);
        return view('admin/editAds', compact('ads'));
    }

    public function updateStatus(Request $request){
        try{
            $ads = Ad::find($request->id);
            $ads->status = $request->status;
            $ads->save();
            Toastr::success('Status Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
        
    }

    public function getAd(){
        $ads = Ad::all()->where('status', 1)->random(1);
        return $ads;
    }
}
