<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\createClothRequest;
use App\Http\Requests\createEtoolsRequest;
use App\Http\Requests\updateClothRequest;
use App\Http\Requests\updateEtoolsRequest;
use App\Models\car;
use App\Models\Cloth;
use App\Models\Etool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class clothcontroller extends Controller
{
    public function index(){
    }
    public function store(createClothRequest $request){
        $file = $request->file('image');
        $image ="";
        if (!empty('file')){
            $image =Carbon::now()->format('y-m-d_h-i-s').".".$file->getClientOriginalName();
            $file->move('images/cloth/one',$image);
        }

        $file1 = $request->file('image1');
        $image1 = "";
        if ($file1 !='') {
            $image1 = Carbon::now()->format('y-m-d_h-i-s').".".$file1->getClientOriginalName();
            $file1->move('images/cloth/two', $image1);
        }

        $file2 = $request->file('image2');
        $image2 = "";
        if ($file2!='') {
            $image2 = Carbon::now()->format('y-m-d_h-i-s').".".$file2->getClientOriginalName();
            $file2->move('images/cloth/three', $image2);
        }

        $file3 = $request->file('image3');
        $image3 = "";
        if ($file3!='') {
            $image3 =Carbon::now()->format('y-m-d_h-i-s').".".$file2->getClientOriginalName();
            $file3->move('images/cloth/four', $image3);
        }
        Cloth::create([
            'title'=>$request->title,
            'cost'=>$request->cost,
            'address'=>$request->address,
            'description'=>$request->description,
            'image'=>$image,
            'image1'=>$image1,
            'phone'=>$request->phone,
            'image2'=>$image2,
            'image3'=>$image3,
            'pst_id'=>Str::random(10),
            'user_id'=>\auth()->id()
        ]);
        return back();
    }
    public function show($id)
    {

    }
    public  function edit($id)
    {
        $cloth =Cloth::findOrFail($id);
        return view('users/cloth/edit',compact('cloth'));
    }
    public function update(updateClothRequest $request, $id)
    {
        $file= $request->file('image');
        $file1= $request->file('image1');
        $file2= $request->file('image2');
        $file3= $request->file('image3');
        $image1 ="";
        $image ="";
        $image2 ="";
        $image3 ="";
        $imageDelete =Cloth::findOrFail($id)->image;
        $imageDelete1 =Cloth::findOrFail($id)->image1;
        $imageDelete2 = Cloth::findOrFail($id)->image2;
        $imageDelete3 =Cloth::findOrFail($id)->image3;

        if(!empty($file)){
            if (file_exists('images/cloth/one/'.$imageDelete)) {
                unlink('images/cloth/one/'.$imageDelete);
            }
            $image = Carbon::now()->format('y-m-d_h-i-s').".".$file->getClientOriginalName();
            $file->move('images/cloth/one', $image);
        }else {
            $image=$imageDelete;
        }

        if (!empty($file1)){
            if (file_exists('images/cloth/two/'.$imageDelete1)) {
                unlink('images/cloth/two/'.$imageDelete1);
            }
            $image1 = Carbon::now()->format('y-m-d_h-i-s').".".$file1->getClientOriginalName();
            $file1->move('images/cloth/two', $image1);
        }else {
            $image1=$imageDelete1;
        }

        if (!empty($file2)){
            if (file_exists('images/cloth/three/'.$imageDelete2)) {
                unlink('images/cloth/three/'.$imageDelete2);
            }
            $image2 =Carbon::now()->format('y-m-d_h-i-s').".".$file2->getClientOriginalName();
            $file2->move('images/cloth/three', $image2);
        }else {
            $image2=$imageDelete2;
        }

        if (!empty($file3)){
            if (file_exists('images/cloth/four/'.$imageDelete3)) {
                unlink('images/cloth/four/'.$imageDelete3);
            }
            $image3 = Carbon::now()->format('y-m-d_h-i-s').".".$file3->getClientOriginalName();
            $file3->move('images/cloth/four', $image3);
        }else {
            $image3=$imageDelete3;
        }
        Cloth::findOrFail($id)->update([
            'title'=>$request->title,
            'cost'=>$request->cost,
            'address'=>$request->address,
            'description'=>$request->description,
            'image'=>$image,
            'image1'=>$image1,
            'image2'=>$image2,
            'image3'=>$image3,
            'phone'=>$request->phone,

        ]);
        return back();
    }
    public function destroy($id)
    {
    $Deleteimage = Cloth::findOrFail($id)->image;
    $deleteimage1 = Cloth::findOrFail($id)->image1;
    $deleteimage2 = Cloth::findOrFail($id)->image2;
    $deleteimage3 = Cloth::findOrFail($id)->image3;

        if (is_file('images/cloth/one/'.$Deleteimage)) {
            unlink('images/cloth/one/'. $Deleteimage);
        }

        if (is_file('images/cloth/two/'.$deleteimage1)) {
            unlink('images/cloth/two/'. $deleteimage1);
        }

        if (is_file('images/cloth/three/'.$deleteimage2)) {
            unlink('images/cloth/three/'. $deleteimage2);
        }

        if (is_file('images/cloth/four/'.$deleteimage3)) {
            unlink('images/cloth/four/'. $deleteimage3);
        }
        Cloth::destroy($id);
        return back();
    }


}
