<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use Yajra\Datatables\Datatables;

class City extends Model
{
    use HasFactory;
   

   const STATUS_INACTIVE=0;
   const STATUS_ACTIVE=1;


    public function state_name()
    {
       return $this->belongsTo('\App\Models\State','state_id','id');
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
           $msg=trans('message.city_added_successfully');
           $description=trans('message.new_city_added');
           

        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            $msg=trans('message.city_updated_successfully');
           $description=trans('message.new_city_updated');

        }
        if (\Auth::user() !=null) {
          $res->created_by=\Auth::user()->id;
        }
        $res->name=$request->name;
        $res->pin_code=$request->pin_code;
        $res->state_id=$request->state_id;
        $res->status=$request->status;

        $res->save();
        if ($id== null) {
          PanelActivtyStore($res->id,$res->name,$description,CITY_ROUTE_NAME());
        }
        $url=route('admin.city.index');
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

                  $string ='<a title="'.trans('message.edit_city').'" href="'.route('admin.city.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_city_label').'" data-route="'.route('admin.city.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->editColumn('state_id',function($data){
                 if ($data->state_name != null) {
                   $state=$data->state_name->name ;
                 }else{
                  $state="";
                 }
                  return $state;
              })
              ->editColumn('country_id',function($data){
                 if ($data->state_name != null) {
                   if($data->state_name->country_name != null){ 
                      $country=$data->state_name->country_name->name .' ( '. $data->state_name->country_name->code.' )';
                   }else{
                    $country="";
                   }
                 }else{
                  $country="";
                 }
                  return $country;
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                  if (isset($request['state_id']) && $request['state_id'] != "") {
                      $query->whereHas('state_name',function($q) use ($request)
                      {
                        $q->where('id', $request['state_id']);
                      });
                  }
                  if (isset($request['country_id']) && $request['country_id'] != "") {
                      $query->whereHas('state_name',function($q) use ($request)
                      {
                        $q->whereHas('country_name',function($qu) use ($request)
                        {
                          $qu->where('id',$request['country_id']);
                        });
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

          
            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('message.city_delete_message_label');
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
      return response()->json(['success' => 1, 'msg' => trans('message.city_delete_message_label')]);
    } 

   public static function getCityDropDown()
    {
      $arr=self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
        return $arr;
    }   

   
}
