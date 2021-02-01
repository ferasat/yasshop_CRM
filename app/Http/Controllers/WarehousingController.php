<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Products;

class WarehousingController extends Controller
{
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
            $product_pic = DB::table('wp_posts')->where([
                ['post_parent', $product_id],
                ['post_type', 'attachment']
            ])->first('guid');
            if ($product_pic !== null){
                $picProduct = $product_pic -> guid ; // تصویر
            }else {
                $picProduct = asset('img/null.png') ; // تصویر
            }

            // کد محصول
            $skuWP = DB::table('wp_postmeta')->where([
                ['meta_key', '_sku'],
                ['post_id', $product_id]
            ])->first('meta_value');
            $sku = $skuWP->meta_value; // کد محصول

            // آینده تامین محصول
            $FutureInventoryWP = DB::table('wp_postmeta')->where([
                ['meta_key', 'future-of-inventory'],
                ['post_id', $product_id]
            ])->first('meta_value');
            if ($FutureInventoryWP == null){
                $FutureInventory = 1; // آینده تامین محصول
            }else{
                $FutureInventory = $FutureInventoryWP->meta_value; // آینده تامین محصول
            }

            // تعداد قلم کالا
            $numbergh_meta_value = DB::table('wp_postmeta')->where([
                ['post_id' , $product_id],
                ['meta_key' , 'numbergh']
            ])->first('meta_value');
            if ($numbergh_meta_value == null){
                $numbergh = 1; // آینده تامین محصول
            }else{
                $numbergh = $numbergh_meta_value-> meta_value; // اگر تک قلم بود در محاسبات وارد شود
            }

