<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use Yajra\Datatables\Datatables;

class Activity extends Model
{
    use HasFactory;


   const STATUS_INACTIVE=0;
   const STATUS_ACTIVE=1;
   const Model='Activity';
    

    public function activity_subject_detail()
    {
      return $this->belongsTo('\App\Models\ActivitySubject','activity_subject_id','id');
    }
     public function location_detail()
    {
      return $this->belongsTo('\App\Models\Location','location_id','id');
    }

    public function staff_member_detail()
    {
      return $this->belongsTo('\App\Models\User','staff_member_user_id','id');
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
           $msg=trans('message.activity_added_successfully');
           $description=trans('message.new_activity_added');
          

        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            $msg=trans('message.activity_updated_successfully');

        }
        
        $res->start_datetime=$request->start_datetime;
        $res->name=$request->name;
        $res->end_datetime=$request->end_datetime;
        $res->location_id=$request->location_id;
        $res->activity_subject_id=$request->activity_subject_id;
        $res->notes=$request->notes;
        $res->staff_member_user_id=$request->staff_member_user_id;
        $res->status=$request->status;

        $res->save();
        if ($id==null) {
          PanelActivtyStore($res->id,$res->name,$description,ACTIVITY_ROUTE_NAME());
        }

        $url=route('admin.activity.index');
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

                  $string ='<a title="'.trans('message.edit_activity').'" href="'.route('admin.activity.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_activity_label').'" data-route="'.route('admin.activity.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('activity_subject',function($data){
                 $activity_subject="-";
                   if (isset($data->activity_subject_detail) && $data->activity_subject_detail != null) {
                     $activity_subject=$data->activity_subject_detail->title;
                   }
                  return $activity_subject;
              })
              ->editColumn('location',function($data){
                 $location="-";
                   if (isset($data->location_detail) && $data->location_detail != null) {
                     $location=$data->location_detail->name;
                   }
                  return $location;
              })
              // ->editColumn('staff_member',function($data){
              //    $staff_member="-";
              //      if (isset($data->staff_member_detail) && $data->staff_member_detail != null) {
              //        $staff_member=$data->staff_member_detail->name;
              //      }
              //     return $staff_member;
              // })
              ->editColumn('start_date',function($data){
                 $data=$data->start_datetime .' - '. $data->end_datetime;
                 return $data;
              })
              ->editColumn('duration',function($data){
                  
                   $start = \Carbon\Carbon::parse($data->start_datetime);
                   $end=\Carbon\Carbon::parse($data->end_datetime);
                     $duration_hours=$start->diffInHours($end);
                     $duration_days=$start->diffInDays($end);
                  
                 return $duration_days . ' Days ' . '('. $duration_hours .' Hours )';
              })
              ->editColumn('status',function($data){
                  return getStatusIcon($data);
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                  
                  if (isset($request['name']) && $request['name'] != "") {
                       $query->whereHas('activity_subject_detail',function ($qu) use($request)
                       {
                         $qu->where('title', 'like', '%' . $request->name . '%');

                       });
                  }
                  // dd($request['activity_subject']);
                  if (isset($request['activity_subject']) && $request['activity_subject'] != "" && !empty($request['activity_subject']) && is_array($request['activity_subject']) && array_filter($request['activity_subject']) !=null) {
                     $query->whereHas('activity_subject_detail',function($qu) use($request)
                     {
                       $qu->whereIn('id',$request['activity_subject']);
                     });

                  }

                  if (isset($request['start_date']) && !empty($request['start_date']) && isset($request['end_date']) && !empty($request['end_date'])) {

                    $query->where('start_datetime','<=',$request['start_date'])
                            ->orwhere('end_datetime','>=',$request['end_date']);

                }elseif(isset($request['start_date']) && !empty($request['start_date'])){

                        $query->where('start_datetime','<=',$request['start_date']);

                }elseif(isset($request['end_date']) && !empty($request['end_date'])){

                        $query->where('end_datetime','>=',$request['end_date']);
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

           $checkModule = \App\Models\CompanyActivity::where('activity_id',Crypt::decrypt($c))->get();

          if (!$checkModule->isEmpty()) {
            
            $msg .= trans('message.resource_can_not_be_deleted_since_in_used');
            $status = 2;

          }else{

            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg .= trans('message.activity_delete_message_label');
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
      return response()->json(['success' => 1, 'msg' => trans('message.activity_delete_message_label')]);
    } 



    public static function getActivityDropDown()
       {
         $arr=self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
         return $arr;
       }   
}
