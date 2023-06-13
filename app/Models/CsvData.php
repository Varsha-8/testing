<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvData extends Model
{
    use HasFactory;


    public $fillable = [
        'segment','country' ,'product', 'discount_band', 'units_sold', 'mafu_price', 'sale_price', 'gross_sales', 'sales', 'discounts',  'profit',
        'date', 'month_number', 'month_name', 'year'
    ];
}
