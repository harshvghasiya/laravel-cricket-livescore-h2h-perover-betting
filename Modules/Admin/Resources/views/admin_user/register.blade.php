@extends('admin::layouts.master')
@section('title')
 @if($title != null && $title!= "") {{$title}} @else {{trans('message.basic_setting_logo_head_title')}} @endif | {{trans('message.app_name')}}
@endsection
@section('style')
  <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
<style type="text/css">
    
</style>
@endsection
@section('content')

<div class="page-wrapper">
                <div class="page-content">
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">{{trans('message.admin_user')}}</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(isset($admin_user)) {{trans('message.edit_admin_user_breadcrum')}} @else {{trans('message.add_admin_user_breadcrum')}} @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="row">
                        <div class="col-xl-11 mx-auto">
                            <hr/>
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div>
                                        </div>
                                        <h5 class="mb-0 text-primary">@if(isset($admin_user)) {{trans('message.edit')}} @else {{trans('message.add')}} @endif {{trans('message.admin')}} {{ trans('message.user')}}</h5>
                                    </div>
                                    <hr>
                                     @if(isset($admin_user))
                                        {{ Form::model($admin_user,
                                          array(
                                          'id'                => 'AddEditAdmin',
                                          'class'             => 'FromSubmit row g-3',
                                          'url'               => route('admin.admin_user.update', $encryptedId),
                                          'method'            => 'PUT',
                                          'enctype'           =>"multipart/form-data"
                                          ))
                                        }}
                                        <input type="hidden" name="id" value="{{$encryptedId}}">
                                      @else
                                        {{
                                          Form::open([
                                          'id'=>'AddEditAdmin',
                                          'class'=>'FromSubmit row g-3',
                                          'url'=>route('admin.admin_user.store'),
                                          'name'=>'socialMedia',
                                          'enctype' =>"multipart/form-data"
                                          ])
                                        }}
                                      @endif

                                        <div class="col-md-8">
                                            <label for="name" class="form-label">{{trans('message.admin_name_label')}}</label>
                                            {{ Form::text('name',null,['placeholder'=>trans('message.name_placeholder'),'id'=>'name','class'=>'form-control'])}}
                                        </div>
                                        <div class="col-md-8">
                                            <label for="email" class="form-label">{{trans('message.email_address_label')}}</label>
                                           {{ Form::text('email',null,['placeholder'=>trans('message.email_placeholder'),'id'=>'email','class'=>'form-control'])}}
                                        </div>
                                        @if(!isset($admin_user))
                                        <div class="col-md-8">
                                            <label for="password" class="form-label">{{trans('message.password_label')}}</label>
                                           {{ Form::text('password',null,['placeholder'=>trans('message.password_placeholder'),'id'=>'password','class'=>'form-control'])}}
                                        </div>
                                        @endif
                                        <div class="col-md-8">
                                            <label for="inputState" class="form-label">{{trans('message.right_label')}}</label>
                                            {{ Form::select('right_id',\App\Models\Right::getRightDropDown(),null,['placeholder'=>trans('message.select_right_label'),'id'=>'inputState',"class"=>"form-select select2"])
                                            }}
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{trans('message.image_label')}}</label>
                                           <input class="form-control" onchange=loadFile(event) name="image" type="file">
                                        </div>
                                        <div class="row">
                                          <div class="col-xl-3 mx-auto">
                                              <div class="card">
                                                  <div class="card-body ">
                                                      @if(isset($admin_user))
                                          
                                                        <img class="imagePreview" style="width: 180px; height: 180px;" id="output" src="{{$admin_user->getAdminUserImageUrl()}}"/>
                                                      @else
                                                        <img class="imagePreview" style="width: 180px; height: 180px;" id="output" src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/no_image.png"/>
                                                        @endif
                                                  </div>
                                              </div>
                                          </div>
                                       </div>
                                       @if(isset($admin_user))
                                        <div class="form-check">
                                                  {{ Form::checkbox('change_password',1,null,["class"=>"change_password form-check-input",'id'=>"flexCheckDefault"]) }}
                                                  <label class="form-check-label" for="flexCheckDefault">{{trans('message.change_password')}}</label>
                                        </div>
                                        <div class="col-md-8" style="display: none;" id="show_hide_password">
                                            <label for="password" class="form-label">{{trans('message.password_label')}}</label>
                                           {{ Form::password('password',['placeholder'=>trans('message.password_placeholder'),'id'=>'password','class'=>'form-control'])}}
                                        </div>
                                        @endif
                                        <hr>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4">{{trans('message.save')}}</button>
                                            <a href="{{route('admin.admin_user.index')}}" class="btn btn-secondary">Cancle</a>
                                        </div>
                                    {{Form::close()}}
                                </div>
                               
                            </div>

                            <hr/>
                            
                        </div>
                    </div>
                   
                </div>
            </div>
@endsection
@section('javascript')
  <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/select2/js/select2.min.js"></script>
  <script type="text/javascript">
    $('.select2').select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  </script>
   <script>
     var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            console.log(output.src);
                            output.onload = function() {
                                URL.revokeObjectURL(output.src) // free memory
                            }
                        };
                        </script>
      <script type="text/javascript">
        $(document).on("click",".change_password",function(){

          if ($(".change_password").prop("checked")) {

             $("#show_hide_password").show();

          }else{

            $("#show_hide_password").hide();

          }
    });
      </script>
@endsection
