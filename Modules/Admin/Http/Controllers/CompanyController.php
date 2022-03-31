<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\RightModule;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_COMPANY_SETTING, $this->user
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
        $this->Model=new Company;
    }

     


     /**
     * [creare This function is used to show company category form]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
    */

    public function create()
    {
       $title=trans('message.add_company_title');
       return view('admin::company.addedit',compact('title'));
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $title=trans('message.company_title');
        return view('admin::company.index',compact('title'));
    }

    /**
     * [store used for register admin ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function store(CompanyRequest $request)
    {
       return $this->Model->store($request);    
    }

    /**
     * [view used for view company ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function view(Request $request,$id)
    {
         try {
           
            if (\Crypt::decrypt($id)) {
               $company=Company::with(['company_category','company_location','company_location.location.city_location.state_name.country_name','company_location.location.contact','company_contact','company_activity','company_activity.activity','company_activity.activity.activity_subject_detail','company_activity.activity.location_detail','company_activity.activity.staff_member_detail'])
                       ->whereHas('company_location',function($qu)
                       {
                           $qu->whereHas('location',function($que)
                           {
                              $que->orderBy('is_main_location','DESC');
                           });
                       })
                       ->where('id',\Crypt::decrypt($id))
                       ->firstorfail();
            }

        } catch (DecryptException $e) {
              abort(404);
        }

        
        $title=$company->name;
       return view('admin::company.view',compact('company','title'));    
    }

    /**
     * [anyData used for get admin list through yajra ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function anyData(Request $request)
    {
       return $this->Model->getListData($request);    
    }

     /**
     * [edit used for edit admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function edit(Request $request,$id)
    {
       $title=trans('message.company_edit');
       $company=$this->Model->getSingleData($id);
       $encryptedId=$id;
       return view('admin::company.addedit',compact('title','company','encryptedId'));  
    }

    /**
     * [update used for update admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function update(CompanyRequest $request,$id)
    {
       
       return $this->Model->store($request,$id);  
    }

    /**
     * [destroy used for destroy admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function destroy(Request $request,$id)
    {
       $request['checkbox']=[$id];
        return $this->Model->deleteAll($request);
    }

    /**
     * [SingleStatusChange This function is active inactive single record .]
     * @param Request $request [description]
     * @author Softtechover [Harsh V] [Chirag G].
     */
    public function SingleStatusChange(Request $request){

        return $this->Model->SingleStatusChange($request);
    }


    /**
     * [deleteAll This function is used to delete specific seletec data]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Softtechover [Harsh V] [Chirag G].
     */
    public function deleteAll(Request $request){
        
        return $this->Model->deleteAll($request);
    }

    /**
     * [statusAll This function is used to active or inactive specific selected banner record]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @authorSofttechover [Harsh V]  [Chirag G].
     */
    public function statusAll(Request $request){
        
        return $this->Model->statusAll($request);
    }


}
