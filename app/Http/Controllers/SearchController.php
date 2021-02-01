<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        $search = true;
        return view('yasshop.search.search', compact('search'));
    }

    public function search(Request $request)
    {
        //dd($request->search);

        $products = DB::table('wp_posts')->where([
            ['post_title', 'LIKE', '%' . $request->search . "%"],
            ['post_status', 'publish'],
            ['post_type', 'product']
        ])->get();
        dd($products);
        if ($request->ajax()) {
            $output = "";
            //$products = DB::table('products')->where('title', 'LIKE', '%' . $request->search . "%")->get();
            $products = DB::table('wp_posts')->where([
                ['title', 'LIKE', '%' . $request->search . "%"],
                ['post_status', 'publish'],
                ['post_type', 'product']
            ])->get();
            dd($products);
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->ID . '</td>' .
                        '<td>' . $product->post_title . '</td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

    public function ajaxSearch(Request $request)
    {
        $wordSearch = $_REQUEST['word'];
        $products = DB::table('wp_posts')->where([
            ['post_title', 'LIKE', '%' . $wordSearch . "%"],
            ['post_status', 'publish'],
            ['post_type', 'product']
        ])->get();
        //dd($products);
        $result = '';
        foreach ($products as $product) {
            $product_id = $product -> ID ;
            $pic = DB::table('wp_posts')->where([
                ['post_parent', $product_id],
                ['post_type', 'attachment']
            ]) -> first('guid');

            if ($pic !== null){
                $product_pic = $pic -> guid ; // تصویر
            }else {
                $product_pic = asset('img/null.png') ; // تصویر
            }


            $price_real = DB::table('wp_postmeta')->where([
                ['meta_key', 'price-of-product'],
                ['post_id', $product_id ]
            ]) -> first('meta_value');
            if ($price_real == null){
                $price_real = 0 ;
            }else{
                $price_real = $price_real -> meta_value ; // قیمت خرید
            }


            $skuWP = DB::table('wp_postmeta')->where([
                ['meta_key', '_sku'],
                ['post_id', $product_id ]
            ]) -> first('meta_value');
            $sku = $skuWP -> meta_value ; // کد محصول


            $result = $result . '
            <tr>
                <td>'.$product -> ID.'</td>
                <td>'.$sku.'</td>
                <td>'.$product -> post_title .'</td>
                <td>'.$price_real.'</td>
                <td><img src="'.$product_pic.'"></td>
                <td><a onclick="addToCart('.$product_id.')" class="btn btn-success">اضافه کردن</a></td>
            </tr>
            ';
        }
        return $result;
    }
}
