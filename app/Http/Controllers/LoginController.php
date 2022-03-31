<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\FrontPasswordupdateRequest;
use Illuminate\Http\Request;
use App\Models\FrontUser;
use App\Models\UserContest;
use App\Models\Bet;

class LoginController extends Controller
{
    public function signup(UserRegisterRequest $request)
    {
    	$res=new FrontUser;
    	$res->name=$request->name;
    	$res->email=$request->email;
    	$res->mobile=$request->mobile;
    	$res->password=\Hash::make($request->password);
       
       $setting=\App\Models\BasicSetting::select('id','is_default_balance','default_balance')->first();
        if (isset($setting) && $setting->is_default_balance==1) {
            $res->balance=$setting->default_balance;
        }

        if (isset($request->promo_code) && $request->promo_code != null) {
            $res->promo_code=$request->promo_code;
            $bal=\App\Models\PromoCode::where('name',$request->promo_code)->first();
            $res->balance= ($bal->balance)+($setting->default_balance);
        }
         
        $res->save();
                  
         $msg="Signup SuccessFully Done";
         $url=route('front.home');
         flashMessage('success',$msg);
    	return response()->json(['msg'=>$msg,'success'=>true,'status'=>1,'url'=>$url]);
    }

    public function login(Request $request)
    {
    	// $res=FrontUser::where('status',1)->where('email',$request->email)->first();
    	if(\Auth::guard('front_user')->attempt(['name'=>$request->name,'password'=>$request->password,'status'=>1])){
    		$url=route('front.home');
	        $msg="Welcome" . \Auth::guard('front_user')->user()->name;
	        flashMessage('success',$msg);
	    	return response()->json(['msg'=>$msg,'success'=>false,'status'=>1,'url'=>$url]);
    	}
        
        $url=route('front.home');
        $msg="Login Failed InValid Credential";
        flashMessage('error',$msg);
    	return response()->json(['msg'=>$msg,'success'=>false,'status'=>2,'url'=>$url]);

    }

    public function logout()
    {
    	\Auth::guard('front_user')->logout();
    	flashMessage('success','Logout SuccessFully Done');
    	return redirect()->route('front.home');
    }

    public function changePassword()
    {
    	$setting_class="show active";
    	$dashboard="";
        $top_up_class="";

        $title="Change Password";
    	return view('auth.change_password',compact('setting_class','top_up_class','dashboard','title'));
    }

    public function changePasswordPost(FrontPasswordupdateRequest $request)
    {
    	  $id=\Auth::guard('front_user')->user()->id;
          $res=FrontUser::find($id);
         
          $res->password=\Hash::make($request->password);
          $res->save();
          $msg=trans('message.password_updated_successfully');
          $url=route('front.auth.change_password');
          flashMessage('success',$msg);
          return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);
    	
    }

    public function personalInfo()
    {
    	 $setting_class="show active";
    	$dashboard = "";
        $top_up_class="";

       $title="personalInfo";
    	return view('auth.change_password',compact('setting_class','top_up_class','dashboard','title'));
    }

    public function dashboard()
    {
    	$dashboard = "show active";
    	$setting_class="";
        $top_up_class="";
        $title="Dashboard";
        $my_bets=Bet::where('user_id',\Auth::guard('front_user')->user()->id)->get();
        $user_contest=UserContest::where('user_id',\Auth::guard('front_user')->user()->id)->get();
    	return view('auth.change_password',compact('dashboard','setting_class','my_bets','dashboard','top_up_class','title','user_contest'));
    }

    public function topUp()
    {
        $top_up_class="show active";
        $dashboard="";
        $setting_class="";
        $title="Top Up History";

        $topup_history=\App\Models\TopupHistory::where('user_id',\Auth::guard('front_user')->user()->id)->get();
        return view('auth.change_password',compact('dashboard','setting_class','topup_history','dashboard','title','top_up_class'));

    }
}
