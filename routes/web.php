<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/' ,'MatchController@home')->name('front.home');;

Route::get('/detail', function () {

    return view('matches.match_detail');
})->name('front.detail');

Route::group(['as'=>'front.'],function()
{
		
	 Route::any('/signup', 'LoginController@signup')->name('signup');
     Route::any('/login', 'LoginController@login')->name('login');
      Route::get('/cric', 'CricketApiController@listByLeague')->name('listByLeague');

 Route::any('/bet_modal_show', 'MatchController@betModal')->name('match.bet_modal');
});

Route::group(['as'=>'front.','middleware'=>'front_user'],function()
{



 Route::any('/change-password', 'LoginController@changePassword')->name('auth.change_password');
 Route::any('/personal-info', 'LoginController@personalInfo')->name('auth.personal_info');
 Route::any('/dashboard', 'LoginController@dashboard')->name('auth.dashboard');
 Route::any('/Top-Up-History', 'LoginController@topUp')->name('auth.topup_history');
 Route::any('/per-over-bet', 'LoginController@perOver')->name('auth.run_per_over');
 Route::any('/change-password-post', 'LoginController@changePasswordPost')->name('auth.change_password_post');
 Route::any('/logout', 'LoginController@logout')->name('logout');

 Route::any('/make-bet', 'MatchController@makeBet')->name('match.make_bet');
 Route::any('/upcoming-matches', 'MatchController@upcomingMatch')->name('match.upcoming_match');
 Route::any('/make-bet-run-per-over', 'MatchController@runPerOver')->name('match.run_per_over');
 Route::any('/make-bet-six-over-run', 'MatchController@sixOver')->name('match.six_over_run');
 Route::any('/match-detail/{id}', 'MatchController@detail')->name('match.detail');

});
 // Route::get('/', 'CricketApiController@listByLeague')->name('listByLeague');

