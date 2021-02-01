<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $allCats = \App\Category::all()->sortByDesc('id');
        return view('admin.post.category' , compact('allCats'));
    }

    public function savecat(Request $request)
    {
        $allCats = \App\Category::all()->sortByDesc('id');
        //dd($request);
        $newCat = new Category;
        $newCat -> word = $request -> word ;
        $newCat -> subcat = $request -> subcat ;
        $newCat -> shortDescription = $request -> shortDescription ;
        if ($request->subcat == 'سردسته'){
            $newCat -> subcat = 'سردسته' ;
            $newCat -> issub = false ;
            $newCat -> havesub = false ;
        }else {
            $newCat -> subcat = $request -> subcat ; // آیدی دسته بندی را میدهد
            $newCat -> issub = true ;
            $newCat -> havesub = false ;
        }

        $newCat->save();

        return view('admin.post.category' , compact('allCats'));
    }
}
