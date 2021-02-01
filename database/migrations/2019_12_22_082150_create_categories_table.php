<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('word');
            $table->string('subcat')->nullable();
            $table->boolean('issub')->nullable(); // زیر دسته هست یا نه
            $table->boolean('havesub')->nullable(); // زیر دسته دارد یا نه
            $table->string('url')->nullable();
            $table->string('picture')->nullable();
            $table->string('icon')->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('metaDescription')->nullable();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            'word' => 'دستبندی نشده',
            'subcat' => 'سردسته',
            'issub' => false,
            'havesub' => false,
            'url' => 'no-category',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
