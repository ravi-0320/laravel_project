<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    function login(Request $res)
    {

    if($res->login)
    {
        echo "hello";
        $email = $res->email;
        $pass = $res->pass;

        $userLogin = DB::table('registeruser')->where('email',$email)->where('password',$pass);
        echo $userLogin->count();
        if($userLogin->count()==1)
        {
            $loginData = $userLogin->first();
            session(['user_id' => $loginData->id]);
            return redirect('feed');
        }
    }

        return view('login');
    }


    function Dashbord()
    {
        $user_data = DB::table('registeruser')->get();
        $arry['registeruser'] = $user_data;
        return view('feed',$arry);
    }

    function request_order(Request $res)
    {
        $send_req_data = DB::table('registeruser')->where('id',$res->id)->first();
        $follow_id = $send_req_data->followid;

        if($follow_id==0)
        {
            $follow_id = $res->session()->get('user_id');
        }
        else
        {
            $follow_id = $follow_id.','.$res->session()->get('user_id');
        }

        $update_follow_id = array('followid' =>$follow_id);
        DB::table('registeruser')->where('id',$res->id)->update($update_follow_id);

        $select_user = DB::table('registeruser')->whereNotIn('id',[$res->session()->get('user_id')])->get();
        $arry['user_data'] = $select_user;

        echo view('follow',$arry);

    }
}
