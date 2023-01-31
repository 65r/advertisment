<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class catagory extends Controller
{
    public function catagory(){
        return view('front.frontshow.catagory');
    }
    public function createb(){
        return view('users.building.create');
    }
    public  function createT(){
        return view('users/E-tools/create');
    }
    public  function createC(){
        return view('users/car/create');
    }
    public  function createcloth(){
        return view('users/cloth/create');
    }
    public  function createService(){
        return view('users/services/create');
    }public  function createhouse(){
        return view('users/House_tools/create');
    }
}
