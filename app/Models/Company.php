<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use App\Models\CompanyLocation;
use App\Models\CompanyContact;
use App\Models\CompanyActivity;
use Yajra\Datatables\Datatables;

class Company extends Model
{
    use HasFactory;
    
    public function company_category()
    {
       return $this->belongsTo('\App\Models\CompanyCategory','company_category_id','id');
    }

    public function company_location()
    {
       return $this->hasMany('\App\Models\CompanyLocation','company_id','id');
    }
    public function company_contact()
    {
       return $this->hasMany('\App\Models\CompanyContact','company_id','id');
    }
    public function company_activity()
    {
       return $this->hasMany('\App\Models\CompanyActivity','company_id','id');
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
           $msg=trans('message.company_added_successfully');
           $description=trans('message.new_company_added');


        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            $msg=trans('message.company_updated_successfully');
           $description=trans('message.new_company_updated');

        }

        $res->name=$request->name;
        $res->company_category_id=$request->company_category_id;
        $res->notes=$request->notes;
        $res->status=$request->status;

        $res->save();

        //Location Id Store 
          \App\Models\CompanyLocation::where('company_id',$res->id)->delete(); 
        foreach ($request->location_id as $key => $value) {
          if ($value != null) {
           $re= new CompanyLocation; 
           $re->company_id=$res->id;
           $re->location_id=$value;
           $re->save();
          }
        }
        // Location Id Store 
          \App\Models\CompanyContact::where('company_id',$res->id)->delete(); 
        foreach ($request->contact_id as $key => $value) {
          if ($value != null) {
           $re= new CompanyContact; 
           $re->company_id=$res->id;
           $re->contact_id=$value;
           $re->save();
          }
        }
        // Activity Id Store 
          \App\Models\CompanyActivity::where('company_id',$res->id)->delete(); 
        foreach ($request->activity_id as $key => $value) {
          if ($value != null) {
           $re= new CompanyActivity; 
           $re->company_id=$res->id;
           $re->activity_id=$value;
           $re->save();
          }
        }
        if ($id == null) {
          PanelActivtyStore($res->id,$res->name,$description,COMPANY_ROUTE_NAME());
        }

        $url=route('admin.company.index');
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

                  $string ='<a title="'.trans('message.edit_company').'" href="'.route('admin.company.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_company_label').'" data-route="'.route('admin.company.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';

                    $string .=' <a  title="'.trans('message.view_company_label').'" href="'.route('admin.company.view',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary" target="_blank"><i class="fadeIn animated bx bx-show"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('company_category',function($data){
                  return $data->company_category->name;
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                  if (isset($request['company_category']) && $request['company_category'] != "") {
                      $query->whereHas('company_category',function($q) use ($request)
                      {
                        $q->where('id', $request['company_category']);
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
      foreach ($input['checkbox'] as $key => $c) {

          $obj = $this->findOrFail(Crypt::decrypt($c));
          $obj->delete();

          CompanyActivity::where('activity_id',Crypt::decrypt($c))->delete();
          CompanyContact::where('activity_id',Crypt::decrypt($c))->delete();
          CompanyLocation::where('activity_id',Crypt::decrypt($c))->delete();
      }

      return response()->json(['success' => 1, 'msg' => trans('message.company_delete_message_label')]);
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
      return response()->json(['success' => 1, 'msg' => trans('message.company_delete_message_label')]);
    }    
}
