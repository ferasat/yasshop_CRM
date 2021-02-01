<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->string('user_id');
            $table->longText('text')->nullable();
            $table->string('command')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        DB::table('pages')->insert([
            'subject' => 'یک برگه آزمایشی' ,
            'user_id' => '1' ,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
