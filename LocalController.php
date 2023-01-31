<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LocalController extends Controller
{
    public  function  store(Request $request){
        $data = $request->validate([
            'locale' => 'required'
        ]);

        Session::put('locale', $data['locale']);

        return redirect($request->header("referer"));
    }
}
