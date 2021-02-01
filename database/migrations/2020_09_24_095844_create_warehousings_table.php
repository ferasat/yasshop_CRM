<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousingsTable extends Migration
{
    public function up()
    {
        Schema::create('warehousings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('total_inventory')->nullable(); // کل موجودی کالا
            $table->string('financial_cost_of_products')->nullable(); // ارزش مالی کالا ها- قیمت خرید
            $table->string('sales_value_of_products')->nullable(); // ارزش فروش محصولات
            $table->string('total_profit')->nullable(); //
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehousings');
    }
}
