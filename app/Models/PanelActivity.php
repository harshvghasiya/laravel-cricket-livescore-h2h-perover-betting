<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;

class PanelActivity extends Model
{
    use HasFactory;
    protected $table="panel_activity";

    public function user_data()
    {
    	return $this->belongsTo('\App\Models\User','created_by','id');
    }
    public function admin_data()
    {
        return $this->belongsTo('\App\Models\User','admin_id','id');
    }


    /**
     * [statusAll This function is used to active or inactive sepcifuc resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author softtechover [Chirag G][Harsh V].
     */
    public function statusAll($r)
    {
      $res=self::where('status',1)->update(['status'=>0]);
            
      return response()->json(['success' => 1, 'msg' => trans('message.panel_activity_change_Status_message_label')]);
    } 

    /**
     * [seeDetail This function is used to see detail of activity notification]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author softtechover [Harsh V].
     */
    public function seeDetail($r,$slug)
    {
      if ($slug != null && \Route::has('admin.'.$slug.'index')) {
         return redirect()->route('admin.'.$slug.'index');         
        } else{
            flashMessage('error',trans('message.currently_page_not_availble'));
            return redirect()->back();
        }      
    } 

    /**
     * [allNotifications This function is used to see all activity notification]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author softtechover [Harsh V].
     */
    public function allNotifications($r)
    {
        $all_notifications=self::orderBy('created_at','DESC')->paginate('10');
        $title=trans('message.view_all_notifications');
        return view('admin::panel_activity.all_notifications',compact('all_notifications','title'));
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
            $msg .= trans('message.panel_activity_delete_message_label');
            $status = 1;
      }

      return response()->json(['success' => $status, 'msg' =>$msg,'type'=>'panel_activity']);
    }
 
}

