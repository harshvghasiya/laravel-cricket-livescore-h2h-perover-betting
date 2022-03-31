<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use Yajra\Datatables\Datatables;

class Support extends Model
{
    use HasFactory;
   public function user_data()
   {
      return $this->belongsTo('\App\Models\User','user_id','id');
   }

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
           $msg=trans('message.support_added_successfully');
          

        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            $msg=trans('message.support_updated_successfully');

        }

        $res->name=$request->name;
        $res->email=$request->email;
        $res->mobile=$request->mobile;
        $res->subject=$request->subject;
        $res->description=$request->description;
        $res->user_id=\Auth::user()->id;
        $res->status=1;

        $res->save();
        

        $url=route('admin.support.index');
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

                  $string ='<a title="'.trans('message.view_support').'" href="'.route('admin.support.view',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-show"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_support_label').'" data-route="'.route('admin.support.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('user_id',function($data){
                 if($data->user_data !=null){
                  $user_email=$data->user_data->email;
                 }else{
                  $user_email="";
                 }
                  return $user_email;
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                  
                  if (isset($request['name']) && $request['name'] != "") {
                      $query->where('name', 'like', '%' . $request->name . '%')
                            ->orwhere('email', 'like', '%' . $request->name . '%')
                            ->orwhere('subject', 'like', '%' . $request->name . '%');
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
        $data=self::with(['user_data','user_data.admin_right'])->find($id);
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
            $msg .= trans('message.support_delete_message_label');
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
      return response()->json(['success' => 1, 'msg' => trans('message.support_delete_message_label')]);
    } 


    public function markAllAsRead($request)
    {
       $res=self::where('status',1)->update(['mark_as_read'=>1]);
       flashMessage('success',trans('message.all_queries_set_as_read'));
       return response()->json(['success'=>1,'msg'=>trans('message.all_queries_set_as_read')]);
    }



  
}
