<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $allProducts = DB::table('wp_posts')->where('post_type', 'product')->orderBy('ID', 'desc')->get();
        $total_inventory = 0 ; // موجودی واقعی کل محصولات
        $financial_cost_of_products = 0 ; // ارزش مالی کالا ها- قیمت خرید
        $sales_value_of_products = 0 ; // ارزش فروش محصولات
        $lessProducts = '' ; // کسری محصولات
        $numberP = 0 ;  // تعداد کسری
        foreach ($allProducts as $product){
            $product_id = $product-> ID;

            // کد محصول
            $skuWP = DB::table('wp_postmeta')->where([
                ['meta_key', '_sku'],
                ['post_id', $product_id]
            ])->first('meta_value');
            $sku = $skuWP->meta_value; // کد محصول

            // تعداد قلم کالا
            $numbergh_meta_value = DB::table('wp_postmeta')->where([
                ['post_id' , $product_id],
                ['meta_key' , 'numbergh']
            ])->first('meta_value');
            if ($numbergh_meta_value == null ){
                $numbergh = 1 ;
            }else {
                $numbergh = $numbergh_meta_value-> meta_value;
            }

            // اگر تک قلم بود در محاسبات وارد شود
            if ($numbergh == 1) {

                // موجودی واقی این محصول را بدست میاورد
                $value_real_meta_value = DB::table('wp_postmeta')->where([
                    ['post_id' , $product_id],
                    ['meta_key' , 'value_real']
                ])->first('meta_value');
                if ($value_real_meta_value == null ){
                    $value_real = 0 ;
                }else {
                    $value_real = $value_real_meta_value -> meta_value ;
                }


                if ($value_real <= 2) {
                    $numberP = $numberP + 1 ;
                    $lessProducts = $lessProducts.'<li class="list-group-item"><h6>'.$numberP.'- '.$product->post_title.'</h6><span> کد:'.$sku.'</span><span> تعداد :'.$value_real.'</span></li>';
                }
            }


        }
        return view('admin.dashboard', compact('lessProducts','numberP'));
    }
}
