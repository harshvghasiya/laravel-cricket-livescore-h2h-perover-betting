<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivitySubject;
use App\Models\City;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Location;
use App\Models\User;
use App\Models\CompanyCategory;
use App\Models\State;
use App\Models\RightModule;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\ActivityRequest;

class DashboardController extends Controller
{
    function __construct()
    {
         $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_ACTIVITY_SETTING, $this->user
            ) )
            {
                return $next($request);
            }
            else
            {
                $succ_msg = trans('message.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.dashboard');
            }
        
        }); 
        $this->activity=new Activity;
    }

     


     /**
     * [creare This function is used to show company category form]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
    */

    public function search(Request $request)
    {
      $search_val=$request->search;
      $activity=Activity::where('name', 'like', '%' . $search_val . '%')->first();
      $activty_subject=ActivitySubject::where('title', 'like', '%' . $search_val . '%')->first();
      $company=Company::where('name', 'like', '%' . $search_val . '%')->first();
      $company_category=CompanyCategory::where('name', 'like', '%' . $search_val . '%')->first();
      $contact=Contact::where('full_name', 'like', '%' . $search_val . '%')->first();
      $city=City::where('name', 'like', '%' . $search_val . '%')->first();
      $state=State::where('name', 'like', '%' . $search_val . '%')->first();
      $country=Country::where('name', 'like', '%' . $search_val . '%')->first();
      $location=Location::where('name', 'like', '%' . $search_val . '%')->first();
      $user=User::where('name', 'like', '%' . $search_val . '%')->first();
       $title=trans('message.activity_title');
       return view('admin::search',compact('title','search_val','activity','activty_subject','company','company_category','contact','city','state','country','location','user'));
    }


    public function anyData(Request $request,$model)
    {
      $sql=$model::select("*");
        return Datatables::of($sql)
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                  
                  if (isset($request['name']) && $request['name'] != "") {
                       $query->whereHas('activity_subject_detail',function ($qu) use($request)
                       {
                         $qu->where('title', 'like', '%' . $request->name . '%');

                       });
                  }
                 
                  
              })
              ->rawColumns(['id','action','status'])
              ->make(true);
    }



   
}
