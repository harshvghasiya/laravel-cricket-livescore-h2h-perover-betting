<?php


// Show alert Messages  
function flashMessage($type,$message)
{
    \Session::put($type,$message);
    
}

// Upload And Download Web Url 
function UPLOAD_AND_DOWNLOAD_URL(){

    if (env('IS_LIVE_DEMO_LOCAL') == 'local') {

        return  asset('public');

    }
}

// for Status Icon and Data in yajara box
function getStatusIcon($data){
    if ($data->status == 1) {
        return '<span title="'.trans('message.click_on_button_change_status_label').'" class="btn btn-sm btn-success" id="active_inactive"
        status="1" data-id="'.\Crypt::encrypt($data->id).'">'.trans('message.active').'</span>';
    }else{
        return '<span title="'.trans('message.click_on_button_change_status_label').'" class="btn btn-sm btn-danger" id="active_inactive" 
        status="0" data-id="'.\Crypt::encrypt($data->id).'">'.trans('message.inactive').'</span>';
    }
}

// Web Url Prefix
function ADMIN_PREFIX_KEYWORD()
{
    return 'x11';
}

// Basic Setting prefix keyword
function BASIC_SETTING_PREFIX_KEYWORD()
{
    return 'basic-settings';
}

// Basic setting route prefix keyword
function BASIC_SETTING_ROUTE_NAME()
{
    return 'basic_setting.';
}

// Upload  Images 
function UPLOAD_FILE($r,$name,$uploadPath){

    $image=$r->$name;
    $name = time().''.$image->getClientOriginalName();
    
    $image->move($uploadPath,time().''.$image->getClientOriginalName());
 
    return  $name;
}

// Favicon Upload path
function FAVICON_IMAGE_UPLOAD_PATH()
{
    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/basic_setting/favicon/';
}

// Logo Upload path
function LOGO_IMAGE_UPLOAD_PATH()
{
    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/basic_setting/logo/';
}

// Upload and download path
function UPLOAD_AND_DOWNLOAD_PATH()
{
    return public_path();
}

// Upload and download url
function FAVICON_IMAGE_UPLOAD_URL(){

    return UPLOAD_AND_DOWNLOAD_URL().'/upload/basic_setting/favicon/';
}

// Upload and download url
function LOGO_IMAGE_UPLOAD_URL(){

    return UPLOAD_AND_DOWNLOAD_URL().'/upload/basic_setting/logo/';
}

// If Image not avalaible this image will show
function NO_IMAGE_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'/admin/no_image.png';
}

// Base Currency Symbol position Dropdown
function getBaseCurrencySymbolPositionDropDown()
{
    $arr=[
       'left'=>'Left',
       'right'=>'Right'
    ];

    return $arr;
}

// Base Currency Text Position
function getBaseCurrencyTextPositionDropDown()
{
    $arr=[
      'left'=>'Left',
      'right'=>'right'
    ];
    return $arr;
}

// Currency Route Prefix
function CURRENCY_PREFIX_KEYWORD()
{
    return 'currency';
}

// Currency Route name
function CURRENCY_ROUTE_NAME()
{
    return 'currency.';
}

// Admin user routes prefix
function ADMIN_USER_PREFIX_KEYWORD()
{
    return 'admin-user';
}

// Admin user route name
function ADMIN_USER_ROUTE_NAME()
{
    return 'admin_user.';
}

// Admin user image upload path
function ADMIN_USER_IMAGE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/admin_user/';
}

// Admin user image upload url
function ADMIN_USER_IMAGE_UPLOAD_URL(){

    return UPLOAD_AND_DOWNLOAD_URL().'/upload/admin_user/';
}

// Company Category route prefix
function COMPANY_CATEGORY_PREFIX_KEYWORD()
{
    return 'company-category';
}

// company category route name
function COMPANY_CATEGORY_ROUTE_NAME()
{
    return 'company_category.';
}

// admin module route prefix
function MODULE_PREFIX_KEYWORD()
{
    return 'module';
}

// admin module route name
function MODULE_ROUTE_NAME()
 {
     return 'module.';
 } 

//  Admin right route prefix
function RIGHT_PREFIX_KEYWORD()
{
    return 'right';
}
// Admin Right route name
function RIGHT_ROUTE_NAME()
{
    return 'right.';
}

//company route prefix
function COMPANY_PREFIX_KEYWORD()
 {
    return 'company';
 } 

// cmpany route name
function COMPANY_ROUTE_NAME()
{
    return 'company.';
}

// Activity subject prefix
function ACTIVITY_SUBJECT_PREFIX_KEYWORD()
{
    return 'activity-subject';
}

// Activity subject route name
function ACTIVITY_SUBJECT_ROUTE_NAME()
{
    return 'activity_subject.';
}

// Activity route prefix
function ACTIVITY_PREFIX_KEYWORD()
{
    return 'activity';
}

