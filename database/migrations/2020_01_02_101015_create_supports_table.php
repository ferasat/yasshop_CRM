<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id'); // به وجود آورنده درخواست پشتیبانی
            $table->string('audience_id')->nullable(); // مخاطب درخواست پشتیبانی
            $table->string('subject');
            $table->string('department');
            $table->longText('text')->nullable();
            $table->string('file')->nullable();
            $table->string('warrantor')->nullable(); // کسی که جوابگوی درخواست هست
            $table->string('status')->nullable(); // وضعیت درخواست می خواند باز باشد یا بسته
            $table->string('priority')->nullable(); // اولویت این موضوع : مهم - عادی - مشورت
            $table->timestamps();
        });

        Schema::create('subsupports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id'); // به وجود آورنده درخواست پشتیبانی
            $table->string('audience_id')->nullable(); // مخاطب درخواست پشتیبانی
            $table->string('subject');
            $table->string('department');
            $table->longText('text')->nullable();
            $table->string('file')->nullable();
            $table->string('warrantor')->nullable(); // کسی که جوابگوی درخواست هست
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
