<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\car;
use App\Models\Cloth;
use App\Models\Etool;
use App\Models\House;
use App\Models\service;
use Illuminate\Http\Request;

class mypostController extends Controller
{
    public function show(){

        $auth_id = auth()->id();
        $building = Building::where('user_id','=',$auth_id)->get();
        $car = car::where('user_id','=',$auth_id)->get();
        $etools = Etool::where('user_id','=',$auth_id)->get();
        $house = House::where('user_id','=',$auth_id)->get();
        $cloth = Cloth::where('user_id','=',$auth_id)->get();
        $service =service::where('user_id','=',$auth_id)->get();

        return view('users.myposts.index',
            compact('building','car','house','service','etools','cloth'));
 }
    public function edit(Request $id){
        return view('users.myposts.edit');

    }
}
