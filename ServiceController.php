<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\createBuildingRequest;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\updateBuildingRequest;
use App\Http\Requests\updateServiceRequest;
use App\Models\car;
use App\Models\service;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function store(CreateServiceRequest  $request){
        service::create([
            'title'=>$request->title,
            'experience'=>$request->experience,
            'level'=>$request->level,
            'sanad'=>$request->sanad,
            'timec'=>$request->timec,
            'phone'=>$request->phone,
            'salary'=>$request->salary,
            'address'=>$request->address,
            'description'=>$request->description,
            'pst_id'=>Str::random(10),
            'user_id'=>auth()->user()->getAuthIdentifier()
        ]);
        return back();
    }
    public function edit($id)
    {
        $service =service::findOrFail($id);
        return view('users.services.edit',compact('service'));
    }
    public function update(updateServiceRequest $request, $id)
    {
        service::findOrFail($id)->update([
            'title'=>$request->title,
            'experience'=>$request->experience,
            'level'=>$request->level,
            'sanad'=>$request->sanad,
            'timec'=>$request->timec,
            'phone'=>$request->phone,
            'salary'=>$request->salary,
            'address'=>$request->address,
            'description'=>$request->description,
        ]);
        return back();
    }
    public function destroy($id)
    {
        service::destroy($id);
        return back();
    }
}
