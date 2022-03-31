<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use Yajra\Datatables\Datatables;

class Contact extends Model
{
    use HasFactory;


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
           $msg=trans('message.contact_added_successfully');
           $description=trans('message.new_contact_added');
          

        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            $msg=trans('message.contact_updated_successfully');
            $res->is_main_contact=0;
        }

        $res->full_name=$request->full_name;
        $res->phone_number=$request->phone_number;
        $res->phone_number_2=$request->phone_number_2;
        $res->email_address=$request->email_address;
        $res->notes=$request->notes;
        $res->status=$request->status;
        if ($request->is_main_contact ==1) {
          $r=self::where('is_main_contact',1)->first();
          if ($r != null) {
            
           $r->is_main_contact=0;
           $r->save();
          }
          $res->is_main_contact=1;
        }



        $res->save();
        if ($id==null) {
          PanelActivtyStore($res->id,$res->full_name,$description,CONTACT_ROUTE_NAME());
        }

        $url=route('admin.contact.index');
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

                  $string ='<a title="'.trans('message.edit_contact').'" href="'.route('admin.contact.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_contact_label').'" data-route="'.route('admin.contact.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('main_contact',function($data){
                if ($data->is_main_contact ==1) {
                  $string='<span class="fw-bold text-success">Main Contact</span>';
                }
                else{
                  $string=' <a href="javascript:void(0)" title="'.trans('message.set_main_contact_label').'" data-route="'.route('admin.contact.set_main_contact',Crypt::encrypt($data->id)).'" class="btn btn-sm btn-primary set_main">Set Main</a>';
                }
                  

                  return $string;
              })
              ->editColumn('full_name',function($data){
                  if ($data->is_main_contact==1) {
                    $class="text-success";
                  return '<h5 class="'.$class.' ">'.$data->full_name.'</h5>';

                  }else{
                    $class="";
                    return $data->full_name;
                  }
              })
              ->editColumn('phone_number',function($data){
                  if ($data->is_main_contact==1) {
                    $class="text-success";
                  return '<h5 class="'.$class.'">'.$data->phone_number.'</h5>';

                  }else{
                    $class="";
                    return $data->phone_number;
                  }
              })
              ->editColumn('email_address',function($data){
                  if ($data->is_main_contact==1) {
                    $class="text-success";
                  return '<h5 class="'.$class.'">'.$data->email_address.'</h5>';

                  }else{
                    $class="";
                    return $data->email_address;
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
                      $query->where('full_name', 'like', '%' . $request->name . '%');
                  }
              })
              
              ->rawColumns(['id','full_name','phone_number','main_contact','email_address','action','status'])
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
     * [setMainContact This function will set main contact]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function setMainContact($id){
        $id=Crypt::decrypt($id);
        
         $re=self::where('is_main_contact',1)->first();
         if ($re != null) {
           
         $re->is_main_contact=0;
         $re->save();
         }

        $data=self::find($id);
        $data->is_main_contact=1;
        $data->save();

        $msg=trans('message.main_contact_change_successfully');
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

           $checkModule = \App\Models\CompanyContact::where('contact_id',Crypt::decrypt($c))->get();
           $checkLocation = \App\Models\Location::where('contact_id',Crypt::decrypt($c))->get();
           $contact=\App\Models\Contact::count();
             
          if (!$checkModule->isEmpty() || !$checkLocation->isEmpty()) {
            
            $msg .= trans('message.resource_can_not_be_deleted_since_in_used');
            $status = 2;

          }else if($contact <=1){
            $msg .= trans('message.cannot_delete_last_resource');
            $status = 2;
          }else{

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('message.contact_delete_message_label');
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
      return response()->json(['success' => 1, 'msg' => trans('message.contact_delete_message_label')]);
    } 



    public static function getContactDropDown()
       {
         $arr=self::where('status',self::STATUS_ACTIVE)->orderBy('is_main_contact','DESC')->pluck('full_name','id')->toArray();
         return $arr;
       }   
}
