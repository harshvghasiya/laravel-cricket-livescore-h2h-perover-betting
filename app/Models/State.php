<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use Yajra\Datatables\Datatables;

class State extends Model
{
    use HasFactory;


   const STATUS_INACTIVE=0;
   const STATUS_ACTIVE=1;


    public function country_name()
    {
       return $this->belongsTo('\App\Models\Country','country_id','id');
    }
    /**
     * [store used for register data of admin ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

    */
    public function store($request,$id=null)
    { 
        if ($id ==null) {   
           $res=new self;
           $msg=trans('message.state_added_successfully');
          $description=trans('message.new_state_add');
           

        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            $msg=trans('message.state_updated_successfully');

        }

        $res->name=$request->name;
        $res->code=$request->code;
        $res->country_id=$request->country_id;
        $res->status=$request->status;

        $res->save();
        if ($id ==null) {
          # code...
         PanelActivtyStore($res->id,$res->name,$description,STATE_ROUTE_NAME());
        }
        $url=route('admin.state.index');
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

                  $string ='<a title="'.trans('message.edit_state').'" href="'.route('admin.state.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_state_label').'" data-route="'.route('admin.state.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->editColumn('country_id',function($data){
                 if ($data->country_name != null) {
                   $country=$data->country_name->name .' ( '. $data->country_name->code.' )';
                 }else{
                  $country="";
                 }
                  return $country;
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                  if (isset($request['country_id']) && $request['country_id'] != "") {
                      $query->whereHas('country_name',function($q) use ($request)
                      {
                        $q->where('id', $request['country_id']);
                      });
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

           $checkModule = \App\Models\State::where('state_id',Crypt::decrypt($c))->get();

          if (!$checkModule->isEmpty()) {
            
            $msg .= trans('message.resource_can_not_be_deleted_since_in_used');
            $status = 2;

          }else{

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('message.state_delete_message_label');
            $status = 1;
          
          }
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
      return response()->json(['success' => 1, 'msg' => trans('message.state_delete_message_label')]);
    } 


    //This function used in city module to get state data on change coyntry 
    public static function getStateDropDown($country_id)
    {
         $arr=self::where('country_id',$country_id)->where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
         return $arr;
    }

    //This function is used to all state drop down
    public static function allStateDropDown()
     {
       $arr=self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
       return $arr;
     } 
}
