<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function delete($id){
        echo $id;
//        User::destroy($id);
//        return back();
    }

    }
