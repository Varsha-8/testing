<?php

namespace App\Http\Controllers;

use App\Models\CsvData;
use Illuminate\Http\Request;
use DB;

class CsvController extends Controller
{
    public function index()
    {
        $users = [];

        if (($open = fopen(storage_path() . "/Financial Sample - Sheet1.csv", "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {

                
                $users[] = $data;
            }
           
            fclose($open);
        }

        $file =fopen(storage_path() . "/Financial Sample - Sheet1.csv", "r");
        $importData_arr = array();
        $i = 0;
      
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata );
            
            // Skip first row (Remove below comment if you want to skip the first row)
            if($i == 0){
               $i++;
               continue; 
            }

            for ($c=0; $c < $num; $c++) {
              
                $importData_arr[$i][] = $filedata [$c];
            }
            $i++;
         }
         fclose($file);

         // Insert to MySQL database
         foreach($importData_arr as $importData){
       
           $insertData = array(
            'segment' => $importData[0],
            'country' => $importData[1],
            'product' => $importData[2],
            'discount_band' =>$importData[3], 
            'units_sold' =>$importData[4], 
            'mafu_price' =>$importData[5], 
            'sale_price' =>$importData[6], 
            'gross_sales' =>$importData[7], 
            'sales' =>$importData[9],
            'discounts' =>$importData[8],
            'cogs' =>$importData[10],
            'profit' =>$importData[11], 
            'date' =>$importData[12],
            'month_number' =>$importData[13], 
            'month_name' =>$importData[14],
            'year' =>$importData[15], 
            );

            
            CsvData::insert($insertData);

         }
         $csvData= CsvData::get();
         return view('show',compact('csvData'));
    }


    public function show()
    {
        // $csvData= CsvData::get();
        $csvData= CsvData::select('product')->distinct()->get();

        $highest= CsvData::select('id',DB::raw("SUM(sales) as TotalAMount"),'product',DB::raw("SUM(sale_price) as HighestSales"),'month_name')->latest()->orderByRaw('SUM(sales) DESC')->first();
       
        $graph_data= CsvData::select(DB::raw("SUM(sales) as TotalAMount"),'product',DB::raw("SUM(sale_price) as HighestSales"),'month_name')->latest()->orderByRaw('SUM(sales) DESC')->get();
        

        $graphData = CsvData::selectRaw('sum(sales) as total_sales,month_name,year')
            ->groupBy('month_name', 'year')
            ->get();

        $labels = $graphData->pluck('month_name')->toArray();
        $data = $graphData->pluck('total_sales')->toArray();

        $final_out = [];
        
        if ($csvData->count() > 0) {
            foreach ($csvData as $data) {
             
                $product_detail =CsvData::where('product',$data->product)->first();

                $out['id'] = $product_detail->id;
                $out['product'] = $data->product;

                $out['segment'] = $product_detail->segment;
                $out['country'] = $product_detail->country;

                $item = CsvData::where('product',$data->product)->get();

                $out['total_sales'] =$item->sum('sales');
                $out['units_sold'] =$item->sum('sale_price');

                $final_out[] = $out;
            }
        }

        
        return view('show',compact('final_out','highest','data','labels','graphData'));
    }

 
}
