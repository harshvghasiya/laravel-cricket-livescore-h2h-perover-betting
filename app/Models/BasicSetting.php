<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Mail;

class BasicSetting extends Model
{
    use HasFactory;

    protected $table="basic_settings";
    public $timestamps=false;

    /**
     * [Update Of Logo]
     */
    public function updateFavicon($request)
    {
    	$res=self::first();
         if ($res==null) {
         $res=new self;
        }
        if (isset($request->favicon) && !empty($request->favicon)) {
          
            $imageName = UPLOAD_FILE($request,'favicon',FAVICON_IMAGE_UPLOAD_PATH());

            if ($imageName !="") {
              $res->favicon=$imageName;
            }
        }
    	$res->save();

    	$msg="Favicon Updated Successfully!";
    	$errors="";
        $url=route('admin.basic_setting.favicon');
        flashMessage('success',$msg);
        
    	return response()->json(['msg'=>$msg,'errors'=>$errors,'status'=>true,'url'=>$url]);
    } 

     /**
     * [Update  Logo]
     */
    public function updateLogo($request)
    {
        $res=self::first();
        if ($res==null) {
         $res=new self;
        }
        if (isset($request->logo) && !empty($request->logo)) {
          
            $imageName = UPLOAD_FILE($request,'logo',LOGO_IMAGE_UPLOAD_PATH());

            if ($imageName !="") {
              $res->logo=$imageName;
            }
        }
        $res->save();

        $msg="Logo Updated Successfully!";
        $errors="";
        $url=route('admin.basic_setting.logo');
        flashMessage('success',$msg);

        return response()->json(['msg'=>$msg,'errors'=>$errors,'status'=>true,'url'=>$url]);
    }


    /**
     * [Get Image Of Favicon]
     */
    public function getFaviconImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=FAVICON_IMAGE_UPLOAD_PATH().$this->favicon;
        $imageUrl=FAVICON_IMAGE_UPLOAD_URL().$this->favicon;
        if (isset($this->favicon) && !empty($this->favicon) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    } 

    /**
     * [Get Image Of Logo]
     */
    public function getLogoImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=LOGO_IMAGE_UPLOAD_PATH().$this->logo;
        $imageUrl=LOGO_IMAGE_UPLOAD_URL().$this->logo;
        if (isset($this->logo) && !empty($this->logo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }

    
    /**
     * [ update basic info setting ]
     */
    public function updateScript($request,$id)
    {
        $ids=Crypt::decrypt($id);
        $script_setting=BasicSetting::where('id',$ids)->first();
        if ( $request->is_recaptcha == 'on') {
          $script_setting->is_recaptcha=1;
        }else{
          $script_setting->is_recaptcha=0;

        }
        if ($request->is_analytics == 'on') {
          $script_setting->is_analytics=1;
        }else{
          $script_setting->is_analytics=0;

        }
         if ($request->is_default_balance == 'on') {
          $script_setting->is_default_balance=1;
        }else{
          $script_setting->is_default_balance=0;

        }
        $script_setting->google_analytics_script=$request->google_analytics_script;
        $script_setting->default_balance=$request->default_balance;
        $script_setting->default_odd=$request->default_odd;
        $script_setting->google_recaptcha_site_key=$request->google_recaptcha_site_key;
        $script_setting->google_recaptcha_secret_key=$request->google_recaptcha_secret_key;
        $script_setting->save();
         

        $msg=trans('message.scripts_setting_success_msg');
        flashMessage('success',$msg);

        $url=route('admin.basic_setting.script');
        return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);


    }

    /**
     * [ mailConfigUpdate = update mail config]
     */
    public function mailConfigUpdate($request,$id)
    {
        $ids=Crypt::decrypt($id);
        $mail_config=BasicSetting::where('id',$ids)->first();
        
        $mail_config->from_mail=$request->from_mail;
        $mail_config->smtp_host=$request->smtp_host;
        $mail_config->smtp_port=$request->smtp_port;
        $mail_config->encryption=$request->encryption;
        $mail_config->smtp_username=$request->smtp_username;

        try {

            if (\Crypt::decryptString($request->smtp_password) == $mail_config->smtp_password) {

                $mail_config->smtp_password = \Crypt::decryptString($request->smtp_password);
            }

        } catch (DecryptException $e) {
            
            $mail_config->smtp_password = $request->smtp_password;
        }

        $mail_config->smtp_status=$request->smtp_status;
        $mail_config->save();
         

        $msg=trans('message.mail_setting_success_msg');
        $url=route('admin.basic_setting.mail_config');
        flashMessage('success',$msg);
        return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);
    }

    /**
     * [ mailConfigSendMail = update Send mail]
     */
    public function mailConfigSendMail($request,$id)
    {
        $ids=Crypt::decrypt($id);
        $mail_config=BasicSetting::where('id',$ids)->first();
        
        $mail_config->to_mail=$request->to_mail;
        $mail_config->save();


        $mail = new PHPMailer(true);

        // $mail->isSMTP();
        $mail->Host       = $mail_config->smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $mail_config->smtp_username;
        $mail->Password   = $mail_config->smtp_password;
        $mail->SMTPSecure = $mail_config->encryption;
        $mail->Port       = $mail_config->smtp_port;

        //Recipients
        $mail->setFrom($mail_config->from_mail, $mail_config->from_name);
        $mail->addAddress($request->to_mail, "Test");

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Test mail.";
        $mail->Body    = "test mail check content";
        $mail->send();

        $msg=trans('message.mail_sended_Succeess');
        $url=route('admin.basic_setting.mail_config');
        flashMessage('success',$msg);
        return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);
    }
}
