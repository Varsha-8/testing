<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('segment');
            $table->string('country');
            $table->string('product');
            $table->string('discount_band');
            $table->string('units_sold');
            $table->string('mafu_price');
            $table->string('sale_price');
            $table->string('gross_sales');
            $table->string('sales');
            $table->string('discounts');
            $table->string('cogs');
            $table->string('profit');
            $table->string('date');
            $table->string('month_number');
            $table->string('month_name');
            $table->string('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csv_data');
    }
}
