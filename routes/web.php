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
Route::get('/','PageController@landingPage')->name('index');
Route::post('submit_pin','LoadController@submitPin')->name('submit_pin');
Route::get('vote/{pin}','PageController@votePage')->name('vote_page');
Route::post('submit_vote','LoadController@submitVote')->name('submit_vote');

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
    Route::get('/','PageController@loginPage')->name('admin_login');
    Route::post('login','LoadController@authenticate')->name('login_action');

    Route::group(['middleware' => 'Admin'], function () {
        Route::get('logout','LoadController@logout')->name('logout');
        Route::get('home','PageController@homePage')->name('admin_home');

        Route::get('campaign_page','PageController@createCampaign')->name('create_campaign_page');
        Route::post('campaign_action','LoadController@createCampaign')->name('create_campaign_action');

        Route::get('position_page','PageController@registerPosition')->name('register_position_page');
        Route::post('position_action','LoadController@registerPosition')->name('register_position_action');

        Route::get('contestant_page','PageController@registerContestant')->name('register_contestant_page');
        Route::post('contestant_page','LoadController@registerContestant')->name('register_contestant_action');

        Route::get('generate_pins/{campaign}/','PageController@generatePinsPage')->name('generate_pin');
        Route::post('generate_pin','LoadController@generatePins')->name('generate_pins_action');

        Route::get('change_status/{campaign}/{status}','LoadController@changeStatus')->name('change_status');
        Route::get('view_pins/{campaign}','PageController@showPins')->name('show_pins');

        Route::get('results/{campaign_id}','LoadController@showResults')->name('show_results');
        Route::get('active_campaign','PageController@activeCampaign');
        Route::get('vote/{campaign}','PageController@VotingPage')->name('addy');
        Route::post('vote','LoadController@vote')->name('addy_action');

    });

});
