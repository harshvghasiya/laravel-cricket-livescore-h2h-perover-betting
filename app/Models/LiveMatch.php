<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use Yajra\Datatables\Datatables;

class LiveMatch extends Model
{
    use HasFactory;

   protected $table="matches";

   const STATUS_INACTIVE=0;
   const STATUS_ACTIVE=1;
  
   public function match_contest()
   {
      return $this->hasOne('\App\Models\MatchContest','match_id','id');
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
           $msg=trans('message.match_added_successfully');
           $description=trans('message.new_match_added');


        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            $msg=trans('message.match_updated_successfully');

        }

        $res->team_1_odd=$request->team_1_odd;
        $res->team_2_odd=$request->team_2_odd;
        $res->draw=$request->draw;

        $res->save();
        
        $resu=MatchContest::where('match_id',$id)->first();
        if ($resu == null) {
          $resu= new MatchContest;
        }
        $resu->over_run=$request->over_run;
        $resu->over_run_odd=$request->over_run_odd;
        $resu->eid=$request->eid;
        $resu->match_id=$id;
        $resu->six_over_run=$request->six_over_run;
        $resu->six_over_run_odd=$request->six_over_run_odd;
        $resu->ten_over_run =$request->ten_over_run;
        $resu->ten_over_run_odd =$request->ten_over_run_odd;
        $resu->fifteen_over_run =$request->fifteen_over_run;
        $resu->fifteen_over_run_odd =$request->fifteen_over_run_odd;
        $resu->twenty_over_run =$request->twenty_over_run;
        $resu->twenty_over_run_odd =$request->twenty_over_run_odd;

        $resu->over_run_status=$request->over_run_status;
        $resu->six_over_status=$request->six_over_status;
        $resu->ten_over_status=$request->ten_over_status;
        $resu->fifteen_over_status=$request->fifteen_over_status;
        $resu->twenty_over_status=$request->twenty_over_status;
        $resu->save();
        if ($id ==null) {
          PanelActivtyStore($res->id,$res->name,$description,MATCH_ROUTE_NAME());
        }

        $url=route('admin.match.index');
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
         $setting=\App\Models\BasicSetting::select('default_odd')->first();
         $sql=self::select("*");
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                  $string ='<a title="'.trans('message.edit_match').'" href="'.route('admin.match.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_match_label').'" data-route="'.route('admin.match.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                  
                  
                  return $string;
              })
              ->editColumn('team_1_odd',function($data) use($setting){
                  if ($data->team_1_odd == null) {
                    return $setting->default_odd;
                  }
                  return $data->team_1_odd;
              })
              ->editColumn('team_2_odd',function($data) use($setting){
                  if ($data->team_2_odd == null) {
                    return $setting->default_odd;
                  }
                  return $data->team_2_odd;
              })
              ->editColumn('draw',function($data) use($setting){
                  if ($data->draw == null) {
                    return $setting->default_odd;
                  }
                  return $data->draw;
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
            $msg .= trans('message.match_delete_message_label');
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
      return response()->json(['success' => 1, 'msg' => trans('message.match_delete_message_label')]);
    } 



    // public static function getmatchDropDown()
    //    {
    //      $arr=self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
    //      return $arr;
    //    }   
}
