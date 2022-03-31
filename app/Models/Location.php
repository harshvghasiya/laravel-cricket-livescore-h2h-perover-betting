<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use Yajra\Datatables\Datatables;

class Location extends Model
{
    use HasFactory;

   
   const STATUS_INACTIVE=0;
   const STATUS_ACTIVE=1;

   public function city_location()
   {
     return $this->belongsTo('\App\Models\City','city_id','id');
   }

   public function contact()
   {
     return $this->belongsTo('\App\Models\Contact','contact_id','id');
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
           $msg=trans('message.location_added_successfully');
           $description=trans('message.new_location_added');
          

        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            $msg=trans('message.location_updated_successfully');
            $res->is_main_location=0;
        }

        $res->name=$request->name;
        $res->contact_id=$request->contact_id;
        $res->address_1=$request->address_1;
        if (isset($request->address_2) && $request->address_2 != null) {
          $res->address_2=$request->address_2;
        }
        $res->city_id=$request->city_id;
        $res->country_id=$request->country_id;
        $res->state_id=$request->state_id;
        $res->notes=$request->notes;
        $res->status=$request->status;
        if ($request->is_main_location ==1) {
          $r=self::where('is_main_location',1)->first();
          if ($r != null) {
            
           $r->is_main_location=0;
           $r->save();
          }
          $res->is_main_location=1;
        }



        $res->save();
        if ($id==null) {
          PanelActivtyStore($res->id,$res->name,$description,location_ROUTE_NAME());
        }

        $url=route('admin.location.index');
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

                  $string ='<a title="'.trans('message.edit_location').'" href="'.route('admin.location.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_location_label').'" data-route="'.route('admin.location.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('main_location',function($data){
                if ($data->is_main_location ==1) {
                  $string='<span class="fw-bold text-success">Main Location</span>';
                }
                else{
                  $string=' <a href="javascript:void(0)" title="'.trans('message.set_main_location_label').'" data-route="'.route('admin.location.set_main_location',Crypt::encrypt($data->id)).'" class="btn btn-sm btn-primary set_main">Set Main</a>';
                }
                  

                  return $string;
              })
              ->editColumn('name',function($data){
                  if ($data->is_main_location==1) {
                    $class="text-success";
                  return '<h5 class="'.$class.'">'.$data->name.'</h5>';

                  }else{
                    $class="";
                    return $data->name;
                  }
              })
              ->editColumn('address_1',function($data){
                  if ($data->is_main_location==1) {
                    $class="text-success";
                  return '<h5 class="'.$class.'">'.$data->address_1.'</h5>';

                  }else{
                    $class="";
                    return $data->address_1;
                  }
              })
              
              ->editColumn('city',function($data){
                  $city=null;
                  $state=null;
                  $country=null;
                  $pincode=null;
                 if (isset($data->city_location) && $data->city_location != null) {
                       $city=$data->city_location->name;
                       if (isset($data->city_location->state_name) && $data->city_location->state_name != null) {
                         $state=$data->city_location->state_name->name;
                       }
                       if (isset($data->city_location->state_name->country_name) && $data->city_location->state_name->country_name != null) {
                         $country=$data->city_location->state_name->country_name->name;
                       }
                   }
                  $address= $city .', '. $state .', ' . $country .' ,'. $data->city_location->pin_code;
                  if ($data->is_main_location==1) {
                    $class="text-success";
                  return '<h5 class="'.$class.'">'.$address.'</h5>';

                  }else{
                    $class="";
                    return $address;
                  }
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
              
              ->rawColumns(['id','name','main_location','address_1','city','action','status'])
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
     * [setMainLocation This function will set main contact]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function setMainLocation($id){
        $id=Crypt::decrypt($id);
        
         $re=self::where('is_main_location',1)->first();
         if ($re != null) {
           
         $re->is_main_location=0;
         $re->save();
         }

        $data=self::find($id);
        $data->is_main_location=1;
        $data->save();

        $msg=trans('message.main_location_change_successfully');
        return response()->json(['msg'=>$msg,'success'=>1]);
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

           $checkModule = \App\Models\CompanyLocation::where('location_id',Crypt::decrypt($c))->get();
           $checkactivity=\App\Models\Activity::where('location_id',Crypt::decrypt($c))->get();
           
           $location=\App\Models\Location::count();
          if (!$checkModule->isEmpty() || !$checkactivity->isEmpty()) {
            
            $msg .= trans('message.resource_can_not_be_deleted_since_in_used');
            $status = 2;

          }else if($location <=1){
            $msg .= trans('message.cannot_delete_last_resource');
            $status = 2;
          }else{

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('message.location_delete_message_label');
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
     * [autoComplete This function is used to auto complete location]
     * @param [type] $r [description]
     * @author softtechover [Chirag G][Harsh V].
     */
    public function autoComplete($r){

      $pin_code=$r->pin_code;
      $city=\App\Models\City::with(['state_name','state_name.country_name'])->where('pin_code', 'like', '%' . $pin_code . '%')->first();
      if ($city == null) {
        return response()->json(['country_name'=>$country_name,'state_name'=>$state_name,'city_name'=>$city_name]); 
      }
      $city_name=$city->id;
      $state_name=$city->state_id;
      $country_name=$city->state_name->country_name->id;
      return response()->json(['country_name'=>$country_name,'state_name'=>$state_name,'city_name'=>$city_name]);

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
      return response()->json(['success' => 1, 'msg' => trans('message.location_delete_message_label')]);
    } 



    public static function getLocationDropDown()
       {
         $arr=self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
         return $arr;
       }   
}
