<?php


namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\car;
use App\Models\Cloth;
use App\Models\Etool;
use App\Models\House;
use App\Models\service;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function building($id){
        $data =Building::findOrFail($id);
        Building::findOrFail($id)->update([
            'post_view'=>$data->post_view +1
        ]);
        return view('details.building.index',compact('data'));
    }
    public function service($id){
        $data =service::findOrFail($id);
        service::findOrFail($id)->update([
            'post_view'=>$data->post_view +1
        ]);
        return view('details.service.index',compact('data'));
    }
    public function car($id){
        $data =car::findOrFail($id);
        car::findOrFail($id)->update([
            'post_view'=>$data->post_view +1
        ]);
        return view('details.car.index',compact('data'));
    }
    public function cloth($id){
        $data =Cloth::findOrFail($id);
        Cloth::findOrFail($id)->update([
            'post_view'=>$data->post_view +1
        ]);
        return view('details.cloth.index',compact('data'));
    }
    public function house($id){
        $data =House::findOrFail($id);
        House::findOrFail($id)->update([
            'post_view'=>$data->post_view +1
        ]);
        return view('details.house.index',compact('data'));
    }
    public function etools($id){
        $data =Etool::findOrFail($id);
        Etool::findOrFail($id)->update([
            'post_view'=>$data->post_view +1
        ]);
        return view('details.etool.index',compact('data'));
    }
}
