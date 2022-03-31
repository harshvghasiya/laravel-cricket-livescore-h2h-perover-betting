<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bet;
use App\Models\FrontUser;
use App\Models\UserContest;

class MatchController extends Controller
{
    public function betModal(Request $request)
    {
    	$data=$request->all();
      
        $res=\App\Models\LiveMatch::where('eid',$data['eid'])->first();
        
        if ($res == null) {
            $match_data=matchDetail($data['eid']);
            $resu=new \App\Models\LiveMatch;
            $resu->eid=$request->eid;
            $resu->team_id1=$match_data->localteam_id;
            $resu->team_name1=teamData($match_data->localteam_id)->name;
            $resu->team_name2=teamData($match_data->visitorteam_id)->name;
            $resu->team_id2=$match_data->visitorteam_id;
            if ($match_data->live == true) {   
             $resu->status=1;
            }else{
                $resu->status=0;
            }
            $resu->save();
        }
        $res=\App\Models\LiveMatch::where('eid',$data['eid'])->first();

    	return view('matches.popup.betmodal',compact('data','res'));
    }

    public function makeBet(Request $request)
    {
    	if (\Auth::guard('front_user')->user()->balance < $request->bet_value) {
    	 
       		flashMessage('error','You Dont Have enough balance to bet');
    	   return redirect()->route('front.home');
    	  	
    	}
       $odd=\App\Models\LiveMatch::where('eid',$request->eid)->first();
       $setting=\App\Models\BasicSetting::select('default_odd')->first();
    	$res=new Bet;
    	$res->eid=$request->eid;
    	$res->team_id=$request->team_id;
    	$res->bet_value=$request->bet_value;
        if ($odd->team_id1==$request->team_id && $odd->team_1_odd != null) {
            $res->odd=$odd->team_1_odd;
        }else if($odd->team_id2==$request->team_id && $odd->team_1_odd != null){
            $res->odd=$odd->team_2_odd;
        }else{
            $res->odd=$setting->default_odd;
        }
    	$res->user_id=\Auth::guard('front_user')->user()->id;
    	$res->save();

    	$re=FrontUser::where('id',\Auth::guard('front_user')->user()->id)->first();
    	$re->balance= ($re->balance)-($request->bet_value);
    	$re->save();
        
       //  if (liveMatch() != null) {
       //    foreach (liveMatch() as $key => $value) {
       //      $eid= $value->id;
       //      $data=\App\Models\LiveMatch::where('eid',$eid)->first();
       //      if ($data == null && $eid==$request->eid) {
       //           $resu= new \App\Models\LiveMatch;
       //              $resu->eid=$request->eid;
       //              $resu->team_id1=$value->Events[0]->T1[0]->ID;
       //              $resu->team_name1=$value->Events[0]->T1[0]->Nm;
       //              $resu->team_name2=$value->Events[0]->T2[0]->Nm;
       //              $resu->team_id2=$value->Events[0]->T2[0]->ID;
       //              $resu->status=1;
       //              $resu->save();
       //      }
       //    }
       // }

        // $match=\App\Models\LiveMatch::where('eid',$res->eid)->first();
        // if ($match == null) {
        //     $match_data=matchDetail($res->eid);
        //     $resu=new \App\Models\LiveMatch;
        //     $resu->eid=$request->eid;
        //     $resu->team_id1=$match_data->localteam_id;
        //     $resu->team_name1=teamData($match_data->localteam_id)->name;
        //     $resu->team_name2=teamData($match_data->visitorteam_id)->name;
        //     $resu->team_id2=$match_data->visitorteam_id;
        //     if ($match_data->live == true) {   
        //      $resu->status=1;
        //     }else{
        //         $resu->status=0;
        //     }
        //     $resu->save();
        // }


       



    	flashMessage('success','You Bet successfully');
    	return redirect()->route('front.home');
    }

    public function detail(Request $request,$id)
    {
       $id=\Crypt::decrypt($id);
       $title="Match & More ";
       $match_data=matchDetail($id);
       $contest_over=\App\Models\MatchContest::with(['contest_match'])->where('eid',$id)->firstorfail();
       return view('matches.match_detail',compact('title','match_data','contest_over'));
    }

    public function runPerOver(Request $request)
    {
       $data=$request->all();
       $res=new UserContest;
       $res->user_id=\Auth::guard('front_user')->user()->id;
       $res->eid=$request->eid;
       $res->bowler_id=$request->bowler_id;
       $res->team_id=$request->team_id;
       $res->contest_id=$request->contest_id;
       $res->over_run=\Crypt::decrypt($request->over_run);
       $res->over_run_odd=\Crypt::decrypt($request->over_run_odd);
       $res->over_number=$request->over_number;
       $res->balance=$request->bet_value;
       if (isset($request->yes_bet) ) {
         $res->yes_no=1;
       }else{
         $res->yes_no=0;
       }
       $res->save();

       $resu=Frontuser::where('id',\Auth::guard('front_user')->user()->id)->first();
       $resu->balance=($resu->balance)-($request->bet_value);
       $resu->save();

       flashMessage('success','Beted Successfully');
       return redirect()->route('front.home');
    }

    public function sixOver(Request $request)
    {
      $data=$request->all();
       $res=new UserContest;
       $res->user_id=\Auth::guard('front_user')->user()->id;
       $res->eid=$request->eid;
       $res->bowler_id=$request->bowler_id;
       $res->contest_id=$request->contest_id;
       $res->over_run=\Crypt::decrypt($request->six_over_run);
       $res->over_run_odd=\Crypt::decrypt($request->six_over_run_odd);
       $res->over_number=$request->over_number;
       $res->balance=$request->bet_value;
       if (isset($request->yes_bet) ) {
         $res->yes_no=1;
       }else{
         $res->yes_no=0;
       }
       $res->save();

       $resu=Frontuser::where('id',\Auth::guard('front_user')->user()->id)->first();
       $resu->balance=($resu->balance)-($request->bet_value);
       $resu->save();

       flashMessage('success','Beted Successfully');
       return redirect()->route('front.home');
      
    }

    public function upcomingMatch()
    {
        $upcoming_match=\App\Models\UpcomingMatch::where('status',1)->orderBy('start_date_time','ASC')->get();
        $title="Upcoming Matches";
        return view('matches.upcoming_match',compact('upcoming_match','title'));
    }

    public function home()
    {
      $recent_match=\App\Models\LiveMatch::where('status',1)->orderBy('created_at','ASC')->take(4)->get();
      return view('home',compact('recent_match'));
    }
}
