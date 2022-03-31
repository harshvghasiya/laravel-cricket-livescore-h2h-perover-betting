<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Crypt;
use Yajra\Datatables\Datatables;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
   const STATUS_INACTIVE=0;
   const STATUS_ACTIVE=1;

   public function admin_right()
   {
      return $this->belongsTo('\App\Models\Right','right_id','id');
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
           $res->password=\Hash::make($request->password);
            $msg=trans('message.admin_added_successfully');
          $description=trans('message.new_user_added_msg');


        }else{
            $id=Crypt::decrypt($id);
            $res=self::find($id);
            if ($request->change_password !=null && $request->change_password==1   ) {
              $request->password=\Hash::make($request->password);
            }
            $msg=trans('message.admin_updated_successfully');
        }

        $res->name=$request->name;
        $res->email=$request->email;
        $res->right_id=$request->right_id;
        if (isset($request->image) && $request->image != null) {

            $imageName = UPLOAD_FILE($request,'image',ADMIN_USER_IMAGE_UPLOAD_PATH());
            if ($imageName !="") {
              $res->image = $imageName;
            }
        }

        $res->save();
        if ($id ==null) {
          # code...
          PanelActivtyStore($res->id,$res->name,$description,ADMIN_USER_ROUTE_NAME());
        }
        $url=route('admin.admin_user.index');
          flashMessage('success',$msg);
        
        return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);
    }
      /**
      * [profileUpdate used for register data of admin ]
      * @return [type] [description]
      * @author Softtechover [Harsh V].
      */
      public function profileUpdate($request,$id=null)
      { 

          $id=Crypt::decrypt($id);
          $res=self::find($id);
          $res->name=$request->name;
          $res->email=$request->email;
          if (isset($request->image) && $request->image != null) {

            $imageName = UPLOAD_FILE($request,'image',ADMIN_USER_IMAGE_UPLOAD_PATH());
              if ($imageName !="") {
                 $res->image = $imageName;
                }
              }
          $res->save();
          $msg=trans('message.profile_updated_successfully');
          $url=route('admin.admin_user.profile');
          flashMessage('success',$msg);
          return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);
      }

      /**
      * [passwordUpdate used for password update of admin ]
      * @return [type] [description]
      * @author Softtechover [Harsh V].
      */
      public function passwordUpdate($request,$id=null)
      { 

          $id=Crypt::decrypt($id);
          $res=self::find($id);
         
          $res->password=\Hash::make($request->password);
          $res->save();
          $msg=trans('message.password_updated_successfully');
          $url=route('admin.admin_user.change_password');
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

                  $string ='<a title="'.trans('message.edit_admin_user').'" href="'.route('admin.admin_user.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fadeIn animated bx bx-message-square-edit"></i></a>';

                    if (env('IS_MASTER_ADMIN') == true) {
                      
                    $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_admin_user_label').'" data-route="'.route('admin.admin_user.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                    }
                  
                  
                  return $string;
              })
              ->editColumn('image',function($data){
                  return '<a class="demo" href="'.$data->getAdminUserImageUrl().'" data-lightbox="example-1" data-title="'.$data->name.'" ><img style="height:50px;width:100px" src="'.$data->getAdminUserImageUrl().'"/></a>';
              })
              ->editColumn('id',function($data){
                  return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
              })
              ->editColumn('right_id',function($data){
                  if ($data->admin_right != null) {
                    $name=$data->admin_right->name;
                  }else{
                    $name="";
                  }
                  return $name;
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
                           ->orwhere('email', 'like', '%' . $request->name . '%');
                  }
              })
              ->rawColumns(['id','action','status','image'])
              ->make(true);
    }


    /**
     * [getAdminUserImageUrl This function will return image url of user for profile]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function getAdminUserImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_USER_IMAGE_UPLOAD_PATH().$this->image;
        $imageUrl=ADMIN_USER_IMAGE_UPLOAD_URL().$this->image;
        if (isset($this->image) && !empty($this->image) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
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
      }

      return response()->json(['success' => 1, 'msg' => trans('message.admin_user_delete_message_label')]);
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
      return response()->json(['success' => 1, 'msg' => trans('message.admin_user_delete_message_label')]);
    } 

    public function getStaffDropDown()
       {
         $arr=self::where('status',self::STATUS_ACTIVE)->pluck('name','id')->toArray();
         return $arr;
       }   
}
