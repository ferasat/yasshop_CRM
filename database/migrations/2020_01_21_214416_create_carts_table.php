<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{

    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer'); // نام مشتری
            $table->string('customer_cellphone')->index(); // شماره تماس
            $table->string('customer_zipcode')->nullable(); // کد پستی
            $table->longText('customer_address')->nullable(); // آدرس پستی
            $table->string('customer_email')->nullable(); // ایمیل مشتری
            $table->integer('price')->nullable();  // قیمت کل سفارش
            $table->integer('profit_sales')->nullable();  // سود فروش
            $table->string('srcsale')->nullable(); // محل سفارش
            $table->longText('details')->nullable(); // توصیه های مشتری
            $table->longText('pesonaldata')->nullable(); // اطلاعات مشتری
            $table->string('status')->nullable(); //  وضعیت سفار ش مثلا ناهیی شده و یا کسری و یا برگشتی
            $table->integer('status_id')->nullable(); // 2 : انتخاب کالا || 3: ثبت اطلاعات || 4:ثبت نهایی سفارش || 5:بستبندی شده و برای چک || 6: کسری داره || 7:ارسال شد || 8: اطلاعات ارسال مشکل داره || 9: سفارش کنسل کرد || 10: موجود نیست باید عوض کند
            $table->string('codemarsoleh')->nullable(); // کد مرسوله پست
            $table->string('priceersal')->nullable(); // هزینه ارسال
            $table->string('typepost')->nullable(); // پیشتاز یا سفارشی
            $table->string('typeprice')->nullable(); // آنلاین یا پرداخت در محل
            $table->string('picfish')->nullable(); // تصویر فیش یا رسید
            $table->string('codevarizi')->nullable(); // کد پیگیری واریزی
            $table->longText('note')->nullable(); // یادداشت های ادمین
            $table->longText('description')->nullable(); // توضیحات های ادمین
            $table->string('off')->nullable();
            $table->string('opt1')->nullable();
            $table->enum('type_sale' , ['عمده' , 'تک فروشی'])->default('تک فروشی')->nullable(); // نوع فروش
            $table->integer('user_id')->nullable(); // کاربر ثبت کننده
            $table->string('user_name')->nullable(); // کاربر ثبت کننده
            $table->timestamps();
        });

        /*Schema::create('rowcarts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cart_id')->index();
            $table->string('product_name')->nullable(); // نام محصول از وکامرس
            $table->string('product_ID')->nullable(); // ایدی محصول از وکامرس
            $table->string('sku')->nullable(); // شناسه محصول از وکامرس
            $table->integer('quantity')->nullable(); // تعداد محصولی که می خواد
            $table->string('pic')->nullable();
            $table->string('price')->nullable(); // قیمت محصول از وکامرس
            $table->string('off')->nullable();
            $table->timestamps();
        });*/
    }


    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
