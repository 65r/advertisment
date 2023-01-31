<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\createCarRequest;
use App\Http\Requests\updateCarRequest;
use App\Models\car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class carController extends Controller
{



    public function store(createCarRequest $request)
    {
        $file = $request->file('image');
        $image = "";
        if (!empty('file')) {
            $image =Carbon::now()->format('y-m-d_h-i-s').".".$file->getClientOriginalName();
            $file->move('images/car/one', $image);
        }

        $file1 = $request->file('image1');
        $image1 = "";
        if ($file1!='') {
            $image1 = Carbon::now()->format('y-m-d_h-i-s').".".$file1->getClientOriginalName();
            $file1->move('images/car/two', $image1);
        }
        $file2 = $request->file('image2');
        $image2 = "";
        if ($file2!='') {
            $image2 = Carbon::now()->format('y-m-d_h-i-s').".".$file2->getClientOriginalName();
            $file2->move('images/car/three', $image2);
        }
        $file3 = $request->file('image3');
        $image3 = "";
        if ($file3!='') {
            $image3 =Carbon::now()->format('y-m-d_h-i-s').".".$file3->getClientOriginalName();
            $file3->move('images/car/four', $image3);
        }
        car::create([
            'type' => $request->type,
            'model' => $request->model,
            'circle' => $request->circle,
            'gerbox' => $request->gerbox,
            'cost' => $request->cost,
            'sanad' => $request->sanad,
            'address' => $request->address,
            'description' => $request->description,
            'phone'=>$request->phone,
            'image' => $image,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'pst_id'=>Str::random(10),
            'user_id'=>\auth()->id()

        ]);
        return back();
    }
    public function edit($id)
    {
        $car = car::findOrFail($id);
        return view('users/car/edit', compact('car'));
    }
    public function update(updateCarRequest $request, $id)
    {
        $file = $request->file('image');
        $image = "";
        $imageDelete = car::findOrFail($id)->image;
        if (!empty($file)) {
            if (file_exists('images/car/one/'.$imageDelete)) {
                unlink('images/car/one/'.$imageDelete);
            }
            $image = Carbon::now()->format('y-m-d_h-i-s').".".$file->getClientOriginalName();
            $file->move('images/car/one',$image);
        } else {
            $image = $imageDelete;
        }

        $file1 = $request->file('image1');
        $image1 = "";
        $imageDelete1 = car::findOrFail($id)->image1;
        if (!empty($file1)) {
            if (file_exists('images/car/two/'.$imageDelete1)) {
                unlink('images/car/two/'.$imageDelete1);
            }
            $image1 = Carbon::now()->format('y-m-d_h-i-s').".".$file1->getClientOriginalName();
            $file1->move('images/car/two',$image1);
        } else {
            $image1 = $imageDelete1;
        }

        $file2 = $request->file('image2');
        $image2 = "";
        $imageDelete2 = car::findOrFail($id)->image2;
        if (!empty($file2)) {
            if (file_exists('images/car/three/'.$imageDelete2)) {
                unlink('images/car/three/'.$imageDelete2);
            }
            $image2 = Carbon::now()->format('y-m-d_h-i-s').".".$file2->getClientOriginalName();
            $file2->move('images/car/three',$image2);
        } else {
            $image2 = $imageDelete2;
        }

        $file3 = $request->file('image3');
        $image3 = "";
        $imageDelete3 = car::findOrFail($id)->image3;
        if (!empty($file3)) {
            if (file_exists('images/car/four/'.$imageDelete3)) {
                unlink('images/car/four/'.$imageDelete3);
            }
            $image3 = Carbon::now()->format('y-m-d_h-i-s').".".$file2->getClientOriginalName();
            $file3->move('images/car/four',$image3);
        } else {
            $image3 = $imageDelete3;
        }

        car::findOrFail($id)->update([
            'type' => $request->type,
            'model' => $request->model,
            'circle' => $request->circle,
            'gerbox' => $request->gerbox,
            'phone' => $request->phone,
            'cost' => $request->cost,
            'sanad' => $request->sanad,
            'address' => $request->address,
            'description' => $request->description,
            'image' => $image,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
        ]);
        return back();
    }

    public function destroy($id)
    {
        $deleteimage = car::findOrFail($id)->image;
        if (is_file('images/car/one/'.$deleteimage)) {
            unlink('images/car/one/'. $deleteimage);
        }
        $deleteimage1 = car::findOrFail($id)->image1;
        if (is_file('images/car/two/'.$deleteimage1)) {
            unlink('images/car/two/'. $deleteimage1);
        }
        $deleteimage2 = car::findOrFail($id)->image2;
        if (is_file('images/car/three/'.$deleteimage2)) {
            unlink('images/car/three/'. $deleteimage2);
        }
        $deleteimage3 = car::findOrFail($id)->image3;
        if (is_file('images/car/four/'.$deleteimage3)) {
            unlink('images/car/four/'. $deleteimage3);
        }
        car::destroy($id);
        return back();
    }
}
