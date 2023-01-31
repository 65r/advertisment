<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\car;
use App\Models\Cloth;
use App\Models\Etool;
use App\Models\House;
use App\Models\seo;
use App\Models\service;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class indexController extends Controller
{

   public function show(){
      $building = Building::orderBy('post_view','desc')->get();
      $car = car::orderBy('post_view','desc')->get();
      $house = House::orderBy('post_view','desc')->get();
      $service = service::orderBy('post_view','desc')->get();
      $etools = Etool::orderBy('post_view','desc')->get();
      $cloth =Cloth::orderBy('post_view','desc')->get();
       return view('front.frontShow.second',
           compact('building','car','house','service','etools','cloth'));
   }



    public function just_building(){
       $building = Building::orderby('post_view','desc')->get();
return view('front.frontshow.second',compact('building'));
    }

    public function just_car(){
        $car = car::orderby('post_view','desc')->get();
        return view('front.frontshow.second',compact('car'));
    }

    public function just_etool(){
        $etools = Etool::orderby('post_view','desc')->get();
        return view('front.frontshow.second',compact('etools'));
    }

    public function just_service(){
        $service = service::orderby('post_view','desc')->get();
        return view('front.frontshow.second',compact('service'));
    }

    public function just_cloth(){
        $cloth = Cloth::orderby('post_view','desc')->get();
        return view('front.frontshow.second',compact('cloth'));
    }

    public function just_house(){
        $house = House::orderby('post_view','desc')->get();
        return view('front.frontshow.second',compact('house'));
    }

}
