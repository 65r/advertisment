<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\createBuildingRequest;
use App\Http\Requests\updateBuildingRequest;
use Carbon\Carbon;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BuildingController extends Controller
{
    public function store( createBuildingRequest  $request){

        $file = $request->file('image');
        $image = "";
        if (!empty('file')) {
            $image =Carbon::now()->format('y-m-d_h-i-s').'.'.$file->getClientOriginalName();
            $file->move('images/building/one', $image);
        }

        $file1 = $request->file('image1');
        $image1 = "";
        if ($file1 !='') {
            $image1 =Carbon::now()->format('y-m-d_h-i-s').'.'.$file1->getClientOriginalName();
            $file1->move('images/building/two', $image1);
        }

        $file2 = $request->file('image2');
        $image2 = "";
        if ($file2!='') {
            $image2 =Carbon::now()->format('y-m-d_h-i-s').'.'.$file2->getClientOriginalName();
            $file2->move('images/building/three', $image2);
        }

        $file3 = $request->file('image3');
        $image3 = "";
        if ($file3!='') {
            $image3 =Carbon::now()->format('y-m-d_h-i-s').'.'.$file3->getClientOriginalName();
            $file3->move('images/building/four', $image3);
        }
        Building::create([
            'title'=>$request->title,
            'cost'=>$request->cost,
            'address'=>$request->address,
            'floor'=>$request->floor,
            'space'=>$request->space,
            'phone'=>$request->phone,
            'equipment'=>$request->equipment,
            'description'=>$request->description,
            'image'=>$image,
            'image1'=>$image1,
            'image2'=>$image2,
            'image3'=>$image3,
            'user_id'=>\auth()->id(),
            'pst_id'=>Str::random(10),
        ]);
        return back();
    }
    public function edit($id)
    {
        $building =Building::findOrFail($id);
        return view('users/building/edit',compact('building'));
    }
    public function update(updateBuildingRequest $request, $id)
    {

        $file= $request->file('image');
        $image ="";
        $imageDelete =Building::findOrFail($id)->image;
        if (!empty($file)){
            if (file_exists('images/building/one/'.$imageDelete)) {
                unlink('images/building/one/'.$imageDelete);
            }
            $image =Carbon::now()->format('y-m-d_h-i-s').".". $file->getClientOriginalName();
            $file->move('images/building/one', $image);
        }else {
            $image=$imageDelete;
        }

        $file1= $request->file('image1');
        $image1 ="";
        $imageDelete1 =Building::findOrFail($id)->image1;
        if (!empty($file1)){
            if (file_exists('images/building/two/'.$imageDelete1)) {
                unlink('images/building/two/'.$imageDelete1);
            }
            $image1 = Carbon::now()->format('y-m-d_h-i-s').".". $file1->getClientOriginalName();
            $file1->move('images/building/two', $image1);
        }else {
            $image1=$imageDelete1;
        }

        $file2= $request->file('image2');
        $image2 ="";
        $imageDelete2 =Building::findOrFail($id)->image2;
        if (!empty($file2)){
            if (file_exists('images/building/three/'.$imageDelete2)) {
                unlink('images/building/three/'.$imageDelete2);
            }
            $image2 = Carbon::now()->format('y-m-d_h-i-s').".". $file2->getClientOriginalName();
            $file2->move('images/building/three', $image2);
        }else {
            $image2=$imageDelete2;
        }

        $file3= $request->file('image3');
        $image3 ="";
        $imageDelete3 =Building::findOrFail($id)->image3;
        if (!empty($file3)){
            if (file_exists('images/building/four/'.$imageDelete3)) {
                unlink('images/building/four/'.$imageDelete3);
            }
            $image3 = Carbon::now()->format('y-m-d_h-i-s').".". $file3->getClientOriginalName();
            $file3->move('images/building/four', $image3);
        }else {
            $image3=$imageDelete3;
        }
        Building::findOrFail($id)->update([
            'title'=>$request->title,
            'cost'=>$request->cost,
            'floor'=>$request->floor,
            'address'=>$request->address,
            'space'=>$request->space,
            'equipment'=>$request->equipment,
            'phone'=>$request->phone,
            'description'=>$request->description,
            'image'=>$image,
            'image1'=>$image1,
            'image2'=>$image2,
            'image3'=>$image3,
        ]);
        return back();
    }
    public function destroy($id)
    {
        $deleteimage =Building::findOrFail($id)->image;
        $deleteimage1 =Building::findOrFail($id)->image1;
        $deleteimage2 =Building::findOrFail($id)->image2;
        $deleteimage3 =Building::findOrFail($id)->image3;

        if (is_file('images/building/one/'.$deleteimage)) {
            unlink('images/building/one/'. $deleteimage);
        }

        if (is_file('images/building/two/'.$deleteimage1)) {
            unlink('images/building/two/'. $deleteimage1);
        }

        if (is_file('images/building/three/'.$deleteimage2)) {
            unlink('images/building/three/'. $deleteimage2);
        }

        if (is_file('images/building/four/'.$deleteimage3)) {
            unlink('images/building/four/'.$deleteimage3);
        }
        Building::destroy($id);
        return back();
    }
    public function create(){

    }
}
