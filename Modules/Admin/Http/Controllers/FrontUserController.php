<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\FrontUser;
use App\Models\RightModule;
use App\Models\Bet;
use App\Models\UserContest;
use Illuminate\Routing\Controller;
// use App\Http\Requests\UserRegisterRequest;
use Modules\Admin\Http\Requests\FrontUserRequest;

class FrontUserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_COUNTRY_SETTING, $this->user
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
        $this->Model=new FrontUser;
    }

     


     /**
     * [creare This function is used to show company category form]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
    */

    public function create()
    {
       $title=trans('message.front_user_title');
       return view('admin::front_user.addedit',compact('title'));
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $title=trans('message.front_user_title');
        return view('admin::front_user.index',compact('title'));
    }

    /**
     * [store used for register admin ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function store(FrontUserRequest $request)
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
       $title=trans('message.front_user_edit');
       $front_user=$this->Model->getSingleData($id);
       $encryptedId=$id;
       return view('admin::front_user.addedit',compact('title','front_user','encryptedId'));  
    }

    public function view(Request $request,$id)
    {
       $title=trans('message.front_user_view');
       $front_user=$this->Model->where('id',\Crypt::decrypt($id))->firstOrFail();
        $my_bets=Bet::where('user_id',\Crypt::decrypt($id))->get();
        $user_contest=UserContest::where('user_id',\Crypt::decrypt($id))->get();

        $decrypted_id=\Crypt::decrypt($id);
       return view('admin::front_user.view',compact('title','my_bets','front_user','decrypted_id','user_contest'));  
    }

    /**
     * [update used for update admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function update(FrontUserRequest $request,$id)
    {
       
       return $this->Model->store($request,$id);  
    }
    
    /**
     * [update used for update admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function addBalance(Request $request,$id)
    {
       $title="Add Balance";
       $encryptedId=$id;
       $id=\Crypt::decrypt($id);
       // dd($id);

       $front_user=FrontUser::where('id',$id)->first();
       return view('admin::front_user.add_balance',compact('front_user','title','encryptedId'));  
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
     * [updateBalance used for updateBalance admin data ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function updateBalance(Request $request,$id)
    {
        $id=\Crypt::decrypt($id);
        $res=FrontUser::where('id',$id)->firstOrFail();
        $res->balance=($res->balance)+($request->balance);
        $res->signup_balance=($res->signup_balance)+($request->balance);
        $res->save();

        $resu=new \App\Models\TopupHistory;
        $resu->user_id=$id;
        $resu->topup_balance=$request->balance;
        $resu->save();
        
        $msg="User Balance Updated";
        $url=route('admin.front_user.index');
        flashMessage('success',$msg);
        
        return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);
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

    public function topupView(Request $request,$id)
    {
        $id=\Crypt::decrypt($id);
        $topup_history=\App\Models\TopupHistory::where('user_id',$id)->get();
        $title="Topup History";
        return view('admin::front_user.topup_history',compact('topup_history','title'));
    }


}
