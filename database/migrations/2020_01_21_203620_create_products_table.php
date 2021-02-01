<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->longText('shortDescription')->nullable();
            $table->longText('longDescription')->nullable();
            $table->string('pic')->nullable();
            $table->string('price')->nullable();
            $table->string('priceom')->nullable();
            $table->string('pricekharid')->nullable();
            $table->string('mojodi')->nullable();
            $table->string('kasri')->nullable();
            $table->integer('category')->nullable(); // آیدی دستبندی
            $table->enum('cat_zivar', ['دستبند','انگشتر','گوشواره','گردنبند','پابند','زنجیر','نیم ست','ست','ست کامل'])->nullable(); // آیدی دستبندی
            $table->string('tolidi')->nullable();
            $table->string('numberSeen')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
