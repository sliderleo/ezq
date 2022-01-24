<?php

namespace App\Charts;
use Carbon\Carbon;
use App\Models\Receipt;
use App\Models\User;
use App\Models\Vendor;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlySalesChart
{
    protected $chart,$id;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
       
    }

    public function build($id): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $receipt=Receipt::all()->where('store_id',$id)->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('m');
         });
         $receiptAmount = [];
         $receiptArr = [];
         foreach ($receipt as $key => $value) {
            $receiptAmount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($receiptAmount[$i])){
                $receiptArr[$i] = $receiptAmount[$i];    
            }else{
                $receiptArr[$i] = 0;    
            }
        }
        return $this->chart->lineChart()
        ->setTitle('Sales for This Year')
        ->setSubtitle('Number of Sales by Month')
        ->addData('User (Customer)', [$receiptArr[1],$receiptArr[2],$receiptArr[3],$receiptArr[4],$receiptArr[5],$receiptArr[6],$receiptArr[7],$receiptArr[8],$receiptArr[9],$receiptArr[10],$receiptArr[11],$receiptArr[12]])
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December']);
    }
}
