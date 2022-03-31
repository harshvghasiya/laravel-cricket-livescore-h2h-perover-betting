<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use App\Models\RightModule;
use Yajra\Datatables\Datatables;
use Auth;

class Right extends Model
{
    use HasFactory;

    public function right_module()
    {
      return $this->hasMany('\App\Models\RightModule','right_id','id');
    }

    public function right_admin()
    {
      return $this->belongsTo('\App\Models\User','right_id','id');
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
           $msg=trans('message.right_added_successfully');
          $description=trans('message.new_right_add');

           
        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            RightModule::where('right_id',$id)->delete();
            $msg=trans('message.right_updated_successfully');

        }
        if (Auth::user() != null) {
        	$res->created_by=Auth::user()->id;
        }



        $res->name=$request->name;
        $res->status=$request->status;
        $res->save();
        if ($id ==null) {
          PanelActivtyStore($res->id,$res->name,$description,RIGHT_ROUTE_NAME());
        }
        foreach ($request->module_id as $key => $value) {
          $right_module=new RightModule;
          $right_module->right_id=$res->id;
          $right_module->module_id=$value;
          $right_module->save();
        }
        $url=route('admin.right.index');
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

                  $string ='<a title="'.trans('message.edit_right').'" href="'.route('admin.right.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';
   
                   if (env('IS_MASTER_ADMIN')==true) {
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_right_label').'" data-route="'.route('admin.right.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                                    }                 
                  
                  
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
        $data=self::with(['right_module'])->find($id);
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
      foreach ($input['checkbox'] as $key => $c) {

          $obj = $this->findOrFail(Crypt::decrypt($c));
          $obj->delete();
      }

      return response()->json(['success' => 1, 'msg' => trans('message.right_delete_message_label')]);
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
      return response()->json(['success' => 1, 'msg' => trans('message.right_delete_message_label')]);
    } 

    public static function getRightDropDown()
       {
          $arr=self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
          return $arr;
       }   
}