function ACTIVITY_ROUTE_NAME()
{
    return 'activity.';
}

// Email Template prefix
function EMAIL_TEMPLATE_PREFIX_KEYWORD()
{
    return 'email-template';
}

// EMail Template route name
function EMAIL_TEMPLATE_ROUTE_NAME()
{
    return 'email_template.';
}

// Genrate Token
function GENERATE_TOKEN()
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
     $token = '';
    for ($i = 0; $i < 6; $i++)
    {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }
    $token = time().$token.time();
    return $token;
}

// GET Basic setting data
function GET_BASIC_SETTING()
{
    $data=\App\Models\BasicSetting::select('id','logo','favicon','is_recaptcha','website_title','is_default_balance','default_balance','default_odd')->first();
    return $data;
}

// country prefix keyword
function COUNTRY_PREFIX_KEYWORD()
{
    return 'country';
}

// country route name
function COUNTRY_ROUTE_NAME()
{
    return 'country.';
}

// state route prefix
function STATE_PREFIX_KEYWORD()
{
    return 'state';
}

// state route name
function STATE_ROUTE_NAME()
{
    return 'state.';
}

// City route prefix
function CITY_PREFIX_KEYWORD()
{
    return 'city';
}

// city route name
function CITY_ROUTE_NAME()
{
    return 'city.';
}

// panel activity
function PanelActivtyStore($u_id,$name,$description,$slug)
{
    $res= new \App\Models\PanelActivity;
    $res->u_id=$u_id;
    $res->name=$name;
    $res->description=$description;
    $res->status=1;
    $res->slug=$slug;

    if (\Auth::user() != null) {
        $res->created_by=\Auth::user()->id;
    }
    $res->save();
    return true;
}

// PanelActivty get Data
function PanelActivtyData()
{
    $res=\App\Models\PanelActivity::with(['user_data'])->where('status',1)->orderBy('created_at','DESC')->take(9)->get();
    return $res;
}

// panel activity route prefix
function PANEL_ACTIVTY_PREFIX_KEYWORD()
{
    return 'panel-activty';
}

// Panel Activity route name
function PANEL_ACTIVTY_ROUTE_NAME()
{
    return 'panel_activity.';
}

// Support route prefix
function SUPPORT_PREFIX_KEYWORD()
{
    return 'support';
}

// Support route name
function SUPPORT_ROUTE_NAME()
{
    return 'support.';
}

// contest route prefix
function CONTEST_PREFIX_KEYWORD()
{
    return 'contest';
}

function CONTEST_ROUTE_NAME()
{
    return 'contest.';
}
// support data
 function GetSupportData()
{
    $data=\App\Models\Support::with(['user_data'])->where('status',1)->where('mark_as_read','!=',1)->orderBy('created_at','DESC')->take(9)->get();
    return $data;
}

