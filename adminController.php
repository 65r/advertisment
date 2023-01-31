<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\car;
use App\Models\Cloth;
use App\Models\Etool;
use App\Models\House;
use App\Models\service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use MongoDB\Driver\Session;

class adminController extends Controller
{
    public  function index(){
        $building = Building::count();
        $house = House::count();
        $etools = Etool::count();
        $car =car::count();
        $cloth = Cloth::count();
        $service = service::count();
        return view('admin.index',compact('building','house','etools','car','cloth','service'));
    }
    public function choose_page(){
        return view('admin.login.choose_page');
    }
    public function admin_login(){
        return view('admin.login.login');
    }
    public function building(){
        $building = Building::all();
        return view('admin.parts.categories.building',compact('building'));
    }
    public function car(){
        $car = car::all();
        return view('admin.parts.categories.cars',compact('car'));
    }
    public function house(){
        $house = House::all();
        return view('admin.parts.categories.house_tools',compact('house'));
    }
    public function etools(){
        $etools = Etool::all();
        return view('admin.parts.categories.electronic_tools',compact('etools'));
    }
    public function service(){
        $service = service::all();
        return view('admin.parts.categories.service',compact('service'));
    }
    public function cloth(){
        $cloth = Cloth::all();
        return view('admin.parts.categories.cloth',compact('cloth'));
    }
    public function adminlogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
            if ($email === "admin@gmail.com" and $password === "admin") {
                return redirect()->route('dashboard');
            } else {
                return back();
            }


    }
    public function users(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }
}
