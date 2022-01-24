<?php

namespace App\Http\Controllers;
use App\Models\Store;
use App\Models\Item;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;


class StoreController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::select("stores.id","stores.name","stores.address","stores.contact","stores.store_img","stores.status","vendors.name as vendor_name")
                                ->leftJoin("vendors","vendors.id","=","stores.vendor_id")->paginate(4);  
        return view('admin/viewStore', compact('store'));
    }

    public function bannedIndex()
    {
        $store = Store::select("stores.id","stores.name","stores.address","stores.contact","stores.store_img","stores.status","vendors.name as vendor_name")
                                ->leftJoin("vendors","vendors.id","=","stores.vendor_id")->get()->where('status',2);  
        return view('admin/bannedStore', compact('store'));
    }

    public function apiIndex()
    {
        return Store::all()->where('status',1);
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
                'name'=>'required|max:255|min:4',
                'vendor_id'=>'required|integer',
                'contact'=>'required',
                'address'=>'required|max:255',
                'store_img'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $input = $request->all();
            if ($image = $request->file('store_img')) {
                $destinationPath = 'image/store';
                $sImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sImage);
                $input['store_img'] = "$sImage";
            } 
            Store::create($input); 
            Toastr::success('All Good!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->action([StoreController::class, 'vendorStore']);
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
        return Store::find($id);
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
        $store= Store::find($id);
        $store= update($request->all());
        return $store;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return Store::destroy($id);
    }

    /**
     * Search with id
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function search($id)
    {
        return Store::where('id','like', '%'.$id.'%')->get();
    }

    public function showStore($id)
    {
        $store = Store::select("stores.id","stores.name","stores.address","stores.contact","stores.store_img","stores.status","vendors.name as vendor_name")
                                ->leftJoin("vendors","vendors.id","=","stores.vendor_id")->where('stores.id',$id)->get();  
        $items = Item::select("items.id","items.name","categories.name as category","items.desc","items.price","items.barcode","items.item_img")->leftJoin("categories","categories.id","=","items.c_id")->where('items.store_id',$id)->get();  
        return view('admin/storePage', compact('store','items'));
    }

    public function superSearch(Request $request)
    {
        $search= $request->search;
        $store = Store::where('id','like', '%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%')->get();
        if(count($store)>0){
            return view('admin/searchStore', compact('store'));
        }else return view ('admin/searchStore')->with('message','No Details found. Try to search again !');
    }

    public function banStore($id){
        try{
            $store = Store::find($id);
            $store->status = 2;
            $store->save();
            Toastr::warning('Store Banned', 'Banned', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    public function unbanStore($id){
        try{
            $store = Store::find($id);
            $store->status = 1;
            $store->save();
            Toastr::success('Store Unbanned', 'Unbanned', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    public function updateStatus(Request $request){
        try{
            $store = Store::find($request->id);
            $store->status = $request->status;
            $store->save();
            Toastr::success('Status Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
        
    }


    public function vendorStore(Request $request)
    {
        $vendor_id= $request->session()->get('LoggedUser');
        $store_id = Store::select('id')->where('vendor_id',$vendor_id)->get();
        if(empty($store_id[0])){
            $store=null;
            return view('vendors/vendorStore', compact('store'));
        }else{
            $id = $store_id[0]['id'];
            $store = Store::select("stores.id","stores.name","stores.address","stores.contact","stores.store_img","stores.status","vendors.name as vendor_name")
                                    ->leftJoin("vendors","vendors.id","=","stores.vendor_id")->where('stores.id',$id)->get();  
            return view('vendors/vendorStore', compact('store','id'));
        }
        
    }

    public function showSetupPage(Request $request){
        $id= $request->session()->get('LoggedUser');
        return view('vendors/setupStore', compact('id'));
    }

    public function editInfo(Request $request,$id){
        $vendor_id= $request->session()->get('LoggedUser');
        $store = Store::select('id','name','contact','address')->where('vendor_id',$vendor_id)->get();
        return view('vendors/editStore', compact('store'));
    }

    public function updateInfo(Request $request,$id){
        try{
            $store= Store::find($id);
            $store->name = $request->name;
            $store->address = $request->address;
            $store->contact = $request->contact;
            $store->save();
            Toastr::success('Item Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->action([StoreController::class, 'vendorStore']);
    }

    public function editImage($id){
        $store = Store::select('id','store_img','name')->where('id',$id)->get();
        return view('vendors/editStoreImg', compact('store'));
    }

    public function updateImage(Request $request,$id){
        try{
            $item= Store::find($id);
            $request->validate([
                'store_img'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $input = $request->all();
            if ($image = $request->file('store_img')) {
                $destination = 'image/store/'.$item->store_img;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $destinationPath = 'image/store/';
                $sImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sImage);
                $input['store_img'] = "$sImage";
            }else{
                unset($input['store_img']);
            } 
            $item->update($input);
            Toastr::success('Image Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->action([StoreController::class, 'vendorStore']);
    }

    public function getStore(){
        $store = Store::select('id','name','store_img')->where('status',1)->orderBy('created_at','desc')->get(3);
        return $store;
    }
}
