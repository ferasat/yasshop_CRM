<?php

namespace App\Http\Controllers;

use App\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    // For Admin
    public function indexSupport()
    {
        $allSupports = Support::all()->sortByDesc('id');
        if (Auth::check()){
            $user_id = Auth::user()->id ;

        }
        return view('form.indexSupport' , compact('allSupports'));
    }

    //  For User
    public function newSupport()
    {
        if (!\Auth::check()) {
            $user_id = 0 ;
            $user_name = 'مهمان' ;
            return view('form.user.newRequestSupportUser' , compact('user_id' , 'user_name'));
        } else {
            $user_id = Auth::user()->id ;
            $user_name = Auth::user()->name ;
            return view('form.user.newRequestSupportUser' , compact('user_id' , 'user_name'));
        }

    }

    public function saveSupport(Request $request)
    {
        // dd($request->all());
        if (!\Auth::check()) {
           $user_id = 0 ;
        } else {
            $user_id = Auth::user()->id ;
        }
        $newSupport = new Support();
        $newSupport -> subject = $request-> subject ;
        $newSupport -> department = $request-> department ;
        $newSupport -> text = $request-> text ;
        $newSupport -> status = 'open' ;
        $newSupport -> user_id = $user_id ;
        $newSupport -> priority = $request-> priority ;
        $newSupport -> save();

        $support_id = $newSupport -> id ;
        $message = 'درخواست شما با موفقیت ایجاد شد .شماره درخواست شما : '  ;

        if (!\Auth::check()) {
            return view('form.user.messageCreateRequestSupportUser' , compact('message') );
        }else {
            return view('form.messageCreateRequestSupportUser' );
        }

    }
}
