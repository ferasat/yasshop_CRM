<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAccountingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });

        DB::table('accountings')->insert([
            'name' => 'سود کل',
            'key' => 'totalProfit',
            'value' => '0'
        ]);
        DB::table('accountings')->insert([
            'name' => 'کل موجودی',
            'key' => 'totalInventory',
            'value' => '0'
        ]);
        DB::table('accountings')->insert([
            'name' => 'هزینه بسته بندی',
            'key' => 'packagingCost',
            'value' => '1000'
        ]);
        DB::table('accountings')->insert([
            'name' => 'حقوق',
            'key' => 'salary',
            'value' => '0'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accountings');
    }
}
