<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RowOrderByProduct extends Migration
{

    public function up()
    {
        Schema::create('rowbyproduct', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rowby_id')->nullable()->index();
            $table->integer('product_ID')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('product_name')->nullable();
            $table->string('pic')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
}
