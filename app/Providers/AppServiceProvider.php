<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Validator\CustomeValidator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting=GET_BASIC_SETTING();
        $panel_activity=PanelActivtyData();
        $support_data=GetSupportData();
        view()->share(['setting'=>$setting,'panel_activity'=>$panel_activity,'support_data'=>$support_data]);
        $this->app->validator->resolver(function($translator, $data, $rules, $messages) {
            return new CustomeValidator($translator, $data, $rules, $messages);
        });
    }
}
