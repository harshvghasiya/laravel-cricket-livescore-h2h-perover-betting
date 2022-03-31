<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\LoginRequest;
use Modules\Admin\Http\Requests\ForgotPasswordRequest;
use Auth;
use Config;
use App\Models\BasicSetting;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{   
    function __construct()
    {
         
    }

    /**
     * [creare This function is used to show admin register form]
     * @return [type] [description]
     * @author Softtechover [Harsh V].
    */

    public function create()
    {
       $title=trans('message.admin_user_register');
       return view('admin::admin_user.register',compact('title'));
    }

    /**
     * [login To get login page view for admin user ]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

     */
    public function login(){

        $basic_setting=BasicSetting::select('is_recaptcha','google_recaptcha_site_key','google_recaptcha_secret_key')->first();
        if ($basic_setting != null && $basic_setting->google_recaptcha_site_key != null) {
        Config::set('captcha.sitekey', $basic_setting->google_recaptcha_site_key);
        Config::set('captcha.secret', $basic_setting->google_recaptcha_secret_key);    
        }
        
        return view('admin::auth.login');
    }

    /**
     * [postLogin This function is used to check login for admin user]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Softtechover [Harsh V].

     */
    public function postLogin(LoginRequest $request)
    {
        // dd($maxAttempts);
        if (\Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            flashMessage('success',trans('message.login_success'));
            $url=route('admin.match.index');
           return response()->json(['msg'=>'Login Success','url'=>$url,'status'=>false]);
            
        } else {
           flashMessage('error',trans('message.valid_pass_email'));
           $error=trans('message.valid_pass_email');
           $url=route('admin.login');
           return response()->json(['error'=>$error,'url'=>$url,'status'=>false]);
        }
    }

    /**
     * [logout To logout user session this function is used]
     * @return [type] [description]
     * @author Softtechover [Harsh V].

     */
    public function logout(){

        \Auth::logout();
        flashMessage('success',trans('message.logout_msg'));
        return redirect(route('admin.login'));
    }

    /**
     * [forgotPassword This function is used to check forgot password logic]
     * @param  Request $r [description]
     * @return [type]     [description]
     */
    public function forgotPassword(ForgotPasswordRequest $r){

        $input = $r->all();
        $checkUserExit = \App\Models\User::where("email",$input['email'])->first();
        if ($checkUserExit == NULL) {

            flashMessage('error',trans('message.this_email_addres_not_exit'));
            $url=route('admin.forgot_password_form');
            return response()->json(['msg'=>trans('message.this_email_addres_not_exit'),'url'=>$url]);

        } else {
            $mail_config=BasicSetting::select('id','is_smtp','from_mail','to_mail','smtp_host','smtp_port','encryption','smtp_username','smtp_password','smtp_status')->first();
            $token = GENERATE_TOKEN();
            $link  = route("admin.reset_password",$token);
            $data  = \App\Models\EmailTemplate::where('title','forgot_password_admin_user')->first();
            $template                         = $data->description;
            $sender                           = $data->from;
            
            $email_body = str_replace(array('###LINK###','###SITE_NAME###'), array($link,route('admin.login')), $template);

                $mail = new PHPMailer(true);

                // $mail->isSMTP();
                $mail->Host       = $mail_config->smtp_host;
                $mail->SMTPAuth   = true;
                $mail->Username   = $mail_config->smtp_username;
                $mail->Password   = $mail_config->smtp_password;
                $mail->SMTPSecure = $mail_config->encryption;
                $mail->Port       = $mail_config->smtp_port;

                //Recipients
                $mail->setFrom($mail_config->from_mail);

                $mail->addAddress($r->email, "Forget Password Link");

                // Content
                $mail->isHTML(true);
                $mail->Subject = $data->subject;
                $mail->Body    = view('admin::emails.mail_template',compact('email_body'));
                $mail->send();
           

            $checkUserExit->forgot_password_token=$token;
            $checkUserExit->save();
            $url=route('admin.login');
            flashMessage('success',trans('message.we_have_sended_link_reset_your_password'));
            return response()->json(['msg'=>trans('message.we_have_sended_link_reset_your_password'),'url'=>$url]);



        }
    }


    public function forgotPasswordForm(Request $request)
    {
        $basic_setting=BasicSetting::select('is_recaptcha','google_recaptcha_site_key','google_recaptcha_secret_key')->first();
        if ($basic_setting != null && $basic_setting->google_recaptcha_site_key != null) {
        Config::set('captcha.sitekey', $basic_setting->google_recaptcha_site_key);
        Config::set('captcha.secret', $basic_setting->google_recaptcha_secret_key);    
        }
        
        $title=trans('message.forget_password');
        return view('admin::auth.forgot_password',compact('title'));
    }

    /**
     * [resetPassword To reset password page this function is used]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function resetPassword($id){

        $user = \App\Models\User::where('forgot_password_token',$id)->first();

        if ($user == null) {
            
            flashMessage('error',trans('message.link_expire_wrong'));
            return redirect()->route('admin.login');

        }else{


            return view("admin::auth.reset_password",compact("user"));
        }

    }

    /**
     * [updatePassword To upddate password after forgot process]
     * @param  Request $r [description]
     * @return [type]     [description]
     */
    public function updatePassword(Request $r,$id){

        $input = $r->all();
        if ($input['password'] == "") {
            
            flashMessage('error',trans('message.password_required'));
            return redirect()->back();            

        }

        if (isset($id)) {
                
            $user = \App\Models\User::where('forgot_password_token',$id)->first();

            if ($user != null) {
                
                $user->password = \Hash::make($input['password']);
                $user->forgot_password_token = NULL;
                $user->save();

                flashMessage('success',trans('message.passowrd_change_done'));
                return redirect()->route('admin.login');

            }else{

                flashMessage('error',trans('message.link_expire_wrong'));
                return redirect()->back();

            }

        }else
        {
            flashMessage('error',trans('message.link_expire_wrong'));
            return redirect()->back();
        }


    }
}
