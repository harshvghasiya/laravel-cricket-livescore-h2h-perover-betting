<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightModule extends Model
{
    use HasFactory;
    public $timestamps=false;
    const STATUS_ACTIVE=1;
    const STATUS_INACTIVE=0;
    const CONST_LOGO_SETTING = 1;
    const CONST_FAVICON_SETTING = 2;
    const CONST_SCRIPT_SETTING = 3;
    const CONST_MAIL_SETTING = 4;
    const CONST_EMAIL_TEMPLATE_SETTING = 5;
    const CONST_COUNTRY_SETTING = 6;
    const CONST_STATE_SETTING = 7;
    const CONST_CITY_SETTING = 8;
    const CONST_COMPANY_SETTING = 9;
    const CONST_COMPANY_CATEGORY_SETTING = 10;
    const CONST_ACTIVITY_SUBJECT_SETTING = 11;
    const CONST_SUPPORT_SETTING = 12;
    const CONST_NOTIFICATION_SETTING = 13;
    const CONST_PROFILE_SETTING = 14;
    const CONST_CHANGE_PASSWORD_SETTING = 15;
    const CONST_CONTACT_SETTING=16;
    const CONST_LOCATION_SETTING=17;
    const CONST_ACTIVITY_SETTING=18;

   

}