// Validate User
 function CHECK_RIGHTS_TO_ACCESS_DENIED($module_id,$authuserId)
    {
        $authId=$authuserId;
        if ($authId->is_admin==1) {
            return true;
        }
        $right=\App\Models\Right::find($authId->right_id);
        $module_data=\App\Models\RightModule::where('status',\App\Models\RightModule::STATUS_ACTIVE)->where('right_id',$right->id)->pluck('module_id')->toArray();
        if (!empty($module_data)){
            if (in_array($module_id,$module_data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

// Contact Route prefix
function CONTACT_PREFIX_KEYWORD()
{
    return 'contact';
}

// Contact route name
function CONTACT_ROUTE_NAME()
{
    return 'contact.';
}

// Location route prefix
function LOCATION_PREFIX_KEYWORD()
{
    return 'location';
}

// Location route name
function LOCATION_ROUTE_NAME()
{
    return 'location.';
}

// Search Route
function SEARCH_PREFIX_KEYWORD()
{
    return 'search';
}

// Search Name
function SEARCH_ROUTE_NAME()
{
    return 'search.';
}

// Match routes prefix
function MATCH_PREFIX_KEYWORD()
{
    return 'match';
}

// Match Routes Name
function MATCH_ROUTE_NAME()
{
    return 'match.';
}

// Promo Code Routes PRefix
function PROMOCODE_PREFIX_KEYWORD()
{
    return 'promo-code';
}

// Promo Code ROute Name
function PROMOCODE_ROUTE_NAME()
{
    return 'promo_code.';
}

// Frontuser Route prefix
function FRONTUSER_PREFIX_KEYWORD()
{
    return 'users';
}

// upcoming match Route prefix
function UPCOMING_MATCH_PREFIX_KEYWORD()
{
    
    return 'upcoming-match';
}

// upcomig match route name
function UPCOMING_MATCH_ROUTE_NAME()
{
    return 'upcoming_match.';
}

// Front User Route Name
function FRONTUSER_ROUTE_NAME()
{
    return 'front_user.';
}
function liveMatch()
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://cricket.sportmonks.com/api/v2.0/livescores?api_token=VUQmIiCn6oNCzEVqzgAaHXd3cIhSPBeoWJA3buaeDZrYWQAXCaqAp3riCS7R&include=localteam,visitorteam,runs,balls",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);


            if ($err) {
                $error = "cURL Error #:" . $err;
                return $error;
            } else {
                 $val= json_decode($response);
                 // dd($val);
                 if (isset($val->data)) {               
                   return $val->data;
                 }
                 return false;
            }

//     $val=json_decode('{
//             "resource": "fixtures",
//             "id": 28295,
//             "league_id": 3,
//             "season_id": 507,
//             "stage_id": 2723,
//             "round": "3rd T20I",
//             "localteam_id": 37,
//             "visitorteam_id": 36,
//             "starting_at": "2021-08-06T12:00:00.000000Z",
//             "type": "T20I",
//             "live": true,
//             "status": "1st Innings",
//             "last_period": null,
//             "note": "",
//             "venue_id": 17,
//             "toss_won_team_id": 37,
//             "winner_team_id": null,
//             "draw_noresult": null,
//             "first_umpire_id": 78,
//             "second_umpire_id": 31,
//             "tv_umpire_id": 140,
//             "referee_id": 144,
//             "man_of_match_id": null,
//             "man_of_series_id": null,
//             "total_overs_played": 20,
//             "elected": "batting",
//             "super_over": false,
//             "follow_on": false,
//             "localteam_dl_data": {
//                 "score": 250,
//                 "overs": 49,
//                 "wickets_out": 9
//             },
//             "visitorteam_dl_data": {
//                 "score": 50,
//                 "overs": 25,
//                 "wickets_out": 5
//             },
//             "bowling": [
//             {
//             "resource": "bowlings",
//             "id": 247085,
//             "sort": 1,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 620,
//             "overs": 1,
//             "medians": 0,
//             "runs": 2,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 2,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247091,
//             "sort": 2,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 191,
//             "overs": 4,
//             "medians": 0,
//             "runs": 16,
//             "wickets": 2,
//             "wide": 0,
//             "noball": 1,
//             "rate": 4,
//             "updated_at": "2021-08-06T17:09:03.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247097,
//             "sort": 3,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 44,
//             "overs": 4,
//             "medians": 0,
//             "runs": 24,
//             "wickets": 2,
//             "wide": 1,
//             "noball": 0,
//             "rate": 6,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247103,
//             "sort": 4,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 23,
//             "overs": 4,
//             "medians": 0,
//             "runs": 23,
//             "wickets": 0,
//             "wide": 1,
//             "noball": 0,
//             "rate": 5.75,
//             "updated_at": "2021-08-06T17:08:34.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247106,
//             "sort": 5,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 9906,
//             "overs": 4,
//             "medians": 0,
//             "runs": 34,
//             "wickets": 3,
//             "wide": 0,
//             "noball": 0,
//             "rate": 8.5,
//             "updated_at": "2021-08-06T17:09:44.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247115,
//             "sort": 6,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 31,
//             "overs": 1,
//             "medians": 0,
//             "runs": 15,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 15,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247124,
//             "sort": 7,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 442,
//             "overs": 2,
//             "medians": 0,
//             "runs": 9,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 4.5,
//             "updated_at": "2021-08-06T17:08:01.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247199,
//             "sort": 2,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 9363,
//             "overs": 4,
//             "medians": 1,
//             "runs": 19,
//             "wickets": 1,
//             "wide": 0,
//             "noball": 0,
//             "rate": 4.75,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247205,
//             "sort": 3,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 239,
//             "overs": 4,
//             "medians": 0,
//             "runs": 22,
//             "wickets": 1,
//             "wide": 0,
//             "noball": 0,
//             "rate": 5.5,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247211,
//             "sort": 4,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 237,
//             "overs": 4,
//             "medians": 0,
//             "runs": 9,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 2.25,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247220,
//             "sort": 5,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 9045,
//             "overs": 4,
//             "medians": 0,
//             "runs": 29,
//             "wickets": 2,
//             "wide": 0,
//             "noball": 0,
//             "rate": 7.25,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247232,
//             "sort": 6,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 249,
//             "overs": 1,
//             "medians": 0,
//             "runs": 9,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 9,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247283,
//             "sort": 1,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 234,
//             "overs": 3,
//             "medians": 0,
//             "runs": 29,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 1,
//             "rate": 9.67,
//             "updated_at": "2021-08-06T16:50:25.000000Z"
//             }
//             ],
//             "runs": [
//             {
//             "resource": "runs",
//             "id": 54239,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "inning": 1,
//             "score": 127,
//             "wickets": 9,
//             "overs": 20,
//             "pp1": "1-6",
//             "pp2": null,
//             "pp3": null,
//             "updated_at": "2021-08-06T17:18:58.000000Z"
//             },
//             {
//             "resource": "runs",
//             "id": 54263,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "inning": 2,
//             "score": 117,
//             "wickets": 4,
//             "overs": 20,
//             "pp1": "1-6",
//             "pp2": null,
//             "pp3": null,
//             "updated_at": "2021-08-06T16:51:22.000000Z"
//             }],
//             "balls": [
// {
// "resource": "balls",
// "id": 4137572,
// "fixture_id": 28295,
// "team_id": 37,
// "ball": 0.1,
// "scoreboard": "S1",
// "batsman_one_on_creeze_id": 249,
// "batsman_two_on_creeze_id": 1028,
// "batsman_id": 1028,
// "bowler_id": 191,
// "batsmanout_id": null,
// "catchstump_id": null,
// "runout_by_id": null,
// "score_id": 69,
// "batsman": {
// "resource": "players",
// "id": 1028,
// "country_id": 155043,
// "firstname": "Mohammad",
// "lastname": "Naim",
// "fullname": "Mohammad Naim",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/4/1028.png",
// "dateofbirth": "1999-08-22",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": null,
// "position": {
// "resource": "positions",
// "id": 1,
// "name": "Batsman"
// },
// "updated_at": "2020-04-05T06:15:06.000000Z"
// },
// "bowler": {
// "resource": "players",
// "id": 620,
// "country_id": 98,
// "firstname": "Ashton",
// "lastname": "Turner",
// "fullname": "Ashton Turner",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/12/620.png",
// "dateofbirth": "1993-01-25",
// "gender": "m",
// "battingstyle": "right-hand-bat",
// "bowlingstyle": "right-arm-offbreak",
// "position": {
// "resource": "positions",
// "id": 4,
// "name": "Allrounder"
// },
// "updated_at": "2020-02-06T05:51:32.000000Z"
// },
// "score": {
// "resource": "scores",
// "id": 69,
// "name": "1 Run",
// "runs": 1,
// "four": false,
// "six": false,
// "bye": 0,
// "leg_bye": 0,
// "noball": 0,
// "noball_runs": 0,
// "is_wicket": false,
// "ball": true,
// "out": false
// },
// "team": {
// "resource": "teams",
// "id": 37,
// "name": "Bangladesh",
// "code": "BGD",
// "image_path": "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
// "country_id": 190324,
// "national_team": true,
// "updated_at": "2018-11-29T11:47:20.000000Z"
// },
// "updated_at": "2021-08-06T13:16:15.000000Z"
// }],
//             "rpc_overs": null,
//             "rpc_target": null,
//             "weather_report": []}');

    
    // return array($val);

            // return $response;
    
}

function matchDetail($id =null)
{
    
          $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://cricket.sportmonks.com/api/v2.0/fixtures/$id?api_token=VUQmIiCn6oNCzEVqzgAaHXd3cIhSPBeoWJA3buaeDZrYWQAXCaqAp3riCS7R&include=localteam,visitorteam,runs,balls,batting,bowling",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

            if ($err) {
                $error = "cURL Error #:" . $err;
                return $error;
            } else {
                 $val= json_decode($response);
                 if (isset($val->data)) {               
                   return $val->data;
                 }
                 return false;
            }

//         $val=json_decode('{
//             "resource": "fixtures",
//             "id": 28295,
//             "league_id": 3,
//             "season_id": 507,
//             "stage_id": 2723,
//             "round": "3rd T20I",
//             "localteam_id": 37,
//             "visitorteam_id": 36,
//             "starting_at": "2021-08-06T12:00:00.000000Z",
//             "type": "T20I",
//             "live": false,
//             "status": "Finished",
//             "last_period": null,
//             "note": "Match Win by Australia",
//             "venue_id": 17,
//             "toss_won_team_id": 37,
//             "winner_team_id": 37,
//             "draw_noresult": null,
//             "first_umpire_id": 78,
//             "second_umpire_id": 31,
//             "tv_umpire_id": 140,
//             "referee_id": 144,
//             "man_of_match_id": null,
//             "man_of_series_id": null,
//             "total_overs_played": 20,
//             "elected": "batting",
//             "super_over": false,
//             "follow_on": false,
//             "localteam_dl_data": {
//                 "score": 250,
//                 "overs": 49,
//                 "wickets_out": 9
//             },
//             "visitorteam_dl_data": {
//                 "score": 50,
//                 "overs": 25,
//                 "wickets_out": 5
//             },
//             "bowling": [
//             {
//             "resource": "bowlings",
//             "id": 247085,
//             "sort": 1,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 620,
//             "overs": 1,
//             "medians": 0,
//             "runs": 2,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 2,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247091,
//             "sort": 2,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 191,
//             "overs": 4,
//             "medians": 0,
//             "runs": 16,
//             "wickets": 2,
//             "wide": 0,
//             "noball": 1,
//             "rate": 4,
//             "updated_at": "2021-08-06T17:09:03.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247097,
//             "sort": 3,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 44,
//             "overs": 4,
//             "medians": 0,
//             "runs": 24,
//             "wickets": 2,
//             "wide": 1,
//             "noball": 0,
//             "rate": 6,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247103,
//             "sort": 4,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 23,
//             "overs": 4,
//             "medians": 0,
//             "runs": 23,
//             "wickets": 0,
//             "wide": 1,
//             "noball": 0,
//             "rate": 5.75,
//             "updated_at": "2021-08-06T17:08:34.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247106,
//             "sort": 5,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 9906,
//             "overs": 4,
//             "medians": 0,
//             "runs": 34,
//             "wickets": 3,
//             "wide": 0,
//             "noball": 0,
//             "rate": 8.5,
//             "updated_at": "2021-08-06T17:09:44.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247115,
//             "sort": 6,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 31,
//             "overs": 1,
//             "medians": 0,
//             "runs": 15,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 15,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247124,
//             "sort": 7,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "active": false,
//             "scoreboard": "S1",
//             "player_id": 442,
//             "overs": 2,
//             "medians": 0,
//             "runs": 9,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 4.5,
//             "updated_at": "2021-08-06T17:08:01.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247199,
//             "sort": 2,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 9363,
//             "overs": 4,
//             "medians": 1,
//             "runs": 19,
//             "wickets": 1,
//             "wide": 0,
//             "noball": 0,
//             "rate": 4.75,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247205,
//             "sort": 3,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 239,
//             "overs": 4,
//             "medians": 0,
//             "runs": 22,
//             "wickets": 1,
//             "wide": 0,
//             "noball": 0,
//             "rate": 5.5,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247211,
//             "sort": 4,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 237,
//             "overs": 4,
//             "medians": 0,
//             "runs": 9,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 2.25,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247220,
//             "sort": 5,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 9045,
//             "overs": 4,
//             "medians": 0,
//             "runs": 29,
//             "wickets": 2,
//             "wide": 0,
//             "noball": 0,
//             "rate": 7.25,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247232,
//             "sort": 6,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 249,
//             "overs": 1,
//             "medians": 0,
//             "runs": 9,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 0,
//             "rate": 9,
//             "updated_at": "2021-08-06T16:48:36.000000Z"
//             },
//             {
//             "resource": "bowlings",
//             "id": 247283,
//             "sort": 1,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "active": false,
//             "scoreboard": "S2",
//             "player_id": 234,
//             "overs": 3,
//             "medians": 0,
//             "runs": 29,
//             "wickets": 0,
//             "wide": 0,
//             "noball": 1,
//             "rate": 9.67,
//             "updated_at": "2021-08-06T16:50:25.000000Z"
//             }
//             ],
//             "runs": [
//             {
//             "resource": "runs",
//             "id": 54239,
//             "fixture_id": 28295,
//             "team_id": 37,
//             "inning": 1,
//             "score": 127,
//             "wickets": 9,
//             "overs": 20,
//             "pp1": "1-6",
//             "pp2": null,
//             "pp3": null,
//             "updated_at": "2021-08-06T17:18:58.000000Z"
//             },
//             {
//             "resource": "runs",
//             "id": 54263,
//             "fixture_id": 28295,
//             "team_id": 36,
//             "inning": 2,
//             "score": 117,
//             "wickets": 4,
//             "overs": 20,
//             "pp1": "1-6",
//             "pp2": null,
//             "pp3": null,
//             "updated_at": "2021-08-06T16:51:22.000000Z"
//             }],
//             "balls": [
//             {
// "resource": "balls",
// "id": 4137668,
// "fixture_id": 28295,
// "team_id": 37,
// "ball": 0.6,
// "scoreboard": "S1",
// "batsman_one_on_creeze_id": 249,
// "batsman_two_on_creeze_id": 1028,
// "batsman_id": 249,
// "bowler_id": 191,
// "batsmanout_id": null,
// "catchstump_id": null,
// "runout_by_id": null,
// "score_id": 69,
// "batsman": {
// "resource": "players",
// "id": 249,
// "country_id": 155043,
// "firstname": "Soumya",
// "lastname": "Sarkar",
// "fullname": "Soumya Sarkar",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/25/249.png",
// "dateofbirth": "1993-02-25",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 1,
// "name": "Batsman"
// },
// "updated_at": "2020-02-19T08:15:09.000000Z"
// },
// "bowler": {
// "resource": "players",
// "id": 620,
// "country_id": 98,
// "firstname": "Ashton",
// "lastname": "Turner",
// "fullname": "Ashton Turner",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/12/620.png",
// "dateofbirth": "1993-01-25",
// "gender": "m",
// "battingstyle": "right-hand-bat",
// "bowlingstyle": "right-arm-offbreak",
// "position": {
// "resource": "positions",
// "id": 4,
// "name": "Allrounder"
// },
// "updated_at": "2020-02-06T05:51:32.000000Z"
// },
// "score": {
// "resource": "scores",
// "id": 69,
// "name": "1 Run",
// "runs": 1,
// "four": false,
// "six": false,
// "bye": 0,
// "leg_bye": 0,
// "noball": 0,
// "noball_runs": 0,
// "is_wicket": false,
// "ball": true,
// "out": false
// },
// "team": {
// "resource": "teams",
// "id": 37,
// "name": "Bangladesh",
// "code": "BGD",
// "image_path": "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
// "country_id": 190324,
// "national_team": true,
// "updated_at": "2018-11-29T11:47:20.000000Z"
// },
// "updated_at": "2021-08-06T13:19:26.000000Z"
// },


// {
// "resource": "balls",
// "id": 4137695,
// "fixture_id": 28295,
// "team_id": 37,
// "ball": 2.1,
// "scoreboard": "S1",
// "batsman_one_on_creeze_id": 249,
// "batsman_two_on_creeze_id": 1028,
// "batsman_id": 249,
// "bowler_id": 191,
// "batsmanout_id": null,
// "catchstump_id": null,
// "runout_by_id": null,
// "score_id": 82,
// "batsman": {
// "resource": "players",
// "id": 249,
// "country_id": 155043,
// "firstname": "Soumya",
// "lastname": "Sarkar",
// "fullname": "Soumya Sarkar",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/25/249.png",
// "dateofbirth": "1993-02-25",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 1,
// "name": "Batsman"
// },
// "updated_at": "2020-02-19T08:15:09.000000Z"
// },
// "bowler": {
// "resource": "players",
// "id": 191,
// "country_id": 98,
// "firstname": "Josh",
// "lastname": "Hazlewood",
// "fullname": "Josh Hazlewood",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/31/191.png",
// "dateofbirth": "1991-01-08",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 2,
// "name": "Bowler"
// },
// "updated_at": "2020-02-06T05:04:32.000000Z"
// },
// "score": {
// "resource": "scores",
// "id": 82,
// "name": "No Run",
// "runs": 1,
// "four": false,
// "six": false,
// "bye": 0,
// "leg_bye": 0,
// "noball": 0,
// "noball_runs": 0,
// "is_wicket": false,
// "ball": true,
// "out": false
// },
// "team": {
// "resource": "teams",
// "id": 37,
// "name": "Bangladesh",
// "code": "BGD",
// "image_path": "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
// "country_id": 190324,
// "national_team": true,
// "updated_at": "2018-11-29T11:47:20.000000Z"
// },
// "updated_at": "2021-08-06T13:20:36.000000Z"
// },
// {
// "resource": "balls",
// "id": 4137728,
// "fixture_id": 28295,
// "team_id": 37,
// "ball": 2.2,
// "scoreboard": "S1",
// "batsman_one_on_creeze_id": 249,
// "batsman_two_on_creeze_id": 1028,
// "batsman_id": 249,
// "bowler_id": 191,
// "batsmanout_id": null,
// "catchstump_id": null,
// "runout_by_id": null,
// "score_id": 82,
// "batsman": {
// "resource": "players",
// "id": 249,
// "country_id": 155043,
// "firstname": "Soumya",
// "lastname": "Sarkar",
// "fullname": "Soumya Sarkar",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/25/249.png",
// "dateofbirth": "1993-02-25",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 1,
// "name": "Batsman"
// },
// "updated_at": "2020-02-19T08:15:09.000000Z"
// },
// "bowler": {
// "resource": "players",
// "id": 191,
// "country_id": 98,
// "firstname": "Josh",
// "lastname": "Hazlewood",
// "fullname": "Josh Hazlewood",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/31/191.png",
// "dateofbirth": "1991-01-08",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 2,
// "name": "Bowler"
// },
// "updated_at": "2020-02-06T05:04:32.000000Z"
// },
// "score": {
// "resource": "scores",
// "id": 82,
// "name": "No Run",
// "runs": 1,
// "four": false,
// "six": false,
// "bye": 0,
// "leg_bye": 0,
// "noball": 0,
// "noball_runs": 0,
// "is_wicket": false,
// "ball": true,
// "out": false
// },
// "team": {
// "resource": "teams",
// "id": 37,
// "name": "Bangladesh",
// "code": "BGD",
// "image_path": "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
// "country_id": 190324,
// "national_team": true,
// "updated_at": "2018-11-29T11:47:20.000000Z"
// },
// "updated_at": "2021-08-06T13:21:37.000000Z"
// },
//         {
//         "resource": "balls",
//         "id": 4137572,
//         "fixture_id": 28295,
//         "team_id": 37,
//         "ball": 2.3,
//         "scoreboard": "S1",
//         "batsman_one_on_creeze_id": 249,
//         "batsman_two_on_creeze_id": 1028,
//         "batsman_id": 1028,
//         "bowler_id": 191,
//         "batsmanout_id": null,
//         "catchstump_id": null,
//         "runout_by_id": null,
//         "score_id": 69,
//         "batsman": {
//         "resource": "players",
//         "id": 1028,
//         "country_id": 155043,
//         "firstname": "Mohammad",
//         "lastname": "Naim",
//         "fullname": "Mohammad Naim",
//         "image_path": "https://cdn.sportmonks.com/images/cricket/players/4/1028.png",
//         "dateofbirth": "1999-08-22",
//         "gender": "m",
//         "battingstyle": "left-hand-bat",
//         "bowlingstyle": null,
//         "position": {
//         "resource": "positions",
//         "id": 1,
//         "name": "Batsman"
//         },
//         "updated_at": "2020-04-05T06:15:06.000000Z"
//         },
//         "bowler": {
//         "resource": "players",
//         "id": 620,
//         "country_id": 98,
//         "firstname": "Ashton",
//         "lastname": "Turner",
//         "fullname": "Ashton Turner",
//         "image_path": "https://cdn.sportmonks.com/images/cricket/players/12/620.png",
//         "dateofbirth": "1993-01-25",
//         "gender": "m",
//         "battingstyle": "right-hand-bat",
//         "bowlingstyle": "right-arm-offbreak",
//         "position": {
//         "resource": "positions",
//         "id": 4,
//         "name": "Allrounder"
//         },
//         "updated_at": "2020-02-06T05:51:32.000000Z"
//         },
//         "score": {
//         "resource": "scores",
//         "id": 69,
//         "name": "1 Run",
//         "runs": 1,
//         "four": false,
//         "six": false,
//         "bye": 0,
//         "leg_bye": 0,
//         "noball": 0,
//         "noball_runs": 0,
//         "is_wicket": false,
//         "ball": true,
//         "out": false
//         },
//         "team": {
//         "resource": "teams",
//         "id": 37,
//         "name": "Bangladesh",
//         "code": "BGD",
//         "image_path": "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
//         "country_id": 190324,
//         "national_team": true,
//         "updated_at": "2018-11-29T11:47:20.000000Z"
//         },
//         "updated_at": "2021-08-06T13:16:15.000000Z"
//         },
//     {
// "resource": "balls",
// "id": 4137668,
// "fixture_id": 28295,
// "team_id": 37,
// "ball": 2.4,
// "scoreboard": "S1",
// "batsman_one_on_creeze_id": 249,
// "batsman_two_on_creeze_id": 1028,
// "batsman_id": 249,
// "bowler_id": 191,
// "batsmanout_id": null,
// "catchstump_id": null,
// "runout_by_id": null,
// "score_id": 69,
// "batsman": {
// "resource": "players",
// "id": 249,
// "country_id": 155043,
// "firstname": "Soumya",
// "lastname": "Sarkar",
// "fullname": "Soumya Sarkar",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/25/249.png",
// "dateofbirth": "1993-02-25",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 1,
// "name": "Batsman"
// },
// "updated_at": "2020-02-19T08:15:09.000000Z"
// },
// "bowler": {
// "resource": "players",
// "id": 620,
// "country_id": 98,
// "firstname": "Ashton",
// "lastname": "Turner",
// "fullname": "Ashton Turner",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/12/620.png",
// "dateofbirth": "1993-01-25",
// "gender": "m",
// "battingstyle": "right-hand-bat",
// "bowlingstyle": "right-arm-offbreak",
// "position": {
// "resource": "positions",
// "id": 4,
// "name": "Allrounder"
// },
// "updated_at": "2020-02-06T05:51:32.000000Z"
// },
// "score": {
// "resource": "scores",
// "id": 69,
// "name": "1 Run",
// "runs": 1,
// "four": false,
// "six": false,
// "bye": 0,
// "leg_bye": 0,
// "noball": 0,
// "noball_runs": 0,
// "is_wicket": false,
// "ball": true,
// "out": false
// },
// "team": {
// "resource": "teams",
// "id": 37,
// "name": "Bangladesh",
// "code": "BGD",
// "image_path": "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
// "country_id": 190324,
// "national_team": true,
// "updated_at": "2018-11-29T11:47:20.000000Z"
// },
// "updated_at": "2021-08-06T13:19:26.000000Z"
// },


// {
// "resource": "balls",
// "id": 4137695,
// "fixture_id": 28295,
// "team_id": 37,
// "ball": 2.5,
// "scoreboard": "S1",
// "batsman_one_on_creeze_id": 249,
// "batsman_two_on_creeze_id": 1028,
// "batsman_id": 249,
// "bowler_id": 191,
// "batsmanout_id": null,
// "catchstump_id": null,
// "runout_by_id": null,
// "score_id": 82,
// "batsman": {
// "resource": "players",
// "id": 249,
// "country_id": 155043,
// "firstname": "Soumya",
// "lastname": "Sarkar",
// "fullname": "Soumya Sarkar",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/25/249.png",
// "dateofbirth": "1993-02-25",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 1,
// "name": "Batsman"
// },
// "updated_at": "2020-02-19T08:15:09.000000Z"
// },
// "bowler": {
// "resource": "players",
// "id": 191,
// "country_id": 98,
// "firstname": "Josh",
// "lastname": "Hazlewood",
// "fullname": "Josh Hazlewood",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/31/191.png",
// "dateofbirth": "1991-01-08",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 2,
// "name": "Bowler"
// },
// "updated_at": "2020-02-06T05:04:32.000000Z"
// },
// "score": {
// "resource": "scores",
// "id": 82,
// "name": "No Run",
// "runs": 1,
// "four": false,
// "six": false,
// "bye": 0,
// "leg_bye": 0,
// "noball": 0,
// "noball_runs": 0,
// "is_wicket": false,
// "ball": true,
// "out": false
// },
// "team": {
// "resource": "teams",
// "id": 37,
// "name": "Bangladesh",
// "code": "BGD",
// "image_path": "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
// "country_id": 190324,
// "national_team": true,
// "updated_at": "2018-11-29T11:47:20.000000Z"
// },
// "updated_at": "2021-08-06T13:20:36.000000Z"
// },



// {
// "resource": "balls",
// "id": 4137728,
// "fixture_id": 28295,
// "team_id": 37,
// "ball": 2.6,
// "scoreboard": "S1",
// "batsman_one_on_creeze_id": 249,
// "batsman_two_on_creeze_id": 1028,
// "batsman_id": 249,
// "bowler_id": 191,
// "batsmanout_id": null,
// "catchstump_id": null,
// "runout_by_id": null,
// "score_id": 82,
// "batsman": {
// "resource": "players",
// "id": 249,
// "country_id": 155043,
// "firstname": "Soumya",
// "lastname": "Sarkar",
// "fullname": "Soumya Sarkar",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/25/249.png",
// "dateofbirth": "1993-02-25",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 1,
// "name": "Batsman"
// },
// "updated_at": "2020-02-19T08:15:09.000000Z"
// },
// "bowler": {
// "resource": "players",
// "id": 191,
// "country_id": 98,
// "firstname": "Josh",
// "lastname": "Hazlewood",
// "fullname": "Josh Hazlewood",
// "image_path": "https://cdn.sportmonks.com/images/cricket/players/31/191.png",
// "dateofbirth": "1991-01-08",
// "gender": "m",
// "battingstyle": "left-hand-bat",
// "bowlingstyle": "right-arm-fast-medium",
// "position": {
// "resource": "positions",
// "id": 2,
// "name": "Bowler"
// },
// "updated_at": "2020-02-06T05:04:32.000000Z"
// },
// "score": {
// "resource": "scores",
// "id": 82,
// "name": "No Run",
// "runs": 1,
// "four": false,
// "six": false,
// "bye": 0,
// "leg_bye": 0,
// "noball": 0,
// "noball_runs": 0,
// "is_wicket": false,
// "ball": true,
// "out": false
// },
// "team": {
// "resource": "teams",
// "id": 37,
// "name": "Bangladesh",
// "code": "BGD",
// "image_path": "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
// "country_id": 190324,
// "national_team": true,
// "updated_at": "2018-11-29T11:47:20.000000Z"
// },
// "updated_at": "2021-08-06T13:21:37.000000Z"
// }],
//             "rpc_overs": null,
//             "rpc_target": null,
//             "weather_report": []}');
//     return $val;
}

function leagueById($id=null)
{
               $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://cricket.sportmonks.com/api/v2.0/leagues/$id?api_token=VUQmIiCn6oNCzEVqzgAaHXd3cIhSPBeoWJA3buaeDZrYWQAXCaqAp3riCS7R&include=",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

            if ($err) {
                $error = "cURL Error #:" . $err;
                return $error;
            } else {
                 $val= json_decode($response);
                 if (isset($val->data)) {               
                   return $val->data;
                 }
                 return false;
            }
}


function teamData($id=null)
{
               $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://cricket.sportmonks.com/api/v2.0/teams/$id?api_token=VUQmIiCn6oNCzEVqzgAaHXd3cIhSPBeoWJA3buaeDZrYWQAXCaqAp3riCS7R&include=",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

            if ($err) {
                $error = "cURL Error #:" . $err;
                return $error;
            } else {
                 $val= json_decode($response);
                 if (isset($val->data)) {               
                   return $val->data;
                 }
                 return false;
            }
}

function playerData($id=null)
{
               $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://cricket.sportmonks.com/api/v2.0/players/$id?api_token=VUQmIiCn6oNCzEVqzgAaHXd3cIhSPBeoWJA3buaeDZrYWQAXCaqAp3riCS7R&include=",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

            if ($err) {
                $error = "cURL Error #:" . $err;
                return $error;
            } else {
                 $val= json_decode($response);
                 if (isset($val->data)) {               
                   return $val->data;
                 }
                 return false;
            }
}




?>