<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\RightModule;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\EmailTemplateRequest;

class EmailTemplateController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_EMAIL_TEMPLATE_SETTING, $this->user
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
        $this->Model=new EmailTemplate;
    }

     


     /**
     * [creare This function is used to show company category form]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
    */

    public function create()
    {
       $title=trans('message.email_template_title');
       return view('admin::email_template.addedit',compact('title'));
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $title=trans('message.email_template_title');
        return view('admin::email_template.index',compact('title'));
    }

    /**
     * [store used for register admin ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function store(EmailTemplateRequest $request)
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
       $title=trans('message.email_template_edit');
       $email_template=$this->Model->getSingleData($id);
       $encryptedId=$id;
       return view('admin::email_template.addedit',compact('title','email_template','encryptedId'));  
    }

    /**
     * [update used for update admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function update(EmailTemplateRequest $request,$id)
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

    /**
     * [statusAll This function is used to active or inactive specific selected banner record]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @authorSofttechover [Harsh V]  [Chirag G].
     */
    public function preview(Request $request,$id){
        
         $emailTemplate =$this->Model->getSingleData($id);
        $email_body = trim($emailTemplate->description);
        return view("admin::emails.mail_template",compact('email_body'));
    }



}
