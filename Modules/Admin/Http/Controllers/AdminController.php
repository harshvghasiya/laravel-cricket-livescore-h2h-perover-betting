<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use App\Models\RightModule;
use Modules\Admin\Http\Requests\AdminRegisterRequest;
use Modules\Admin\Http\Requests\PasswordupdateRequest;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if ($this->user->is_admin==1)
            {
                return $next($request);
            }
            else
            {
                $succ_msg = trans('message.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.dashboard');
            }
        
        })->except(['dashboard','profile','changePassword']);
        $this->Model=new User;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $title=trans('message.admin_user_title');
        return view('admin::admin_user.index',compact('title'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
        $title=trans('message.dashboard_title');
        return view('admin::dashboard',compact('title'));
    }



    /**
     * [store used for register admin ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function store(AdminRegisterRequest $request)
    {
       return $this->Model->store($request);    
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
       $title=trans('message.admin_user_edit');
       $admin_user=$this->Model->getSingleData($id);
       $encryptedId=$id;
       return view('admin::admin_user.register',compact('title','admin_user','encryptedId'));  
    }

    /**
     * [update used for update admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function update(AdminRegisterRequest $request,$id)
    {
       
       return $this->Model->store($request,$id);  
    }
    /**
     * [passwordUpdate used for password Update of admin ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function passwordUpdate(PasswordupdateRequest $request,$id)
    {
       
       return $this->Model->passwordUpdate($request,$id);  
    }

    /**
     * [profile_update used for profile_update admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function profile_update(Request $request,$id)
    {
       
       return $this->Model->profileUpdate($request,$id);  
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

    /**
     * [profile This function is used to show profile]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @authorSofttechover [Harsh V]  [Chirag G].
     */
    public function profile(Request $request)
    {
        if(!CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_PROFILE_SETTING, \Auth::user()
            ) || \Auth::user()->is_admin!=1){
            $succ_msg = trans('message.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.dashboard');
        };
        $title =trans('message.profile_title');
        return view('admin::admin_user.profile',compact('title'));
    }

    /**
     * [changePassword This function is used to show changePassword form]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @authorSofttechover [Harsh V]  [Chirag G].
     */
    public function changePassword(Request $request)
    {
        if(!CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_CHANGE_PASSWORD_SETTING, \Auth::user()
            ) || \Auth::user()->is_admin!=1){
            $succ_msg = trans('message.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.dashboard');
        };
        $title =trans('message.change_password_title');
        return view('admin::auth.change_password',compact('title'));
    }


}
