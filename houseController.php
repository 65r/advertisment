<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\createHouseRequest;
use App\Http\Requests\updateHouseRequest;
use App\Models\House;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class houseController extends Controller
{
    public function store( createHouseRequest  $request){
        $file = $request->file('image');
        $image ="";
        if (!empty($file)){
            $image = Carbon::now()->format('y-m-d_h-i-s').".".$file->getClientOriginalName();
            $file->move('images/house/one',$image);
        }

        $file1 = $request->file('image1');
        $image1 = "";
        if (!empty($file1)) {
            $image1 = Carbon::now()->format('y-m-d_h-i-s').".".$file1->getClientOriginalName();
            $file1->move('images/house/two', $image1);
        }

        $file2 = $request->file('image2');
        $image2 = "";
        if (!empty($file2)) {
            $image2 = Carbon::now()->format('y-m-d_h-i-s').".".$file2->getClientOriginalName();
            $file2->move('images/house/three', $image2);
        }

        $file3 = $request->file('image3');
        $image3 = "";
        if (!empty($file3)) {
            $image3 = Carbon::now()->format('y-m-d_h-i-s').".".$file3->getClientOriginalName();
            $file3->move('images/house/four', $image3);
        }
        House::create([
            'title'=>$request->title,
            'cost'=>$request->cost,
            'address'=>$request->address,
            'state'=>$request->state,
            'phone'=>$request->phone,
            'description'=>$request->description,
            'image'=>$image,
            'image1'=>$image1,
            'image2'=>$image2,
            'image3'=>$image3,
            'pst_id'=>Str::random(10),
             'user_id'=>\auth()->id()
        ]);
        return back();
    }
    public function edit($id)
    {
        $house =House::findOrFail($id);
        return view('users/House_tools/edit',compact('house'));
    }
    public function update(updateHouseRequest $request, $id)
    {
        $imageDelete =House::findOrFail($id)->image;
        $image ="";
        $file= $request->file('image');
        if (!empty($file)){
            if (file_exists('images/house/one/'.$imageDelete)) {
                unlink('images/house/one/'.$imageDelete);
            }
            $image = Carbon::now()->format('y-m-d_h-i-s').".". $file->getClientOriginalName();
            $file->move('images/house/one', $image);
        }else {
            $image=$imageDelete;
        }
        $imageDelete1 =House::findOrFail($id)->image1;
        $file1= $request->file('image1');
        $image1 ="";
        if (!empty($file1)){
            if (file_exists('images/house/two/'.$imageDelete1)) {
                unlink('images/house/two/'.$imageDelete1);
            }
            $image1 = Carbon::now()->format('y-m-d_h-i-s').".". $file1->getClientOriginalName();
            $file1->move('images/house/two', $image1);
        }else {
            $image1=$imageDelete1;
        }
        $file2= $request->file('image2');
        $image2 ="";
        $imageDelete2 =House::findOrFail($id)->image2;
        if (!empty($file2)){
            if (file_exists('images/house/three/'.$imageDelete2)) {
                unlink('images/house/three/'.$imageDelete2);
            }
            $image2 = Carbon::now()->format('y-m-d_h-i-s').".". $file2->getClientOriginalName();
            $file2->move('images/house/three', $image2);
        }else {
            $image2=$imageDelete2;
        }
        $file3= $request->file('image3');
        $image3 ="";
        $imageDelete3 =House::findOrFail($id)->image3;
        if (!empty($file3)){
            if (file_exists('images/house/four/'.$imageDelete3)) {
                unlink('images/house/four/'.$imageDelete3);
            }
            $image3 = Carbon::now()->format('y-m-d_h-i-s').".". $file3->getClientOriginalName();
            $file3->move('images/house/four', $image3);
        }else {
            $image3=$imageDelete3;
        }
        House::findOrFail($id)->update([
            'title'=>$request->title,
            'cost'=>$request->cost,
            'phone'=>$request->phone,
            'state'=>$request->state,
            'address'=>$request->address,
            'description'=>$request->description,
            'image'=>$image,
            'image1'=>$image,
            'image2'=>$image,
            'image3'=>$image,
        ]);
        return back();
    }
    public function destroy($id)
    {
        $deleteimage = House::findOrFail($id)->image;
        if (is_file('images/house/one/'.$deleteimage)) {
            unlink('images/house/one/'. $deleteimage);
        }
        $deleteimage1 = House::findOrFail($id)->image1;
        if (is_file('images/house/two/'.$deleteimage1)) {
            unlink('images/house/two/'. $deleteimage1);
        }
        $deleteimage2 = House::findOrFail($id)->image2;
        if (is_file('images/house/three/'.$deleteimage2)) {
            unlink('images/house/three/'. $deleteimage2);
        }
        $deleteimage3 = House::findOrFail($id)->image3;
        if (is_file('images/house/four/'.$deleteimage3)) {
            unlink('images/house/four/'. $deleteimage3);
        }
        House::destroy($id);
        return back();
    }

}
