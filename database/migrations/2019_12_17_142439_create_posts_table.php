<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->string('user_id');
            $table->longText('text')->nullable();
            $table->string('category')->nullable();
            $table->string('tag')->nullable();
            $table->string('command')->nullable();
            $table->string('picture')->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('metaDescription')->nullable();
            $table->timestamps();
        });

        DB::table('posts')->insert([
            'subject' => 'یک پست آزمایشی' ,
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
        Schema::dropIfExists('posts');
    }
}
