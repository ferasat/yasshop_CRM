<?php

namespace App\Http\Controllers;

use App\FileManager;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function index()
    {
        return view('yasshop.index');
    }

    public function productindex()
    {
        //$allProducts = Products::all()->sortByDesc('id') ;
        //$allProducts = DB::connection('yasshopw')->select('wp_post')->get();
        $allProductsWP = DB::table('wp_posts')->where([
            ['post_status', 'publish'],
            ['post_type', 'product']
        ]) -> get();
        $x = 1 ;
        //dd($allProductsWP);
        foreach ($allProductsWP as $product){
            $product_id = $product -> ID ;
            $product_name = $product -> post_title ;
            $pic = DB::table('wp_posts')->where([
                ['post_parent', $product_id],
                ['post_type', 'attachment']
            ]) -> first('guid');
            $product_pic = $pic -> guid ;

            $price_real = DB::table('wp_postmeta')->where([
                ['meta_key', 'price-of-product'],
                ['post_id', $product_id ]
            ]) -> first('meta_value');
            $price_real = $price_real -> meta_value ;

            $skuWP = DB::table('wp_postmeta')->where([
                ['meta_key', '_sku'],
                ['post_id', $product_id ]
            ]) -> first('meta_value');
            $sku = $skuWP -> meta_value ;

            $priceWP = DB::table('wp_postmeta')->where([
                ['meta_key', '_price'],
                ['post_id', $product_id ]
            ]) -> first('meta_value');
            $price = $priceWP -> meta_value ;

            $value_realWP = DB::table('wp_postmeta')->where([
                ['meta_key', 'value_real'],
                ['post_id', $product_id ]
            ]) -> first('meta_value');
            $value_real = $value_realWP -> meta_value ;

            $allProducts[$x] = [
                'product_ID' => $product_id,
                'product_name' => $product_name,
                'product_pic' => $product_pic,
                'price_real' => $price_real,
                'sku' => $sku,
                'price' => $price,
                'value_real' => $value_real,
            ];

            $x++ ;
        }
        $count = $x ;
//        dd($allProducts);
        return view('yasshop.product.Product' , compact('allProducts' , 'count'));
    }

    public function creatProduct()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $allCat = DB::table('catproduct')->get();
        return view('yasshop.product.creatProduct', compact('allCat'));
    }

    public function newProduct(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        //dd($request->all());
        $mytime = time();
        $user_id = Auth::user()->id ;
        if ($request->mojodi == null) {
            $mojodi = 2 ;
        }else{
            $mojodi = $request->mojodi ;
        }
        $newProduct = new Products() ;
        $newProduct -> name = $request->name ;
        $newProduct -> sku = $request->sku ;
        $newProduct -> price = $request->price ;
        $newProduct -> priceom = $request->priceom ;
        $newProduct -> pricekharid = $request->pricekharid ;
        $newProduct -> category = $request->category ;
        $newProduct -> mojodi = $mojodi ;
        $newProduct -> tolidi = $request->tolidi ;
        $newProduct -> kasri = 0 ;

        if ($request->pic !== null) {
            $file = new FileManager();
            $file->filename = $request->name;
            $file->user_id = $user_id;
            $file->description = $request->mame;
            $file->save();

            $filename = $request->uniqid . $file->id . '.' . $request->file('pic')->getClientOriginalExtension();
            $pathAdress = "uploads/" . date("Y", $mytime) . "/product/user_" . $user_id;
            $request->file('pic')->move(public_path($pathAdress), $filename);
            $file->path = $pathAdress . '/' . $filename;
            $path_pic = $pathAdress . '/' . $filename;
            $file->save();

            $newProduct->pic = $path_pic;
        }

        $newProduct -> save() ;

        return back();
    }

    public function adddell(Request $request)
    {

        $id = $request -> id ;

        $newmojodi = Products::find($id);
        $newmojodi -> mojodi = $request->mojodi;
        $newmojodi -> priceom = $request -> priceom ;
        $newmojodi -> pricekharid = $request -> pricekharid;
        $newmojodi-> price = $request -> price;
        $newmojodi -> save();

        return back() ;

    }


}
