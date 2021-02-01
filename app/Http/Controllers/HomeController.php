<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('visa.index');
    }

    public function db()
    {

        return view('yasshop.admin.db');
    }

    public function fixDB()
    {
        $allProducts = DB::table('wp_posts')->where('post_type', 'product')->get()->sortByDesc('id');
        $allPostMetas = DB::table('wp_postmeta')->get()->sortByDesc('id');
        $numFix = 0 ;
        $arrayP = [];
        foreach ($allProducts as $product){
            $product_id = $product-> ID ;
            array_push($arrayP , $product_id);
        }
        dd($arrayP);
        foreach ($allProducts as $product){
            $product_id = $product -> ID ;
            $darad = 0 ;

            foreach ($allPostMetas as $postMeta ){
                //dd($postMeta->meta_key);
                // echo $postMeta->meta_key .' <hr>';
                if ($postMeta ->meta_key == 'onemilion' ){
                    $darad = 1 ;
                    $numFix = $numFix + 0  ;
                    echo 'codegh2 <hr style="color: #1ee9a2;border: #1ee9a2 2px solid;">';
                }

                if ($darad == 2){
                    echo $product_id.' Na darad <hr style="color: #E91E63;border: #E91E63 2px solid;">';
                }
                if ($darad == 1){
                    echo $product_id. 'darad <hr style="color: #1e4ae9;border: #1e68e9 2px solid;">';
                }
            }



        }
        echo 'Record ='.$numFix ;
        $real_price_meta_value = DB::table('wp_postmeta')->where([
            ['post_id' , $product_id],
            ['meta_key' , 'price-of-product']
        ])->first('meta_value');
    }
}
