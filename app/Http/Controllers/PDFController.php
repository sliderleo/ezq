<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Store;
class PDFController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $store = Store::where('id',$id)->get();
        $data = [
            'name' => $store[0]['name'],
            'id' => $store[0]['id'],
            'address' => $store[0]['address'],
        ];
        $pdf = PDF::loadView('vendors/qrPDF', $data);
        return $pdf->download('ezq-qrcode.pdf');
    }
}
