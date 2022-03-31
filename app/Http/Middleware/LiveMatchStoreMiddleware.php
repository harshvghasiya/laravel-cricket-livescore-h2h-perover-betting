<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LiveMatch;
use Illuminate\Http\Request;

class LiveMatchStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $live_matches=liveMatch();
        if ($live_matches != null) {
           foreach ($live_matches as $key => $value) {
                $eid=$value->id;
                $res=LiveMatch::where('eid',$eid)->first();
                if ($res== null) {
                    $resu=new LiveMatch;
                    $resu->eid=$eid;
                    $resu->team_id1=$value->localteam_id;
                    $resu->team_name1=teamData($value->localteam_id)->name;
                    $resu->team_name2=teamData($value->visitorteam_id)->name;
                    $resu->team_id2=$value->visitorteam_id;
                    if ($value->live == true) {   
                     $resu->status=1;
                    }else{
                        $resu->status=0;
                    }
                    $resu->save();
                }
            } 
        }
        return $next($request);
    }
}
