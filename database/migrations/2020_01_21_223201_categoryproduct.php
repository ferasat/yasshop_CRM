<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categoryproduct extends Migration
{
    public function up()
    {
        Schema::create('catproduct', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('number')->nullable(); // تعداد محصولات در این دستبندی
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('catproduct');
    }
}
