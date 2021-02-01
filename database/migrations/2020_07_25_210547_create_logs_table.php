<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // نام لاگ
            $table->string('department');  // در چه قسمتی لاگ انداخته
            $table->string('key')->nullable(); // مقدار اون چیه
            $table->string('value')->nullable(); // مقدار اون چیه
            $table->string('user')->nullable();
            $table->string('uniqueCode')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