            // اگر تک قلم بود در محاسبات وارد شود
            if ($numbergh == 1) {
                $value_real_meta_value = DB::table('wp_postmeta')->where([
                    ['post_id' , $product_id],
                    ['meta_key' , 'value_real']
                ])->first('meta_value');
                if ($value_real_meta_value == null){
                    $value_real = 0 ;
                }else {
                    $value_real = $value_real_meta_value -> meta_value ;
                }
                print_r($value_real.'<br>');
                print_r($product_id.'<br>');
                if ($value_real !== null){  /// چک میکنه اگر موجودی واقعی وارد شده بود محاسبات را انجام بده

                    $total_inventory = $total_inventory + $value_real ; //جمع موجودی واقعی کل محصولات
                    $real_price_meta_value = DB::table('wp_postmeta')->where([
                        ['post_id' , $product_id],
                        ['meta_key' , 'price-of-product']
                    ])->first('meta_value');
                    print_r($real_price_meta_value.'<br>');
                    if ($real_price_meta_value == null){
                        $real_price = 0 ;
                        $financial_cost_of_product = 0;
                    }else {
                        $real_price = $real_price_meta_value -> meta_value ;
                        print_r($real_price);
                        $financial_cost_of_product = $real_price*$value_real ;
                    }
                    $financial_cost_of_products = $financial_cost_of_products + $financial_cost_of_product ; // ارزش مالی کالا ها (قیمت خرید)

                    $_price_meta_value = DB::table('wp_postmeta')->where([
                        ['post_id' , $product_id],
                        ['meta_key' , '_price']
                    ])->first('meta_value');
                    if ($_price_meta_value == null){
                        $_price = 0 ;
                    }else{
                        $_price = $_price_meta_value -> meta_value ;

                    }
                    $sales_value_of_product = $value_real*$_price ;


                    $sales_value_of_products = $sales_value_of_product + $sales_value_of_products ;
                }


                if ($value_real <= 2) {
                    $lessProducts = $lessProducts . '<tr>
                                <td><img class="imgProductInTabel" src="' . $picProduct . '"></td>
                                <td>' . $sku . '</td>
                                <td>' . $product->post_title . '</td>
                                <td>'.$value_real.'</td>
                                <td>
                                  <span id="FutureInventoryWP">'.$FutureInventory.'</span>:<br>
                                 <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                  <label class="btn btn-secondary active ">
                                    <input type="radio" onclick="statusFutuer('. $product_id .', 1)" checked> قابل تامین
                                  </label>
                                  <label class="btn btn-secondary">
                                    <input type="radio" onclick="statusFutuer('. $product_id .', 2)" name="" > حذف شدنی
                                  </label>
                                  <label class="btn btn-secondary">
                                    <input type="radio" onclick="statusFutuer('. $product_id .', 3)" name="" > غیرقابل تامین
                                  </label>
                                </div>
                                </td>
                            </tr>';
                    $numberP = $numberP + 1 ;
                }
            }


        }




        return view('yasshop.warehousing.index' , compact('total_inventory' ,'financial_cost_of_products'
            ,'sales_value_of_products', 'lessProducts' , 'numberP' ));
    }

    public function priceControl()
    {
        $allProducts = DB::table('wp_posts')->where('post_type', 'product')->orderBy('ID', 'desc')->paginate(6);

        $result = '';
        foreach ($allProducts as $product){
            $product_id = $product-> ID;
            $product_pic = DB::table('wp_posts')->where([
                ['post_parent', $product_id],
                ['post_type', 'attachment']
            ])->first('guid');
            if ($product_pic !== null){
                $picProduct = $product_pic -> guid ; // تصویر
            }else {
                $picProduct = asset('img/null.png') ; // تصویر
            }

            $value_real_meta_value = DB::table('wp_postmeta')->where([
                ['post_id' , $product_id],
                ['meta_key' , 'value_real']
            ])->first('meta_value');
            $value_real = $value_real_meta_value -> meta_value ;

            $real_price_meta_value = DB::table('wp_postmeta')->where([
                ['post_id' , $product_id],
                ['meta_key' , 'price-of-product']
            ])->first('meta_value');
            $real_price = $real_price_meta_value -> meta_value ;

            $_price_meta_value = DB::table('wp_postmeta')->where([
                ['post_id' , $product_id],
                ['meta_key' , '_price']
            ])->first('meta_value');
            $_price = $_price_meta_value -> meta_value ;

            /*------------- onemilion --------------*/
            $onemilion_meta_value = DB::table('wp_postmeta')->where([
                ['post_id' , $product_id],
                ['meta_key' , 'onemilion']
            ])->first('meta_value');
            if($onemilion_meta_value == null){
                DB::table('wp_postmeta')->insert([
                    ['post_id' => $product_id , 'meta_key' => 'onemilion' , 'meta_value' => '0']
                ]);
                $onemilion = 0 ;
            }else{
                $onemilion = $onemilion_meta_value -> meta_value ;
            }

            /*------------- twomilion --------------*/
            $twomilion_meta_value = DB::table('wp_postmeta')->where([
                ['post_id' , $product_id],
                ['meta_key' , 'twomilion']
            ])->first('meta_value');
            if($twomilion_meta_value == null){
                DB::table('wp_postmeta')->insert([
                    ['post_id' => $product_id , 'meta_key' => 'twomilion' , 'meta_value' => '0']
                ]);
                $twomilion = 0 ;
            }else{
                $twomilion = $twomilion_meta_value -> meta_value ;
            }



            $result = $result . '
            <div class="cardProduct">
                            <a data-toggle="modal" data-target="#productModal'.$product_id.'">
                                <img src="'.$picProduct.'" class="card-img-top" >
                                <div class="card-body">
                                    <h5 class="card-title">' . $product->post_title . '</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">موجودی <strong id="vR'.$product_id.'">' . $value_real . '</strong> عدد</li>
                                    <li class="list-group-item">قیمت خرید: <strong id="rP'.$product_id.'">' . $real_price . '</strong> تومان</li>
                                    <li class="list-group-item">قیمت فروش : <strong id="p'.$product_id.'">' . $_price . '</strong> تومان</li>
                                    <li class="list-group-item">قیمت عمده ای تا 1.5 میلیون : <strong id="o1'.$product_id.'">' . $onemilion . '</strong> تومان</li>
                                    <li class="list-group-item">قیمت عمده ای بالاتر از 1.5 میلیون : <strong id="o2'.$product_id.'">' . $twomilion . '</strong> تومان</li>
                                </ul>


                            </a>
                            <div class="modal fade" id="productModal'.$product_id.'" tabindex="-1" aria-labelledby="productModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <span>موجودی :</span>
                                                    <input id="valueReal'.$product_id.'" type="number" value="' . $value_real . '" class="form-control">
                                                    <span>عدد</span>
                                                </li>
                                                <li class="list-group-item">
                                                    <span>قیمت خرید:</span>
                                                    <input id="realPrice'.$product_id.'" type="number" value="' . $real_price . '" class="form-control">
                                                    <span>تومان</span>

                                                </li>
                                                <li class="list-group-item">
                                                    <span>قیمت فروش :</span>
                                                    <input id="price'.$product_id.'" type="number" value="' . $_price . '" class="form-control">
                                                    <span>تومان</span>

                                                </li>
                                                <li class="list-group-item">
                                                    <span>قیمت عمده ای تا 1.5 میلیون :</span>
                                                    <input id="onemilion'.$product_id.'" type="number" value="' . $onemilion . '" class="form-control">
                                                    <span>تومان</span>

                                                </li>
                                                <li class="list-group-item">
                                                    <span>قیمت عمده ای بالاتر از 1.5 میلیون :</span>
                                                    <input id="twomilion'.$product_id.'" type="number" value="' . $twomilion . '" class="form-control">
                                                    <span>تومان</span>

                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="resultSave" id="resultSave'.$product_id.'"></div>
                                            <button onclick="savePrices('.$product_id.')" type="button" class="btn btn-primary w-50">ذخیره کن</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            ';
        }

        $linkPaginate = '<div class="row"> <div class="col-md-12"> <div class="linkPaginate"> '.$allProducts->links().'</div> </div>  </div>';
        $result = $result.$linkPaginate;
        return view('yasshop.warehousing.priceController' , compact('allProducts' ,
        'result'));
    }

    public function savePricesToStore()
    {
        $id = $_REQUEST['id'];
        $vReal = $_REQUEST['vReal'];
        $rPrice = $_REQUEST['rPrice'];
        $price = $_REQUEST['price'];
        $onemilion = $_REQUEST['onemilion'];
        $twomilion = $_REQUEST['twomilion'];

        // موجودی واقعی
        $rowVR = DB::table('wp_postmeta')->where([
            ['post_id' , $id ],
            ['meta_key' , 'value_real']
        ])->update(['meta_value' => $vReal]);

        // قیمت خرید
        $rowRP = DB::table('wp_postmeta')->where([
            ['post_id' , $id ],
            ['meta_key' , 'price-of-product']
        ])->update(['meta_value' => $rPrice]);
         // قیمت فروش
        $rowP = DB::table('wp_postmeta')->where([
            ['post_id' , $id ],
            ['meta_key' , '_price']
        ])->update(['meta_value' => $price]);
        // قیمت عمده ای تا 1
        $rowOM = DB::table('wp_postmeta')->where([
            ['post_id' , $id ],
            ['meta_key' , 'onemilion']
        ])->update(['meta_value' => $onemilion ]);
        // قیمت عمده 2 به بالا
        $rowTM = DB::table('wp_postmeta')->where([
            ['post_id' , $id ],
            ['meta_key' , 'twomilion']
        ])->update(['meta_value' => $twomilion]);


        //$updateVR = DB::table('wp_postmeta')->where('meta_id' , $rowVR -> meta_id)->update(['meta_value' => $vReal]);


        /// $update = DB::table('wp_postmeta')->where('post_id' , $id)->get();
        return $id.' '.$vReal.' '.$rPrice.' '.$price.' '.$twomilion.' '.$onemilion;
    }

    public function productInCrm(){
        $allProducts = Products::paginate(2)->sortByDesc('id');
        return view('yasshop.warehousing.ProductInCrm',compact('allProducts'));
    }
}
