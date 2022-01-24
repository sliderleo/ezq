<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Store;
use App\Models\User;
use App\Models\Receipt;

class DataExport implements FromCollection
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
        $receipt = Receipt::select('receipts.id','users.name as user_name','receipts.price','receipts.created_at')->leftJoin('users','users.id','=','receipts.user_id')->whereMonth('receipts.created_at', date('m'))->whereYear('receipts.created_at', date('Y'))->where('receipts.store_id',$this->id)->get();
        return $receipt;
    }
}
