<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Item::all();
    }

    public function webIndex(Request $request){
        $vendor_id= $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$vendor_id)->get();
        $id = $store[0]['id'];
        $items = Item::select('items.id','items.name','items.price','items.barcode','items.item_img','items.status','categories.name as c_name')
            ->leftJoin("categories","categories.id","=","items.c_id")
            ->where("store_id",'=',$id)
            ->paginate(3);
        return view('vendors/viewItems', compact('items','store'));
        
    }

    public function inactiveWebIndex(Request $request){
        $zero = 0;
        $vendor_id= $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$vendor_id)->get();
        $id = $store[0]['id'];
        $items = Item::select('items.id','items.name','items.price','items.barcode','items.item_img','items.status','categories.name as c_name')
            ->leftJoin("categories","categories.id","=","items.c_id")
            ->where([["store_id",'=',$id],["items.status","=",$zero]])
            ->paginate(3);
        return view('vendors/viewInactiveI', compact('items'));
    }


    public function mainItemPage(Request $request){
        $vendor_id= $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$vendor_id)->get();
        if(empty($store[0])){
            $store=null;
            return view('/vendors/items', compact('store'));
        }else{
            return view('/vendors/items', compact('store'));
        }
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
                'store_id'=>'required|integer',
                'name'=>'required|max:255',
                'desc'=>'max:255',
                'c_id'=>'required|integer',
                'quantity'=>'required|integer',
                'price'=>'required|numeric',
                'barcode'=>'required|numeric',
                'item_img'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $input = $request->all();
            if ($image = $request->file('item_img')) {
                $destinationPath = 'image/pic_items/';
                $sImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sImage);
                $input['item_img'] = "$sImage";
            }
            Item::create($input); 
            Toastr::success('Item Create!', 'Success', ["positionClass" => "toast-top-right"]);
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
        return Item::find($id);
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
        $item= Item::find($id);
        $item= update($request->all());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Item::destroy($id);
    }

    /**
     * Search with barcode
     *
     * @param  string  $barcode
     * @return \Illuminate\Http\Response
     */
    public function search($store_id,$barcode)
    {
        return Item::where('store_id', $store_id)->where('barcode', $barcode)->get();
    }

    public function superSearch(Request $request)
    {
        $vendor_id= $request->session()->get('LoggedUser');
        $store_id = Store::select('id')->where('vendor_id',$vendor_id)->get();
        $id = $store_id[0]['id'];
        $search= $request->search;
        $items = Item::where('store_id', $id)->where('id','like', '%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%')->paginate(3);
        if(count($items)>0){
            return view('vendors/viewItems', compact('items'));
        }else return view ('vendors/viewItems')->with('message','No Details found. Try to search again !');
    }

    public function showItem($id)
    {
        $items = Item::select("items.id","items.name","categories.name as category","items.desc","items.price","items.barcode","items.item_img","items.status")->leftJoin("categories","categories.id","=","items.c_id")->where('items.id',$id)->get();  
        return view('vendors/itemPage', compact('items'));
       
    }

    public function addItemPage(Request $request){
        $vendor_id= $request->session()->get('LoggedUser');
        $store_id = Store::select('id')->where('vendor_id',$vendor_id)->get();
        $id = $store_id[0]['id'];
        $category = Category::all();
        return view('vendors/additem', compact('id','category'));
    }

    public function editPage(Request $request,$id){
        $vendor_id= $request->session()->get('LoggedUser');
        $store_id = Store::select('id')->where('vendor_id',$vendor_id)->get();
        $items = Item::where('id',$id)->get();
        $category = Category::all();
        return view('vendors/editItem', compact('items','category','id'));
    }

    public function editImgPage($id){
        $items = Item::select('id','item_img','name')->where('id',$id)->get();
        return view('vendors/editItemImg', compact('items'));
    }

    public function updateInfo(Request $request,$id){
        try{
            $item= Item::find($id);
            $item->name = $request->name;
            $item->price = $request->price;
            $item->desc = $request->desc;
            $item->barcode = $request->barcode;
            $item->c_id = $request->c_id;
            $item->save();
            Toastr::success('Item Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->action([ItemController::class, 'webIndex']);
    }

    public function udpateImg(Request $request,$id){
        try{
            $item= Item::find($id);
            $request->validate([
                'item_img'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $input = $request->all();
            if ($image = $request->file('item_img')) {
                $destination = 'image/pic_items/'.$item->item_img;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $destinationPath = 'image/pic_items/';
                $sImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sImage);
                $input['item_img'] = "$sImage";
            }else{
                unset($input['item_img']);
            } 
            $item->update($input);
            Toastr::success('Image Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->action([ItemController::class, 'webIndex']);
    }


    public function deleteItem(Request $request,$id){
        
        try{
            $item = Item::find($id);
            $destination = 'image/pic_items/'.$item->item_img;
            if(File::exists($destination)){
                File::delete($destination);
            }
            Item::destroy($id);
            Toastr::success('Item Deleted!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

    public function updateStatus(Request $request){
        try{
            $item = Item::find($request->id);
            $item->status = $request->status;
            $item->save();
            Toastr::success('Status Updated!', 'Success', ["positionClass" => "toast-top-right"]);
        }catch(Exception $e){
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }

}
