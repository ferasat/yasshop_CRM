<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowcartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rowcarts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cart_id')->index();
            $table->string('product_name')->nullable(); // نام محصول از وکامرس
            $table->enum('type_sale' , ['عمده' , 'تک فروشی'])->default('تک فروشی')->nullable(); // نوع فروش
            $table->string('product_ID')->nullable(); // ایدی محصول از وکامرس
            $table->string('sku')->nullable(); // شناسه محصول از وکامرس
            $table->integer('quantity')->nullable(); // تعداد محصولی که می خواد
            $table->string('pic')->nullable();
            $table->integer('price')->nullable(); // قیمت محصول
            $table->integer('price_buy')->nullable(); // قیمت خرید محصول
            $table->string('off')->nullable();
            $table->integer('profit')->nullable();  //سود این فروش
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
        Schema::dropIfExists('rowcarts');
    }
}
