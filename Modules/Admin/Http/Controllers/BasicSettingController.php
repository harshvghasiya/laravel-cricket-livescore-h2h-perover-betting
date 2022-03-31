<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\BasicSetting;
use App\Models\BasicExtra;
use App\Models\BasicExtended;
use App\Models\RightModule;
use App\Models\Language;
use Modules\Admin\Http\Requests\BasicInfoRequest;
use Modules\Admin\Http\Requests\MailConfigRequest;
use Crypt;

class BasicSettingController extends Controller
{
    function __construct()
    {
        $this->Model=new BasicSetting;
    }

    /**
     * [updateFavicon This function is used to update favicon]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */

    public function updateFavicon(Request $request)
    {
        return $this->Model->updateFavicon($request);
    } 

    /**
     * [updateLogo This function is used to update Logo]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */

    public function updateLogo(Request $request)
    {

        return $this->Model->updateLogo($request);
    }

    /**
     * [favicon This function is used to display  favicon ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function favicon(Request $request)
    {
        if(!CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_FAVICON_SETTING, \Auth::user()
            ) ){
            $succ_msg = trans('message.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.dashboard');
        };
        $title=trans('message.basic_setting_favicon_title');
        $favicon=BasicSetting::select('favicon')->first();
        return view('admin::basic.favicon',compact('title','favicon'));
    }

    /**
     * [script This function is used to display  scripts settings ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function script(Request $request)
    {
        if(!CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_SCRIPT_SETTING, \Auth::user()
            ) ){
            $succ_msg = trans('message.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.dashboard');
        };
        $title=trans('message.basic_setting_script_title');
        $script=BasicSetting::select('id','google_analytics_script','is_recaptcha','google_recaptcha_site_key','google_recaptcha_secret_key','is_analytics','is_default_balance','default_balance','default_odd')->first();
        $encryptedId=Crypt::encrypt($script->id);
        return view('admin::basic.script',compact('title','script','encryptedId'));
    }


    /**
     * [logo This function is used to display  of logo]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function logo(Request $request)
    {
        if(!CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_LOGO_SETTING, \Auth::user()
            ) ){
            $succ_msg = trans('message.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.dashboard');
        };
        $title=trans('message.basic_setting_logo_title');
        $logo=BasicSetting::select('logo')->first();
        return view('admin::basic.logo',compact('title','logo'));
    }

    /**
     * [logo This function is used to display  of logo]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function mailConfig(Request $request)
    {
        if(!CHECK_RIGHTS_TO_ACCESS_DENIED(RightModule::CONST_MAIL_SETTING, \Auth::user()
            ) ){
            $succ_msg = trans('message.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.dashboard');
        };
        $title=trans('message.basic_setting_mail_config_title');
        $mail_config=BasicSetting::select('id','is_smtp','from_mail','to_mail','smtp_host','smtp_port','encryption','smtp_username','smtp_password','smtp_status')->first();
        $encryptedId=Crypt::encrypt($mail_config->id);
        return view('admin::basic.email.mail_from_admin',compact('title','mail_config','encryptedId'));
    }

    /**
     * [basicInfo This function is used to display  information for update basic settings]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function basicInfo(Request $request)
    {

        $title=trans('message.basic_setting_basicinfo_title');
        $lang=Language::with(['basic_setting','basic_extended','basic_extra'])->where('id',Language::lang_id)->first();
      
        $encryptedId=Crypt::encrypt($lang->id);
        return view('admin::basic.basicinfo',compact('title','encryptedId','lang'));
    }

     /**
     * [updateBasicinfo This function is used to Update basic setting information]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    // public function updateBasicinfo(BasicInfoRequest $request,$id)
    // {

    //     return $this->Model->updateBasicinfo($request,$id);
    // }

     /**
     * [updateScript This function is used to Update Scripts Setttings]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function updateScript(Request $request,$id)
    {
        return $this->Model->updateScript($request,$id);
    }

     /**
     * [mailConfigUpdate This function is used to Update mail  Setttings]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function mailConfigUpdate(MailConfigRequest $request,$id)
    {
        return $this->Model->mailConfigUpdate($request,$id);
    }

    /**
     * [mailConfigSendMail This function is used to Send Test mail]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
     */
    public function mailConfigSendMail(MailConfigRequest $request,$id)
    {
        return $this->Model->mailConfigSendMail($request,$id);
    }


}
