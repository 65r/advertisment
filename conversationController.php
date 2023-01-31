<?php

namespace App\Http\Controllers\chat;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class conversationController extends Controller
{

    public function chat_form(Request $request ){
        $new = $request->user_id;
        $me =\auth()->user()->getAuthIdentifier();
        $recieved = conversation::where([
            ['user_two','=',\auth()->user()->getAuthIdentifier()],
        ])->get();
        return view('message/My_chat' ,compact('recieved','me','new'));
    }
    public function store(Request $request ){
         $user_one = \auth()->user()->getAuthIdentifier();
         $message = $request->string('message')->trim();
         $user_two = $request->user_id;
         $pst_id = $request->pst_id;
    conversation::create([
        'message'=>$message->trim(),
        'user_one'=>$user_one,
        'user_two'=>$user_two,
        'pst_id'=>$pst_id,
    ]);
    return back();
    }
    public function my_message(Request $id){
        $me = \auth()->user()->getAuthIdentifier();
         $already_recieved =conversation::
         where('user_two','=',$id)
             ->orwhere('user_one','=',$me)
             ->orwhere('user_two','=',$me)
            ->orwhere('user_one','=',$id)->get();
        return view('message.M_for_you',compact('id','already_recieved'));
    }
}
