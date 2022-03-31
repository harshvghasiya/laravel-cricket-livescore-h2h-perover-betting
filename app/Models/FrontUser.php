<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Crypt;
use Yajra\Datatables\Datatables;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FrontUser extends Authenticatable
{
	const STATUS_INACTIVE=0;
   const STATUS_ACTIVE=1;

    /**
     * [store used for register data of admin ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function store($request,$id=null)
    { 
        if ($id ==null) {   
           $res=new self;
           $res->password=\Hash::make($request->password);

           $msg=trans('message.front_user_added_successfully');
           $description=trans('message.new_front_user_added');


        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            if ($request->change_password !=null && $request->change_password==1   ) {
              $request->password=\Hash::make($request->password);
            }
            $msg=trans('message.front_user_updated_successfully');

        }

        $res->name=$request->name;
        $res->email=$request->email;
        $res->balance=$request->balance;
        $res->signup_balance=$request->balance;
        $res->mobile=$request->mobile;
        // $res->password=\Hash::make($request->password);
        $res->status=$request->status;

        $res->save();
        if ($id ==null) {
          PanelActivtyStore($res->id,$res->name,$description,FRONTUSER_ROUTE_NAME());
        }

        $url=route('admin.front_user.index');
        flashMessage('success',$msg);
        
        return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);
    }

    /**
     * [getListData used for get admin list through yajra ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function getListData($request)
    {
         $sql=self::select("*");
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                  $string ='<a title="'.trans('message.edit_front_user').'" href="'.route('admin.front_user.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_front_user_label').'" data-route="'.route('admin.front_user.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';

                     $string .=' <a title="'.trans('message.add_balance_front_user').'" href="'.route('admin.front_user.add_balance',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary" ><i class="fadeIn animated bx bx-wallet-alt"></i></a>';

                     $string .=' <a title="'.trans('message.view_batting').'" href="'.route('admin.front_user.view_bet',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-info" style="color:white;"><i class="fadeIn animated bx bx-show-alt"></i></a>';

                   $string .=' <a title="'.trans('message.topup_history').'" href="'.route('admin.front_user.topup_history',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-warning" style="color:white;"><i class="fadeIn animated bx bx-history"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                   
                  if (isset($request['name']) && $request['name'] != "") {
                      $query->where('name', 'like', '%' . $request->name . '%');
                  }
              })
              ->rawColumns(['id','action','status'])
              ->make(true);
    }



    /**
     * [getSingleData This function will return sinlge data of admin]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function getSingleData($id){
        $id=Crypt::decrypt($id);
        $data=self::find($id);
        return $data;
    } 


     /**
     * [deleteAll This funtion is used to delete specific resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Softtechover [Harsh V].

     */
    public function deleteAll($r)
    {

     $input=$r->all();
     $msg="";
      foreach ($input['checkbox'] as $key => $c) {

           

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('message.front_user_delete_message_label');
            $status = 1;
          
          
      }

      return response()->json(['success' => $status, 'msg' => $msg]);
    }


    /**
     * [SingleStatusChange This function is used to active in active single status]
     * @param [type] $r [description]
     * @author softtechover [Chirag G][Harsh V].
     */
    public function SingleStatusChange($r){

      $l = self::where('id',\Crypt::decrypt($r->id))->first();
      if ($l !=NULL) {
          
          if ($l->status == 1) {
            $l->status = self::STATUS_INACTIVE;
          }else{
            $l->status = self::STATUS_ACTIVE;
          }
          $l->save();
          return response()->json(['status' => $l->status]);
      }
    } 

    /**
     * [statusAll This function is used to active or inactive sepcifuc resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author softtechover [Chirag G][Harsh V].
     */
    public function statusAll($r){

      $input=$r->all();
      foreach ($input['checkbox'] as $key => $c) {
            $l = self::where('id',\Crypt::decrypt($c))->first();
            if ($l !=NULL) {
                
                if ($l->status == 1) {
                  $l->status = self::STATUS_INACTIVE;
                }else{
                  $l->status = self::STATUS_ACTIVE;
                }
                $l->save();
            }
      }
      return response()->json(['success' => 1, 'msg' => trans('message.front_user_delete_message_label')]);
    } 



    public static function getfront_userDropDown()
       {
         $arr=self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
         return $arr;
       }   
}
