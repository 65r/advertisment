<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\createBuildingRequest;
use App\Http\Requests\createEtoolsRequest;
use App\Http\Requests\updateBuildingRequest;
use App\Http\Requests\updateEtoolsRequest;
use App\Models\car;
use App\Models\Etool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EtoolsController extends Controller
{

    public function store( createEtoolsRequest  $request){
        $file = $request->file('image');
        $image ="";
        if (!empty('file')){
            $image =Carbon::now()->format('y-m-d_h-i-s').'.'.$file->getClientOriginalName();
            $file->move('images/etools/one/',$image);
        }

        $file1 = $request->file('image1');
        $image1 = "";
        if ($file1 !='') {
            $image1 = Carbon::now()->format('y-m-d_h-i-s').'.'.$file1->getClientOriginalName();
            $file1->move('images/etools/two', $image1);
        }

        $file2 = $request->file('image2');
        $image2 = "";
        if ($file2 !='') {
            $image2 = Carbon::now()->format('y-m-d_h-i-s').'.'.$file2->getClientOriginalName();
            $file2->move('images/etools/three', $image2);
        }

        $file3 = $request->file('image3');
        $image3 = "";
        if ($file3!='') {
            $image3 = Carbon::now()->format('y-m-d_h-i-s').'.'.$file3->getClientOriginalName();
            $file3->move('images/etools/four', $image3);
        }
        Etool::create([
            'title'=>$request->title,
            'companyName'=>$request->companyName,
            'cost'=>$request->cost,
            'address'=>$request->address,
            'sanad'=>$request->sanad,
            'description'=>$request->description,
            'phone'=>$request->phone,
            'image'=>$image,
            'image1'=>$image1,
            'image2'=>$image2,
            'image3'=>$image3,
            'pst_id'=>Str::random(10),
            'user_id'=>\auth()->id()
        ]);
        return back();
    }
    public  function edit($id)
    {
        $etools =Etool::findOrFail($id);
        return view('users/E-tools/edit',compact('etools'));
    }
    public function update(updateEtoolsRequest $request, $id)
    {
        $file= $request->file('image');
        $image ="";
        $imageDelete = Etool::findOrFail($id)->image;
        if (!empty($file)){
            if (file_exists('images/etools/one/'.$imageDelete)) {
                unlink('images/etools/one/'.$imageDelete);
            }
            $image = Carbon::now()->format('y-m-d_h-i-s').".". $file->getClientOriginalName();
            $file->move('images/etools/one', $image);
        }else {
            $image=$imageDelete;
        }

        $file1= $request->file('image1');
        $image1 ="";
        $imageDelete1 = Etool::findOrFail($id)->image1;
        if (!empty($file1)){
            if (file_exists('images/etools/two/'.$imageDelete1)) {
                unlink('images/etools/two/'.$imageDelete1);
            }
            $image1 = Carbon::now()->format('y-m-d_h-i-s').".". $file1->getClientOriginalName();
            $file1->move('images/etools/two', $image1);
        }else {
            $image1=$imageDelete1;
        }

        $file2= $request->file('image2');
        $image2 ="";
        $imageDelete2 = Etool::findOrFail($id)->image2;
        if (!empty($file2)){
            if (file_exists('images/etools/three/'.$imageDelete2)) {
                unlink('images/etools/three/'.$imageDelete2);
            }
            $image2 = Carbon::now()->format('y-m-d_h-i-s').".". $file2->getClientOriginalName();
            $file2->move('images/etools/three', $image2);
        }else {
            $image2=$imageDelete2;
        }

        $file3= $request->file('image3');
        $image3 ="";
        $imageDelete3 = Etool::findOrFail($id)->image3;
        if (!empty($file3)){
            if (file_exists('images/etools/four/'.$imageDelete3)) {
                unlink('images/etools/four/'.$imageDelete3);
            }
            $image3 = Carbon::now()->format('y-m-d_h-i-s').".". $file3->getClientOriginalName();
            $file->move('images/etools/four', $image3);
        }else {
            $image3=$imageDelete3;
        }
        Etool::findOrFail($id)->update([
            'title'=>$request->title,
            'companyName'=>$request->companyName,
            'cost'=>$request->cost,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'sanad'=>$request->sanad,
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
        $deleteimage = Etool::findOrFail($id)->image;
        if (is_file('images/etools/one/'.$deleteimage)) {
            unlink('images/etools/one/'. $deleteimage);
        }
        $deleteimage1 = Etool::findOrFail($id)->image1;
        if (is_file('images/etools/two/'.$deleteimage1)) {
            unlink('images/etools/two/'. $deleteimage1);
        }
        $deleteimage2 = Etool::findOrFail($id)->image2;
        if (is_file('images/etools/three/'.$deleteimage2)) {
            unlink('images/etools/three/'.$deleteimage2);
        }
        $deleteimage3 = Etool::findOrFail($id)->image3;
        if (is_file('images/etools/four/'.$deleteimage3)) {
            unlink('images/etools/four/'. $deleteimage3);
        }

        Etool::destroy($id);
        return back();
    }
    public function create(){
    }
}
