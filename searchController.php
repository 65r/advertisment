<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\car;
use App\Models\Cloth;
use App\Models\Etool;
use App\Models\House;
use App\Models\service;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public  function  search(Request $request ){
        $search =$request->input('search');
        $building = Building::query()->where('title','like',"%{$search}%")
        ->orWhere('description','like',"%{$search}%")->get();

        $car = car::query()->where('type','like',"%{$search}%")
            ->orWhere('description','like',"%{$search}%")->get();

        $house = House::query()->where('title','like',"%{$search}%")
            ->orWhere('description','like',"%{$search}%")->get();

        $service = service::query()->where('title','like',"%{$search}%")
            ->orWhere('description','like',"%{$search}%")->get();

        $etools = Etool::query()->where('title','like',"%{$search}%")
            ->orWhere('description','like',"%{$search}%")->get();

        $cloth =Cloth::query()->where('title','like',"%{$search}%")
            ->orWhere('description','like',"%{$search}%")->get();

        return view('front.frontShow.second',
            compact('building','car','house','service','etools','cloth'));

    }
}
