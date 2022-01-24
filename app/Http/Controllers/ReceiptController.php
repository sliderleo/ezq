<?php

namespace App\Http\Controllers;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use App\Exports\DataExport;
use App\Exports\Data2Export;
use App\Exports\monthlyExport;
use App\Exports\yearExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Charts\MonthlySalesChart;
class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function success($price,$user_id,$store_id){
        $receipt = new Receipt();
        $receipt->price = $price;
        $receipt->user_id = $user_id;
        $receipt->store_id=$store_id;
        $receipt->save();
        return view('success');
    }
    public function index()
    {
        return  Reciept::all();
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
            'user_id'=>'required|integer',
            'store_id'=>'required|integer',
            'price'=>'required|numeric',
           
        ]);
        return Item::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Receipt::find($id);
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
        $receipt= Receipt::find($id);
        $receipt= update($request->all());
        return $receipt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Receipt::destroy($id);
    }

    public function getReceipt($id){
        $receipt=Receipt::select("receipts.id","receipts.price","stores.name as store_name", "receipts.created_at")->leftJoin("stores","stores.id","=","receipts.store_id")->where('user_id',$id)->orderBy("receipts.id", "desc")->get();
        return $receipt;
    }

    public function analyticsPage(MonthlySalesChart $chart,Request $request){
        $value = $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$value)->get();
        $id = $store[0]['id'];
        $receipt = Receipt::whereDate('created_at', Carbon::today())->where('store_id',$id)->get();
        $receiptM = Receipt::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('store_id',$id)->get();
        $receiptCount= count($receipt);
        $receiptMCount= count($receiptM);
        return view('vendors/analytics',compact('receiptCount','store','receiptMCount'), ['chart' => $chart->build($id)]);
        
    }

    public function todaySales(Request $request){
        $value = $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$value)->get();
        $id = $store[0]['id'];
        $receipt = Receipt::select('receipts.id','receipts.price','receipts.created_at','users.name as user_name')->leftJoin('users','users.id','=','receipts.user_id')->whereDate('receipts.created_at', Carbon::today())->where('receipts.store_id',$id)->paginate(8);
        $total = Receipt::select('price')->whereDate('created_at', Carbon::today())->where('store_id',$id)->sum('price');
        echo $total;
        return view('vendors/todaySales',compact('receipt','store','total'));
    }

    public function monthlySales(Request $request){
        $value = $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$value)->get();
        $id = $store[0]['id'];
        $receipt = Receipt::select('receipts.id','receipts.price','receipts.created_at','users.name as user_name')->leftJoin('users','users.id','=','receipts.user_id')->whereMonth('receipts.created_at', date('m'))->whereYear('receipts.created_at', date('Y'))->where('receipts.store_id',$id)->paginate(8);
        $total = Receipt::select('price')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('store_id',$id)->sum('price');
        return view('vendors/monthlySales',compact('receipt','store','total'));
    }

    public function exportMonthly(Request $request){
        $value = $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$value)->get();
        $id = $store[0]['id'];
        return Excel::download(new DataExport($id), 'monthly-sales-vendor.xlsx');
    }

    public function exportDaily(Request $request){
        $value = $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$value)->get();
        $id = $store[0]['id'];
        return Excel::download(new Data2Export($id), 'todays-sales-vendor.xlsx');
    }

    public function monthlySalesA(Request $request){
        $receipt = Receipt::select('receipts.id','receipts.price','receipts.created_at','users.name as user_name','stores.name as store_name')->leftJoin('users','users.id','=','receipts.user_id')->leftJoin('stores','stores.id','=','receipts.store_id')->whereMonth('receipts.created_at', date('m'))->whereYear('receipts.created_at', date('Y'))->paginate(8);
        $total = Receipt::select('price')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('price');
        return view('admin/monthlySales',compact('receipt','total'));
    }

    public function yearSalesA(Request $request){
        $receipt = Receipt::select('receipts.id','receipts.price','receipts.created_at','users.name as user_name','stores.name as store_name')->leftJoin('users','users.id','=','receipts.user_id')->leftJoin('stores','stores.id','=','receipts.store_id')->whereYear('receipts.created_at', date('Y'))->paginate(8);
        $total = Receipt::select('price')->whereYear('created_at', date('Y'))->sum('price');
        return view('admin/yearSales',compact('receipt','total'));
    }

    public function exportMonthlyA(Request $request){
        return Excel::download(new monthlyExport(), 'monthly-sales-admin.xlsx');
    }

    public function exportYearlyA(Request $request){
        return Excel::download(new yearExport(), 'yearly-sales-admin.xlsx');
    }
}
//['chart' => $chart->analyticsMonthly()]