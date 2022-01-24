<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Store;
use App\Models\User;
use App\Models\Receipt;
use Carbon\Carbon;
class Data2Export implements FromCollection
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $receipt = Receipt::select('receipts.id','receipts.price','receipts.created_at','users.name as user_name')->leftJoin('users','users.id','=','receipts.user_id')->whereDate('receipts.created_at', Carbon::today())->where('receipts.store_id',$this->id)->get();
        return $receipt;
    }
}
