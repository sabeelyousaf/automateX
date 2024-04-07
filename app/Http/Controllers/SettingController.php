<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(){
        $user=Auth::user();
        $data=Setting::where('user_id',$user->id)->first();
        return view('backend_app.setting',compact('data'));
    }
    public function store(Request $request){

        $request->validate([
            'consumer_key'=>'required',
            'consumer_secreat'=>'required',
            'access_token'=>'required',
            'token_secreat'=>'required',
        ]);

        try {
        $user=Auth::user();
        $check=Setting::where('user_id',$user->id)->first();
        if($check === null){
            $data=new Setting;
            $data->user_id=$user->id;
            $data->consumer_key=$request->consumer_key;
            $data->consumer_secreat=$request->consumer_secreat;
            $data->consumer_access_token=$request->access_token;
            $data->consumer_token_secreat=$request->token_secreat;
            $data->save();
            return back()->with('success','Twitter Key has been Added successfully');
        }
       else{
        $check->consumer_key=$request->consumer_key;
        $check->consumer_secreat=$request->consumer_secreat;
        $check->consumer_access_token=$request->access_token;
        $check->consumer_token_secreat=$request->token_secreat;
        $check->save();
        return back()->with('success','Twitter Key has been updated successfully');
       }

       } catch (\Throwable $th) {

       return back()->with('error',$th->getMessage());

       }
    }
}
