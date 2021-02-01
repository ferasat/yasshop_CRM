<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Rowcart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexOrder()
    {
        $allOders = Cart::all()->sortByDesc('id');
        return view('yasshop.order.order', compact('allOders'));
    }

    public function newOrder()
    {
        return view('yasshop.order.newOrder');
    }

    public function createCart(Request $request)
    {
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        $customer = $request->customer;
        $customer_cellphone = $request->customer_cellphone;
        $customer_zipcode = $request->customer_zipcode;
        $customer_address = $request->customer_address;
        $newcart = new Cart();
        $newcart->customer = $customer;
        $newcart->customer_cellphone = $customer_cellphone;
        $newcart->customer_zipcode = $customer_zipcode;
        $newcart->customer_address = $customer_address;
        $newcart->user_name = $user_name;
        $newcart->user_id = $user_id;
        $newcart->opt1 = $request -> opt1 ;
        $newcart->status = 'انتخاب کالاها';
        $newcart->status_id = 2;
        $newcart->save();
        $cart_id = $newcart->id;
        return redirect('dashboard/orders/cart/' . $newcart->id);
    }

    public function showCart(Cart $id)
    {
        if ($id -> status_id == '4' or $id -> status_id == '5' or $id -> status_id == '6' or $id -> status_id == '7') {
            return redirect('dashboard/orders/cart/invoice/'.$id -> id);
        } else {
            $search = true;
            return view('yasshop.order.cart', compact('id', 'search'));
        }

    }

    public function addToCart(Cart $id)
    {
        $cart_id = $id->id;
        $product_id = $_REQUEST['ID'];

        $post = DB::table('wp_posts')->where('ID', $product_id)->first('post_title');
        $post_title = $post->post_title;

        $pic = DB::table('wp_posts')->where([
            ['post_parent', $product_id],
            ['post_type', 'attachment']
        ])->first('guid');
        if ($pic !== null){
            $product_pic = $pic -> guid ; // تصویر
        }else {
            $product_pic = asset('img/null.png') ; // تصویر
        }


        $price_real = DB::table('wp_postmeta')->where([
            ['meta_key', 'price-of-product'],
            ['post_id', $product_id]
        ])->first('meta_value');
        $price_buy = $price_real->meta_value; // قیمت خرید محصول
        if ($price_buy == null){
            $price_buy = 0 ;
        }

        $price_real = DB::table('wp_postmeta')->where([
            ['meta_key', '_price'],
            ['post_id', $product_id]
        ])->first('meta_value');
        $price = $price_real->meta_value; // قیمت فروش تک محصول
        if ($price == null){
            $price = 0 ;
        }

        $skuWP = DB::table('wp_postmeta')->where([
            ['meta_key', '_sku'],
            ['post_id', $product_id]
        ])->first('meta_value');
        $sku = $skuWP->meta_value; // کد محصول


        $numberSessionCart = 'cart_' . $cart_id; // کارت این سفارش
        $resultCart = 'result_' . $cart_id; // ننتیجه این سفارش
        $addToCart = true;


        $productsInCart = DB::table('rowcarts')->where('cart_id', $cart_id)->get(); // array
        $resultInCart = '';

        foreach ($productsInCart as $rowcart) {
            if ($rowcart->product_ID == $product_id) {
                $addToCart = false;
            }
            $resultInCart = $resultInCart . '<tr>
                                <td>' . $rowcart->product_ID . '</td>
                                <td>' . $rowcart->sku . '</td>
                                <td>' . $rowcart->product_name . '</td>
                                <td>' . $rowcart->price . '</td>
                                <td><img src="' . $rowcart->pic . '"></td>
                                <td><input name="quantity_' . $rowcart->product_ID . '" class="form-control" type="number"></td>
                                <td><input class="btn btn-danger" type="button" value="حذف" onclick="deleteRow(' . $rowcart->product_ID . ')"></td>
                            </tr>';
        }

        foreach ($productsInCart as $rowcart) {

            if ($addToCart) { // به سبد  اضافه می شود
                DB::table('rowcarts')->insert([
                    'cart_id' => $cart_id,
                    'product_ID' => $product_id,
                    'product_name' => $post_title,
                    'pic' => $product_pic,
                    'price' => $price,
                    'price_buy' => $price_buy,
                    'sku' => $sku,
                ]);

                $rowscart = Rowcart::where('cart_id', $cart_id)->get();
                $result = ' ';
                foreach ($rowscart as $rowcart) {
                    $result = $result . '<tr>
                                <td>' . $rowcart->product_ID . '</td>
                                <td>' . $rowcart->sku . '</td>
                                <td>' . $rowcart->product_name . '</td>
                                <td>' . $rowcart->price . '</td>
                                <td><img src="' . $rowcart->pic . '"></td>
                                <td><input name="quantity_' . $rowcart->product_ID . '" class="form-control" type="number"></td>
                                <td><input class="btn btn-danger" type="button" onclick="deleteRow(' . $rowcart->product_ID . ')" value="حذف"></td>
                            </tr>';
                }
                return $result;

            } else { // کالا از قبل موجوده
                $result = $resultInCart;
                return $result;
            }

        }
        /// اگر کارت ساخته نشده بود
        DB::table('rowcarts')->insert([
            'cart_id' => $cart_id,
            'product_ID' => $product_id,
            'product_name' => $post_title,
            'pic' => $product_pic,
            'price' => $price,
            'price_buy' => $price_buy,
            'sku' => $sku,
        ]);
        $result = '<tr>
                <td>' . $product_id . '</td>
                <td>' . $sku . '</td>
                <td>' . $post_title . '</td>
                <td>' . $price . '</td>
                <td><img src="' . $product_pic . '"></td>
                <td><input name="quantity_' . $product_id . '" class="form-control" type="number"></td>
                <td><input class="btn btn-danger" type="button" onclick="deleteRow(' . $product_id . ')"  value="حذف"></td>
            </tr>';


        $rowscart = Rowcart::where('cart_id', $cart_id)->get();
        $result = ' ';
        foreach ($rowscart as $rowcart) {
            $result = $result . '<tr>
                                <td>' . $rowcart->product_ID . '</td>
                                <td>' . $rowcart->sku . '</td>
                                <td>' . $rowcart->product_name . '</td>
                                <td>' . $rowcart->price . '</td>
                                <td><img src="' . $rowcart->pic . '"></td>
                                <td><input name="quantity_' . $rowcart->product_ID . '" class="form-control" type="number"></td>
                                <td><input class="btn btn-danger" type="button" onclick="deleteRow(' . $rowcart->product_ID . ')" value="حذف"></td>
                            </tr>';
        }
        return $result;

    }

    public function deleteFromCart()
    {
        $cart_id = $_REQUEST['cart_id'];
        $product_ID = $_REQUEST['ID'];

        $rowscart = Rowcart::where('cart_id', $cart_id)->get();
        foreach ($rowscart as $rowcart) {
            if ($rowcart->product_ID == $product_ID) {
                $delRow = Rowcart::find($rowcart->id);
                $delRow->delete();
            }
        }

        $rowscart = Rowcart::where('cart_id', $cart_id)->get();
        $result = ' ';
        foreach ($rowscart as $rowcart) {
            $result = $result . '<tr>
                                <td>' . $rowcart->product_ID . '</td>
                                <td>' . $rowcart->sku . '</td>
                                <td>' . $rowcart->product_name . '</td>
                                <td>' . $rowcart->price . '</td>
                                <td><img src="' . $rowcart->pic . '"></td>
                                <td><input name="quantity_' . $rowcart->product_ID . '" class="form-control" type="number"></td>
                                <td><input class="btn btn-danger" type="button" onclick="deleteRow(' . $rowcart->product_ID . ')" value="حذف"></td>
                            </tr>';
        }
        return $result;
    }

    public function updateCart()
    {
        $cart_id = $_REQUEST['cart_id'];
        $rowscart = DB::table('rowcarts')->where('cart_id', $cart_id)->get();
        $result = ' ';
        foreach ($rowscart as $rowcart) {
            $result = $result . '<tr>
                                <td>' . $rowcart->product_ID . '</td>
                                <td>' . $rowcart->sku . '</td>
                                <td>' . $rowcart->product_name . '</td>
                                <td>' . $rowcart->price . '</td>
                                <td><img src="' . $rowcart->pic . '"></td>
                                <td><input name="quantity_' . $rowcart->product_ID . '" class="form-control" type="number"></td>
                                <td><input class="btn btn-danger" type="button" onclick="deleteRow(' . $rowcart->product_ID . ')" value="حذف"></td>
                            </tr>';
        }
        return $result;
    }

    public function saveProductToCart(Request $request)
    {
        $cart_id = $request->cart_id;
        $productsInCar = Rowcart::where('cart_id', $cart_id)->get();
        foreach ($productsInCar as $order) {
            $quantity = 'quantity_' . $order->product_ID;
            $updateRow = Rowcart::find($order->id);
            $updateRow->quantity = $request->$quantity;
            $updateRow->save();
        }
        $updateCart = Cart::find($cart_id);
        $updateCart->status = 'ثبت اطلاعات';
        $updateCart->status_id = 3 ;
        $updateCart->save();

        return redirect('dashboard/orders/cart/saveInfoCart/' . $cart_id);
    }

    public function saveInfoCart(Cart $id)
    {
        $cart_id = $id->id;
        $rowscart = Rowcart::where('cart_id', $cart_id)->get();
        $result = ' ';
        foreach ($rowscart as $rowcart) {
            $result = $result . '<tr>
                                <td>' . $rowcart->product_ID . '</td>
                                <td>' . $rowcart->sku . '</td>
                                <td>' . $rowcart->product_name . '</td>
                                <td>' . $rowcart->price . '</td>
                                <td><img src="' . $rowcart->pic . '"></td>
                                <td><input name="quantity_' . $rowcart->product_ID . '" class="form-control" type="number" value="' . $rowcart->quantity . '"></td>
                                <td><input class="btn btn-danger" type="button" onclick="deleteRow(' . $rowcart->product_ID . ')" value="حذف"></td>
                            </tr>';
        }
        return view('yasshop.order.cartFinal', compact('id', 'result'));
    }

    public function saveFinalInfoCart(Request $request, Cart $id)
    {
        $cart_id = $id -> id;
        $typeprice = $request->typeprice;
        $srcsale = $request->srcsale;
        $typepost = $request->typepost;
        $details = $request->details;
        $description = $request->description;
        $customer = $request->customer;
        $customer_cellphone = $request->customer_cellphone;
        $customer_zipcode = $request->customer_zipcode;
        $customer_address = $request->customer_address;

        $updateCart = Cart::find($cart_id);
        $updateCart -> typeprice = $typeprice ;
        $updateCart -> srcsale = $srcsale ;
        $updateCart -> typepost = $typepost ;
        $updateCart -> details = $details ;
        $updateCart -> description = $description ;
        $updateCart -> customer = $customer ;
        $updateCart -> customer_cellphone = $customer_cellphone ;
        $updateCart -> customer_zipcode = $customer_zipcode ;
        $updateCart -> customer_address = $customer_address ;
        $updateCart -> status = 'ثبت نهایی -  برای بستبندی' ;
        $updateCart -> status_id = 4 ;
        $updateCart -> save();


        $productsInCar = Rowcart::where('cart_id', $cart_id)->get();
        $counter = 0 ;
        $finalPriice = 0 ;
        $result = ' ';
        foreach ($productsInCar as $rowcart) {
            $quantity = 'quantity_' . $rowcart->product_ID;
            $updateRow = Rowcart::find($rowcart->id);
            $finalPriice = $finalPriice + ( $request -> $quantity * $updateRow -> price) ;
            $updateRow->quantity = $request-> $quantity ;
            $updateRow->save();
            $updateRow->profit = ($rowcart->quantity * $rowcart -> price) - ( $rowcart->quantity * $rowcart -> price_buy) ;
            $updateRow->save();
            $counter = $counter + 1 ;
        }

        $profit_sales = 0;
        foreach ($productsInCar as $rowcart) {
            $result = $result . '<tr>
                                <td>' . $rowcart->product_ID . '</td>
                                <td>' . $rowcart->sku . '</td>
                                <td>' . $rowcart->product_name . '</td>
                                <td>' . $rowcart->price . '</td>
                                <td>' . $rowcart->quantity . '</td>
                                <td>' . ($rowcart-> quantity * $rowcart -> price) . '</td>
                                <td><img src="' . $rowcart->pic . '"></td>
                                </tr>';

            $profit_sales = $profit_sales + $rowcart -> profit;
        }

        $updateCart -> price = $finalPriice;
        $updateCart -> profit_sales = $profit_sales ; // محاسبه سود این کارت
        $updateCart -> save();

        //return view('yasshop.order.invoice' , compact('id' , 'result' ));
        return redirect('dashboard/orders/cart/invoice/'.$id -> id );
    }

    public function invoice(Cart $id)
    {
        $cart_id = $id -> id;
        $productsInCar = Rowcart::where('cart_id', $cart_id)->get();
        $result = ' ';
        foreach ($productsInCar as $rowcart) {
            $result = $result . '<tr>
                                <td>' . $rowcart-> product_ID . '</td>
                                <td>' . $rowcart-> sku . '</td>
                                <td>' . $rowcart-> product_name . '</td>
                                <td>' . $rowcart-> price . '</td>
                                <td>' . $rowcart-> quantity . '</td>
                                <td>' . ($rowcart -> quantity * $rowcart -> price) . '</td>
                                <td><img src="' . $rowcart->pic . '"></td>

                            </tr>';
        }

        return view('yasshop.order.invoice' , compact('id' , 'result'));
    }

    ///  ارسال شده
    public function posted()
    {
        $orders = Cart::where('status_id', 5)->get();
        $title = 'ارسال شده';
        return view('yasshop.order.statusOrders' , compact('orders' , 'title'));
    }

    ///  ارسال نشده
    public function notShipped()
    {
        $orders = Cart::where('status_id', 4 )->get();
        $title = 'ارسال نشده';
        return view('yasshop.order.statusOrders' , compact('orders' , 'title'));
    }

    // کسری دارند
    public function deficit()
    {
        $orders = Cart::where('status_id', 6 )->get();
        $title = 'کسری دارند';
        return view('yasshop.order.statusOrders' , compact('orders' , 'title'));
    }

    // عدم موجودی
    public function outStock()
    {
        $orders = Cart::where('status_id', 7 )->get();
        $title = 'عدم موجودی';
        return view('yasshop.order.statusOrders' , compact('orders' , 'title'));
    }

    public function forBoxing() {
        $orders = Cart::where('status_id', 4 )->get();
        $title = 'برای بستبندی';
        $result = '';
        $x = 1 ;
        foreach ( $orders as $order){
            $rowOrders = '';
            $rowsOrder = Rowcart::where('cart_id' , $order -> id)->get();
            foreach ($rowsOrder as $row){
                $rowOrders = $rowOrders . '
                <tr>
                    <td> '.$row -> product_name.' </td>
                    <td> '.$row -> product_ID.' </td>
                    <td> '.$row -> quantity.' </td>
                    <td> <img class="w100px" src="'.$row -> pic.'" > </td>
                </tr>
                ';
            }

            $result =$result.'
            <div id="card-'.$order -> id.'" class="card bgOrderBoxing">
                 <h5 class="card-header">
                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-bounding-box" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>
                      <a class="aCustomer" href="url('.'dashboard/orders/cart/'.$order -> id.')">'.$order -> customer .'</a>
                 <div class="float-left">
                 <div id="status-'.$order -> id.'">'.$order -> status.'</div>
                 </div>
                 </h5>

                 <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        نوع پرداخت :
                         '. $order -> typeprice .'
                           | مبلغ پرداخت :
                          '. $order -> price .'
                          | یاداشت :
                           '. $order -> note .'
                      </li>
                      <li class="list-group-item">
                           <table class="table border-2">
                           <thead class="thead-dark ">
                                 <tr>
                                     <th scope="col">نام کالا</th>
                                     <th scope="col">کد محصول</th>
                                     <th scope="col">تعداد</th>
                                     <th scope="col">تصویر</th>
                                 </tr>
                           </thead>
                           <tbody id="idChengeBg">
                           '.$rowOrders.'
                           </tbody>
                           </table>
                      </li>

                 </ul>
                 <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-square-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2.5a2 2 0 0 1 1.6.8L8 14.333 9.9 11.8a2 2 0 0 1 1.6-.8H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
  <path fill-rule="evenodd" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
</svg>  یاداشت فروش: '.$order -> description.'
                    </div>
                    <div class="alert alert-danger" role="alert">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>  توصیه های مشتری: '.$order -> details.'
                    </div>
                    <div class="row">
                    <div class="col-9">
                    <textarea name="note" id="note-'.$order -> id.'" class="form-control">'.$order -> note.'</textarea>
                    </div>

                    <div class="col-3">
                    <a onclick="saveNote('.$order -> id.')" class="btn btn-success" >ذخیره</a>
                    <div id="saveReplay'.$order -> id.'"></div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-12 text-md-center">
                    <br>
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                      <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          تعیین وضعیت
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a type="button" onclick="status(id='.$order -> id.',s=0)" class="dropdown-item bg-danger">کسری دارد</a>
                            <a type="button" onclick="status(id='.$order -> id.',s=1)" class="dropdown-item bg-info">بستبندی شد</a>
                            <a type="button" onclick="status(id='.$order -> id.',s=2)" class="dropdown-item bg-warning">اطلاعات مشکل دارد</a>
                        </div>
                      </div>
                    </div>
                    </div>
                    </div>


                 </div>
            </div><br><br>
            ';
            $x = $x +1 ;

        }

        return view('yasshop.order.boxing' , compact('orders' , 'title' , 'result'));
    }

    public function saveNote()
    {
        $id = $_REQUEST['id'];
        $note = $_REQUEST['note'];
        $cart = Cart::find($id);
        $cart-> note = $note ;
        $cart -> update();
        return $cart->note ;
    }

    public function toKasri()
    {
        $id = $_REQUEST['id'];
        $cart = Cart::find($id);
        $cart -> status = 'کسری داره';
        $cart -> status_id = 6;
        $cart -> save();
        return $cart ;
    }

    public function toPost()
    {
        $id = $_REQUEST['id'];
        $cart = Cart::find($id);
        $cart -> status = 'بستبندی شده و برای چک';
        $cart -> status_id = 5;
        $cart -> save();
        return $cart ;
    }

    public function errorInfo()
    {
        $id = $_REQUEST['id'];
        $cart = Cart::find($id);
        $cart -> status = 'اطلاعات مشتری مشکل دارد';
        $cart -> status_id = 8;
        $cart -> save();
        return $cart ;
    }

    public function checkForPost()
    {
        $orders = Cart::where('status_id' , 5 )->get()->sortByDesc('id');
        $title = 'برای چک کردن آماده به ارسال ها';

        return view('yasshop.order.checkForPost' , compact('orders' , 'title'));
    }

    public function apply()
    {
        $id = $_REQUEST['id'];
        $cart = Cart::find($id);
        $cart -> status = 'ارسال شد';
        $cart -> status_id = 7;
        $cart -> save();

        $rowCarts = Rowcart::where('cart_id' , $cart -> id )->get();
        foreach ($rowCarts as $row ){
            $product_id = $row -> product_ID ;
            $value_real = DB::table('wp_postmeta')->where([
                ['meta_key', 'value_real'],
                ['post_id', $product_id]
            ])->first();
            $meta_id = $value_real -> meta_id ;
            $inventory_value = $value_real -> meta_value; // مقدار موجودی کالا
            $quantity = $row -> quantity;
            $inventory_value = $inventory_value - $quantity ;
            DB::table('wp_postmeta')->where('meta_id' , $meta_id)->update([
                'value_real' => $inventory_value
            ]);
        }

        return $cart ;
    }
}
