<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('level' , ['Admin', 'Seller' , 'Editor' , 'User' , 'Customer'])->nullable()->default('Customer');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            'name' => 'Admin' ,
            'email' => 'info@yasshop.ir' ,
            'level' => 'Admin' ,
            'password' => bcrypt('15971597') ,
        ]);
        DB::table('users')->insert([
            'name' => 'فراست' ,
            'email' => 'amin@yasshop.ir' ,
            'level' => 'Admin' ,
            'password' => bcrypt('15971597') ,
        ]);
        DB::table('users')->insert([
            'name' => 'یاوری' ,
            'email' => 'Yavari@yasshop.ir' ,
            'level' => 'Admin' ,
            'password' => bcrypt('15971597') ,
        ]);
        DB::table('users')->insert([
            'name' => 'شهبازی' ,
            'email' => 'Shahbazi@yasshop.ir' ,
            'level' => 'Seller' ,
            'password' => bcrypt('15921592') ,
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
