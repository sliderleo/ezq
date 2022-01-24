<?php

namespace App\Charts;
use App\Models\User;
use App\Models\Vendor;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use App\Models\Receipt;
class UsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $user = User::all();  
        $userCount = count($user);
        $vendor = Vendor::all();
        $vendorCount = count($vendor);
        return $this->chart->pieChart()
            ->setTitle('Customer & Vendor Ratio')
            ->setSubtitle('Customer and Vendor')
            ->addData([$userCount, $vendorCount])
            ->setLabels(['User (Customer)', 'Vendor']);
    }

    public function lineBuild(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $user = User::all()->where('status',1)->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('m');
         });
         $usermcount = [];
         $userArr = [];
        foreach ($user as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }

        $vendor = Vendor::all()->where('status',1)->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('m');
         });
         $vendormcount = [];
         $vendorArr = [];
        foreach ($vendor as $key => $value) {
            $vendormcount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($vendormcount[$i])){
                $vendorArr[$i] = $vendormcount[$i];    
            }else{
                $vendorArr[$i] = 0;    
            }
        }

        return $this->chart->lineChart()
            ->setTitle('User & Vendor Joined')
            ->setSubtitle('Number of User & Vendor')
            ->addData('User (Customer)', [$userArr[1],$userArr[2],$userArr[3],$userArr[4],$userArr[5],$userArr[6],$userArr[7],$userArr[8],$userArr[9],$userArr[10],$userArr[11],$userArr[12]])
            ->addData('Vendor', [$vendorArr[1],$vendorArr[2],$vendorArr[3],$vendorArr[4],$vendorArr[5],$vendorArr[6],$vendorArr[7],$vendorArr[8],$vendorArr[9],$vendorArr[10],$vendorArr[11],$vendorArr[12]])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December']);
    }

    public function analyticsMonthly(Request $request): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $value = $request->session()->get('LoggedUser');
        $store = Store::select('id')->where('vendor_id',$value)->get();
        $id = $store[0]['id'];
        $sales = Receipt::all()->where('store_id',id)->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('m');
         });
         $salesCount = [];
         $salesArr = [];
        foreach ($sales as $key => $value) {
            $salesCount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($salesCount[$i])){
                $salesArr[$i] = $salesCount[$i];    
            }else{
                $salesArr[$i] = 0;    
            }
        }

        return $this->chart->lineChart()
            ->setTitle('Sales by Month')
            ->setSubtitle('User & Vendor Join Time by Month')
            ->addData('Sales (RM)', [$salesArr[1],$salesArr[2],$salesArr[3],$salesArr[4],$salesArr[5],$salesArr[6],$salesArr[7],$salesArr[8],$salesArr[9],$salesArr[10],$salesArr[11],$salesArr[12]])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December']);
    }

    public function adminMonthly(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $sales = Receipt::all()->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('m');
         });
         $salesCount = [];
         $salesArr = [];
        foreach ($sales as $key => $value) {
            $salesCount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($salesCount[$i])){
                $salesArr[$i] = $salesCount[$i];    
            }else{
                $salesArr[$i] = 0;    
            }
        }

        return $this->chart->lineChart()
            ->setTitle('Sales by Month')
            ->setSubtitle('Number of Transaction')
            ->addData('Number of Transaction', [$salesArr[1],$salesArr[2],$salesArr[3],$salesArr[4],$salesArr[5],$salesArr[6],$salesArr[7],$salesArr[8],$salesArr[9],$salesArr[10],$salesArr[11],$salesArr[12]])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December']);
    }
}
