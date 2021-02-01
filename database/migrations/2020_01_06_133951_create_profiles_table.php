<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('password')->nullable();
            $table->string('name')->nullable();
            $table->string('namelatin')->nullable();
            $table->string('famili')->nullable();
            $table->string('famililatin')->nullable();
            $table->integer('cellphone')->nullable();
            $table->string('email');
            $table->string('adres')->nullable();
            $table->string('sex')->nullable();
            $table->string('codemeli')->nullable();
            $table->string('pasport')->nullable();
            $table->string('cartbanki')->nullable();
            $table->string('shababanki')->nullable();
            $table->string('numberbanki')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('ma')->nullable();
            $table->integer('amount')->nullable();
            $table->enum('level_user' , ['Super Admin', 'Admin', 'Counter', 'User'] )->default('User');
            $table->dateTime('birth')->nullable();
            $table->timestamps();
        });

        DB::table('profiles')->insert([
            'user_id' => '1' ,
            'name' => 'Admin' ,
            'namelatin' => 'مدیر' ,
            'famili' => 'Aseman7' ,
            'email' => 'info@aseman-haftom.com' ,
            'level_user' => 'Super Admin' ,
            'password' => bcrypt('@@Aseman7@@') ,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
