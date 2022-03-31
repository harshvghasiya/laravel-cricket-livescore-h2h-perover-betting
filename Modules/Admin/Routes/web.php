<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix'=>ADMIN_PREFIX_KEYWORD(),'middleware'=>'web','as'=>'admin.'],function()
{
    Route::any('login', 'LoginController@login')->name('login');
    Route::any('postlogin', 'LoginController@postLogin')->name('postlogin')->middleware("throttle:3,2");
    Route::any('forgot-password-post', 'LoginController@forgotPassword')->name('forgot_password')->middleware("throttle:3,2");
    Route::any('forgot-password', 'LoginController@forgotPasswordForm')->name('forgot_password_form');
    Route::any('reset-password/{id}', 'LoginController@resetPassword')->name('reset_password');
    Route::any('update-password/{id}', 'LoginController@updatePassword')->name('update_password');


  
});

Route::group(['prefix' => ADMIN_PREFIX_KEYWORD(),'middleware'=>['auth','web','live_match'],'as'=>'admin.'], function()
{
    // Routes
    Route::get('/', 'AdminController@dashboard')->name('dashboard');

    Route::any('logout', 'LoginController@logout')->name('logout');

    // Basic Settings Routes
    Route::group(['prefix'=>BASIC_SETTING_PREFIX_KEYWORD(),'as'=>BASIC_SETTING_ROUTE_NAME()],function()
    {
       Route::any('favicon', 'BasicSettingController@favicon')->name('favicon');
       Route::any('logo', 'BasicSettingController@logo')->name('logo');
       Route::any('scripts', 'BasicSettingController@script')->name('script');
       Route::any('mail-config', 'BasicSettingController@mailConfig')->name('mail_config');
       Route::any('mail-config-update/{id}', 'BasicSettingController@mailConfigUpdate')->name('mail_config_update');
       Route::any('mail-config-sendmail/{id}', 'BasicSettingController@mailConfigSendMail')->name('mail_config_send_mail');
       Route::any('update_favicon', 'BasicSettingController@updateFavicon')->name('update_favicon');
       Route::any('update_logo', 'BasicSettingController@updateLogo')->name('update_logo');
       Route::any('basicinfo', 'BasicSettingController@basicInfo')->name('basicinfo');
       Route::any('update_basicinfo/{id}', 'BasicSettingController@updateBasicinfo')->name('update_basicinfo');
       Route::any('update_script/{id}', 'BasicSettingController@updateScript')->name('update_script');
    });


    // Admin User Routes
    Route::group(['prefix'=>ADMIN_USER_PREFIX_KEYWORD(),'as'=>ADMIN_USER_ROUTE_NAME()],function()
    {
       Route::any('create', 'LoginController@create')->name('create');
       Route::any('profile', 'AdminController@profile')->name('profile');
       Route::any('change-password', 'AdminController@changePassword')->name('change_password');
       Route::any('store', 'AdminController@store')->name('store');
       Route::any('edit/{id}', 'AdminController@edit')->name('edit');
       Route::any('update/{id}', 'AdminController@update')->name('update');
       Route::any('profile_update/{id}', 'AdminController@profile_update')->name('profile_update');
       Route::any('password_update/{id}', 'AdminController@passwordUpdate')->name('password_update');
       Route::any('destroy/{id}', 'AdminController@destroy')->name('destroy');
       Route::any('/', 'AdminController@index')->name('index');
       Route::any('any_data', 'AdminController@anyData')->name('any_data');
       Route::any('delete-all','AdminController@deleteAll')->name('delete_all');
       Route::any('status-all','AdminController@statusAll')->name('status_all');
       Route::any('single_status_change', 'AdminController@singleStatusChange')->name('single_status_change');
       
    });
   
    // Company Category Routes
    // Route::group(['prefix'=>COMPANY_CATEGORY_PREFIX_KEYWORD(),'as'=>COMPANY_CATEGORY_ROUTE_NAME()],function()
    // {
    //    Route::any('create', 'CompanyCategoryController@create')->name('create');
    //    Route::any('store', 'CompanyCategoryController@store')->name('store');
    //    Route::any('edit/{id}', 'CompanyCategoryController@edit')->name('edit');
    //    Route::any('update/{id}', 'CompanyCategoryController@update')->name('update');
    //    Route::any('destroy/{id}', 'CompanyCategoryController@destroy')->name('destroy');
    //    Route::any('/', 'CompanyCategoryController@index')->name('index');
    //    Route::any('any_data', 'CompanyCategoryController@anyData')->name('any_data');
    //    Route::any('delete-all','CompanyCategoryController@deleteAll')->name('delete_all');
    //    Route::any('status-all','CompanyCategoryController@statusAll')->name('status_all');
    //    Route::any('single_status_change', 'CompanyCategoryController@singleStatusChange')->name('single_status_change');
       
    // });

    // Support  Routes
    Route::group(['prefix'=>SUPPORT_PREFIX_KEYWORD(),'as'=>SUPPORT_ROUTE_NAME()],function()
    {
       Route::any('create', 'SupportController@create')->name('create');
       Route::any('store', 'SupportController@store')->name('store');
       Route::any('edit/{id}', 'SupportController@edit')->name('edit');
       Route::any('view/{id}', 'SupportController@view')->name('view');
       Route::any('update/{id}', 'SupportController@update')->name('update');
       Route::any('destroy/{id}', 'SupportController@destroy')->name('destroy');
       Route::any('/', 'SupportController@index')->name('index');
       Route::any('/mark-all-as-read', 'SupportController@markAllAsRead')->name('mark_all_as_read');
       Route::any('any_data', 'SupportController@anyData')->name('any_data');
       Route::any('delete-all','SupportController@deleteAll')->name('delete_all');
       Route::any('status-all','SupportController@statusAll')->name('status_all');
       Route::any('single_status_change', 'SupportController@singleStatusChange')->name('single_status_change');
       
    });

    // Country Category Routes
    Route::group(['prefix'=>COUNTRY_PREFIX_KEYWORD(),'as'=>COUNTRY_ROUTE_NAME()],function()
    {
       Route::any('create', 'CountryController@create')->name('create');
       Route::any('store', 'CountryController@store')->name('store');
       Route::any('edit/{id}', 'CountryController@edit')->name('edit');
       Route::any('update/{id}', 'CountryController@update')->name('update');
       Route::any('destroy/{id}', 'CountryController@destroy')->name('destroy');
       Route::any('/', 'CountryController@index')->name('index');
       Route::any('any_data', 'CountryController@anyData')->name('any_data');
       Route::any('delete-all','CountryController@deleteAll')->name('delete_all');
       Route::any('status-all','CountryController@statusAll')->name('status_all');
       Route::any('single_status_change', 'CountryController@singleStatusChange')->name('single_status_change');
       
    });

     // Upcoming Match Category Routes
    Route::group(['prefix'=>UPCOMING_MATCH_PREFIX_KEYWORD(),'as'=>UPCOMING_MATCH_ROUTE_NAME()],function()
    {
       Route::any('create', 'UpcomingMatchController@create')->name('create');
       Route::any('store', 'UpcomingMatchController@store')->name('store');
       Route::any('edit/{id}', 'UpcomingMatchController@edit')->name('edit');
       Route::any('update/{id}', 'UpcomingMatchController@update')->name('update');
       Route::any('destroy/{id}', 'UpcomingMatchController@destroy')->name('destroy');
       Route::any('/', 'UpcomingMatchController@index')->name('index');
       Route::any('any_data', 'UpcomingMatchController@anyData')->name('any_data');
       Route::any('delete-all','UpcomingMatchController@deleteAll')->name('delete_all');
       Route::any('status-all','UpcomingMatchController@statusAll')->name('status_all');
       Route::any('single_status_change', 'UpcomingMatchController@singleStatusChange')->name('single_status_change');
       
    });

    // State Category Routes
    Route::group(['prefix'=>STATE_PREFIX_KEYWORD(),'as'=>STATE_ROUTE_NAME()],function()
    {
       Route::any('create', 'StateController@create')->name('create');
       Route::any('store', 'StateController@store')->name('store');
       Route::any('edit/{id}', 'StateController@edit')->name('edit');
       Route::any('update/{id}', 'StateController@update')->name('update');
       Route::any('destroy/{id}', 'StateController@destroy')->name('destroy');
       Route::any('/', 'StateController@index')->name('index');
       Route::any('any_data', 'StateController@anyData')->name('any_data');
       Route::any('delete-all','StateController@deleteAll')->name('delete_all');
       Route::any('status-all','StateController@statusAll')->name('status_all');
       Route::any('single_status_change', 'StateController@singleStatusChange')->name('single_status_change');
       
    });

    // City Category Routes
    Route::group(['prefix'=>CITY_PREFIX_KEYWORD(),'as'=>CITY_ROUTE_NAME()],function()
    {
       Route::any('create', 'CityController@create')->name('create');
       Route::any('store', 'CityController@store')->name('store');
       Route::any('edit/{id}', 'CityController@edit')->name('edit');
       Route::any('update/{id}', 'CityController@update')->name('update');
       Route::any('destroy/{id}', 'CityController@destroy')->name('destroy');
       Route::any('/', 'CityController@index')->name('index');
       Route::any('any_data', 'CityController@anyData')->name('any_data');
       Route::any('get_state_dropdown', 'CityController@getStateDropDown')->name('get_state_dropdown');
       Route::any('delete-all','CityController@deleteAll')->name('delete_all');
       Route::any('status-all','CityController@statusAll')->name('status_all');
       Route::any('single_status_change', 'CityController@singleStatusChange')->name('single_status_change');
       
    });

    // Panel Activity Routes
    Route::group(['prefix'=>PANEL_ACTIVTY_PREFIX_KEYWORD(),'as'=>PANEL_ACTIVTY_ROUTE_NAME()],function()
    {
       Route::any('create', 'PanelActivityController@create')->name('create');
       Route::any('store', 'PanelActivityController@store')->name('store');
       Route::any('edit/{id}', 'PanelActivityController@edit')->name('edit');
       Route::any('update/{id}', 'PanelActivityController@update')->name('update');
       Route::any('destroy/{id}', 'PanelActivityController@destroy')->name('destroy');
       Route::any('/', 'PanelActivityController@index')->name('index');
       Route::any('all-notifications', 'PanelActivityController@allNotifications')->name('all_notifications');
       Route::any('/see-detail/{slug}', 'PanelActivityController@seeDetail')->name('see_detail');
       Route::any('any_data', 'PanelActivityController@anyData')->name('any_data');
       Route::any('delete-all','PanelActivityController@deleteAll')->name('delete_all');
       Route::any('status-all','PanelActivityController@statusAll')->name('status_all');
       Route::any('single_status_change', 'PanelActivityController@singleStatusChange')->name('single_status_change');
       
    });

    // Admin Modules Routes
    Route::group(['prefix'=>MODULE_PREFIX_KEYWORD(),'as'=>MODULE_ROUTE_NAME()],function()
    {
       Route::any('create', 'ModuleController@create')->name('create');
       Route::any('store', 'ModuleController@store')->name('store');
       Route::any('edit/{id}', 'ModuleController@edit')->name('edit');
       Route::any('update/{id}', 'ModuleController@update')->name('update');
       Route::any('destroy/{id}', 'ModuleController@destroy')->name('destroy');
       Route::any('/', 'ModuleController@index')->name('index');
       Route::any('any_data', 'ModuleController@anyData')->name('any_data');
       Route::any('delete-all','ModuleController@deleteAll')->name('delete_all');
       Route::any('status-all','ModuleController@statusAll')->name('status_all');
       Route::any('single_status_change', 'ModuleController@singleStatusChange')->name('single_status_change');
       
    });

    // Admin Right Routes
    Route::group(['prefix'=>RIGHT_PREFIX_KEYWORD(),'as'=>RIGHT_ROUTE_NAME()],function()
    {
       Route::any('create', 'RightController@create')->name('create');
       Route::any('store', 'RightController@store')->name('store');
       Route::any('edit/{id}', 'RightController@edit')->name('edit');
       Route::any('update/{id}', 'RightController@update')->name('update');
       Route::any('destroy/{id}', 'RightController@destroy')->name('destroy');
       Route::any('/', 'RightController@index')->name('index');
       Route::any('any_data', 'RightController@anyData')->name('any_data');
       Route::any('delete-all','RightController@deleteAll')->name('delete_all');
       Route::any('status-all','RightController@statusAll')->name('status_all');
       Route::any('single_status_change', 'RightController@singleStatusChange')->name('single_status_change');
       
    });

    // // Company Routes
    // Route::group(['prefix'=>COMPANY_PREFIX_KEYWORD(),'as'=>COMPANY_ROUTE_NAME()],function()
    // {
    //    Route::any('create', 'CompanyController@create')->name('create');
    //    Route::any('store', 'CompanyController@store')->name('store');
    //    Route::any('edit/{id}', 'CompanyController@edit')->name('edit');
    //    Route::any('update/{id}', 'CompanyController@update')->name('update');
    //    Route::any('view/{id}', 'CompanyController@view')->name('view');
    //    Route::any('destroy/{id}', 'CompanyController@destroy')->name('destroy');
    //    Route::any('/', 'CompanyController@index')->name('index');
    //    Route::any('any_data', 'CompanyController@anyData')->name('any_data');
    //    Route::any('delete-all','CompanyController@deleteAll')->name('delete_all');
    //    Route::any('status-all','CompanyController@statusAll')->name('status_all');
    //    Route::any('single_status_change', 'CompanyController@singleStatusChange')->name('single_status_change');
       
    // });

    // Match Routes
    Route::group(['prefix'=>MATCH_PREFIX_KEYWORD(),'as'=>MATCH_ROUTE_NAME()],function()
    {
       Route::any('create', 'LiveMatchesController@create')->name('create');
       Route::any('store', 'LiveMatchesController@store')->name('store');
       Route::any('edit/{id}', 'LiveMatchesController@edit')->name('edit');
       Route::any('update/{id}', 'LiveMatchesController@update')->name('update');
       Route::any('view/{id}', 'LiveMatchesController@view')->name('view');
       Route::any('destroy/{id}', 'LiveMatchesController@destroy')->name('destroy');
       Route::any('/', 'LiveMatchesController@index')->name('index');
       Route::any('any_data', 'LiveMatchesController@anyData')->name('any_data');
       Route::any('delete-all','LiveMatchesController@deleteAll')->name('delete_all');
       Route::any('status-all','LiveMatchesController@statusAll')->name('status_all');
       Route::any('single_status_change', 'LiveMatchesController@singleStatusChange')->name('single_status_change');
       
    });

    // EMail Template Routes
    Route::group(['prefix'=>EMAIL_TEMPLATE_PREFIX_KEYWORD(),'as'=>EMAIL_TEMPLATE_ROUTE_NAME()],function()
    {
       Route::any('create', 'EmailTemplateController@create')->name('create');
       Route::any('store', 'EmailTemplateController@store')->name('store');
       Route::any('edit/{id}', 'EmailTemplateController@edit')->name('edit');
       Route::any('update/{id}', 'EmailTemplateController@update')->name('update');
       Route::any('destroy/{id}', 'EmailTemplateController@destroy')->name('destroy');
       Route::any('/', 'EmailTemplateController@index')->name('index');
       Route::any('any_data', 'EmailTemplateController@anyData')->name('any_data');
       Route::any('delete-all','EmailTemplateController@deleteAll')->name('delete_all');
       Route::any('status-all','EmailTemplateController@statusAll')->name('status_all');
       Route::any('email-template/preview/{id}','EmailTemplateController@preview')->name('preview');
       Route::any('single_status_change', 'EmailTemplateController@singleStatusChange')->name('single_status_change');
       
    });

    // Activity Subject Routes
    // Route::group(['prefix'=>ACTIVITY_SUBJECT_PREFIX_KEYWORD(),'as'=>ACTIVITY_SUBJECT_ROUTE_NAME()],function()
    // {
    //    Route::any('create', 'ActivitySubjectController@create')->name('create');
    //    Route::any('store', 'ActivitySubjectController@store')->name('store');
    //    Route::any('edit/{id}', 'ActivitySubjectController@edit')->name('edit');
    //    Route::any('update/{id}', 'ActivitySubjectController@update')->name('update');
    //    Route::any('destroy/{id}', 'ActivitySubjectController@destroy')->name('destroy');
    //    Route::any('/', 'ActivitySubjectController@index')->name('index');
    //    Route::any('any_data', 'ActivitySubjectController@anyData')->name('any_data');
    //    Route::any('delete-all','ActivitySubjectController@deleteAll')->name('delete_all');
    //    Route::any('status-all','ActivitySubjectController@statusAll')->name('status_all');
    //    Route::any('single_status_change', 'ActivitySubjectController@singleStatusChange')->name('single_status_change');
       
    // });

    // Activity  Routes
    // Route::group(['prefix'=>ACTIVITY_PREFIX_KEYWORD(),'as'=>ACTIVITY_ROUTE_NAME()],function()
    // {
    //    Route::any('create', 'ActivityController@create')->name('create');
    //    Route::any('store', 'ActivityController@store')->name('store');
    //    Route::any('edit/{id}', 'ActivityController@edit')->name('edit');
    //    Route::any('update/{id}', 'ActivityController@update')->name('update');
    //    Route::any('destroy/{id}', 'ActivityController@destroy')->name('destroy');
    //    Route::any('/', 'ActivityController@index')->name('index');
    //    Route::any('any_data', 'ActivityController@anyData')->name('any_data');
    //    Route::any('delete-all','ActivityController@deleteAll')->name('delete_all');
    //    Route::any('status-all','ActivityController@statusAll')->name('status_all');
    //    Route::any('single_status_change', 'ActivityController@singleStatusChange')->name('single_status_change');
       
    // });

    // Contact  Routes
    Route::group(['prefix'=>CONTACT_PREFIX_KEYWORD(),'as'=>CONTACT_ROUTE_NAME()],function()
    {
       Route::any('create', 'ContactController@create')->name('create');
       Route::any('store', 'ContactController@store')->name('store');
       Route::any('edit/{id}', 'ContactController@edit')->name('edit');
       Route::any('update/{id}', 'ContactController@update')->name('update');
       Route::any('destroy/{id}', 'ContactController@destroy')->name('destroy');
       Route::any('set_main_contact/{id}', 'ContactController@setMainContact')->name('set_main_contact');
       Route::any('/', 'ContactController@index')->name('index');
       Route::any('any_data', 'ContactController@anyData')->name('any_data');
       Route::any('delete-all','ContactController@deleteAll')->name('delete_all');
       Route::any('status-all','ContactController@statusAll')->name('status_all');
       Route::any('single_status_change', 'ContactController@singleStatusChange')->name('single_status_change');
       
    });

    // Promo Code  Routes
    Route::group(['prefix'=>PROMOCODE_PREFIX_KEYWORD(),'as'=>PROMOCODE_ROUTE_NAME()],function()
    {
       Route::any('create', 'PromoCodeController@create')->name('create');
       Route::any('store', 'PromoCodeController@store')->name('store');
       Route::any('edit/{id}', 'PromoCodeController@edit')->name('edit');
       Route::any('update/{id}', 'PromoCodeController@update')->name('update');
       Route::any('destroy/{id}', 'PromoCodeController@destroy')->name('destroy');
       Route::any('/', 'PromoCodeController@index')->name('index');
       Route::any('any_data', 'PromoCodeController@anyData')->name('any_data');
       Route::any('delete-all','PromoCodeController@deleteAll')->name('delete_all');
       Route::any('status-all','PromoCodeController@statusAll')->name('status_all');
       Route::any('single_status_change', 'PromoCodeController@singleStatusChange')->name('single_status_change');
       
    });

    // ConTEST  Routes
    Route::group(['prefix'=>CONTEST_PREFIX_KEYWORD(),'as'=>CONTEST_ROUTE_NAME()],function()
    {
       Route::any('create', 'ContestController@create')->name('create');
       Route::any('store', 'ContestController@store')->name('store');
       Route::any('edit/{id}', 'ContestController@edit')->name('edit');
       Route::any('update/{id}', 'ContestController@update')->name('update');
       Route::any('destroy/{id}', 'ContestController@destroy')->name('destroy');
       Route::any('/', 'ContestController@index')->name('index');
       Route::any('any_data', 'ContestController@anyData')->name('any_data');
       Route::any('delete-all','ContestController@deleteAll')->name('delete_all');
       Route::any('status-all','ContestController@statusAll')->name('status_all');
       Route::any('single_status_change', 'ContestController@singleStatusChange')->name('single_status_change');
       
    });

     // Front User  Routes
        Route::group(['prefix'=>FRONTUSER_PREFIX_KEYWORD(),'as'=>FRONTUSER_ROUTE_NAME()],function()
        {
           Route::any('create', 'FrontUserController@create')->name('create');
           Route::any('store', 'FrontUserController@store')->name('store');
           Route::any('add-balance/{id}', 'FrontUserController@addBalance')->name('add_balance');
           Route::any('edit/{id}', 'FrontUserController@edit')->name('edit');
           Route::any('view-beetings/{id}', 'FrontUserController@view')->name('view_bet');
           Route::any('topup-history/{id}', 'FrontUserController@topupView')->name('topup_history');
           Route::any('update/{id}', 'FrontUserController@update')->name('update');
           Route::any('balance_update/{id}', 'FrontUserController@updateBalance')->name('balance_update');
           Route::any('destroy/{id}', 'FrontUserController@destroy')->name('destroy');
           Route::any('/', 'FrontUserController@index')->name('index');
           Route::any('any_data', 'FrontUserController@anyData')->name('any_data');
           Route::any('delete-all','FrontUserController@deleteAll')->name('delete_all');
           Route::any('status-all','FrontUserController@statusAll')->name('status_all');
           Route::any('single_status_change', 'FrontUserController@singleStatusChange')->name('single_status_change');
           
        });

    // // Location  Routes
    // Route::group(['prefix'=>LOCATION_PREFIX_KEYWORD(),'as'=>LOCATION_ROUTE_NAME()],function()
    // {
    //    Route::any('create', 'LocationController@create')->name('create');
    //    Route::any('store', 'LocationController@store')->name('store');
    //    Route::any('edit/{id}', 'LocationController@edit')->name('edit');
    //    Route::any('update/{id}', 'LocationController@update')->name('update');
    //    Route::any('destroy/{id}', 'LocationController@destroy')->name('destroy');
    //    Route::any('set_main_location/{id}', 'LocationController@setMainLocation')->name('set_main_location');
    //    Route::any('/', 'LocationController@index')->name('index');
    //    Route::any('/auto_complate', 'LocationController@autoComplete')->name('auto_complete');
    //    Route::any('any_data', 'LocationController@anyData')->name('any_data');
    //    Route::any('delete-all','LocationController@deleteAll')->name('delete_all');
    //    Route::any('status-all','LocationController@statusAll')->name('status_all');
    //    Route::any('single_status_change', 'LocationController@singleStatusChange')->name('single_status_change');
       
    // });

    // Search  Routes
    Route::group(['prefix'=>SEARCH_PREFIX_KEYWORD(),'as'=>SEARCH_ROUTE_NAME()],function()
    {
       Route::any('/', 'DashboardController@search')->name('search');
       Route::any('/any_data/{model}', 'DashboardController@anyData')->name('any_data');
       
    });


    
});

