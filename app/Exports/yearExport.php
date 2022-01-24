<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Store;
use App\Models\User;
use App\Models\Receipt;

class yearExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $receipt = Receipt::select('receipts.id','receipts.price','receipts.user_id','users.name as user_name','receipts.store_id','stores.name as store_name','receipts.created_at')->leftJoin('users','users.id','=','receipts.user_id')->leftJoin('stores','stores.id','=','receipts.store_id')->whereYear('receipts.created_at', date('Y'))->get();
        return $receipt;
    }
}
