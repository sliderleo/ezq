<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Brian2694\Toastr\Facades\Toastr;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::select('id','status','banner_img')->orderBy('status','desc')->paginate(3);
        return view('admin/viewBanner', compact('banner'));
    }

    public function apiIndex()
    {
        return Banner::select("banner_img")->where('status',1)->get();
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
                'banner_img'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $input = $request->all();
            if ($image = $request->file('banner_img')) {
                $destinationPath = 'image/banner/';
                $sImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sImage);
                $input['banner_img'] = "$sImage";
            }
            Banner::create($input); 
            Toastr::success('Banner Added!', 'Success', ["positionClass" => "toast-top-right"]);
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
        return Banner::find($id);
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
            $banner= Banner::find($id);
            $request->validate([
                'banner_img'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $input = $request->all();
            if ($image = $request->file('banner_img')) {
                $destination = 'image/banner/'.$banner->banner_img;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $destinationPath = 'image/banner/';
                $sImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sImage);
                $input['banner_img'] = "$sImage";
            }else{
                unset($input['banner_img']);
            } 
            $banner->update($input);
            Toastr::success('Banner Updated!', 'Success', ["positionClass" => "toast-top-right"]);
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
            $banner = Banner::find($id);
            $destination = 'image/banner/'.$banner->banner_img;
            if(File::exists($destination)){
                File::delete($destination);
            }
            Banner::destroy($id);
            Toastr::success('Banner Deleted!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin/editBanner', compact('banner'));
    }

    public function updateStatus(Request $request){
        try{
            $banner = Banner::find($request->id);
            $banner->status = $request->status;
            $banner->save();
            Toastr::success('Status Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
        
    }
}
