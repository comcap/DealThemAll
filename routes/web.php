<?php

Route::get('/', function() {
    return View::make('pages.home');
});

Route::get('about', function()
{
    return View::make('pages.about');
});
Route::get('live', function()
{
    return View::make('pages.live');
})->middleware('auth');;
Route::get('contact', function()
{
    return View::make('pages.contact');
});
Auth::routes();

Route::resource('/', 'HomeController');

Route::get('/register', function()
{
    return View::make('pages.register');
});

Route::resource('/player','PlayerController')->middleware('auth');
Route::resource('/profile','ProfileController')->middleware('auth');
Route::resource('/updateprofile','UpdateProfileController')->middleware('auth');
Route::resource('/Apiupdate','UpdateProfileController')->middleware('auth');
Route::post('/deleteProfile','UpdateProfileController@deleteStat')->middleware('auth');
Route::post('/selectrole','UpdateProfileController@selectrole')->middleware('auth');
Route::resource('/createteam','CreateTeamController')->middleware('auth');
Route::resource('/notifications','NotificationController')->middleware('auth');
Route::resource('/teamList','TeamListController')->middleware('auth');
Route::resource('/post','FeedController')->middleware('auth');
Route::get('/ApiSearchTeam','TeamListController@ApiSearchTeam');
Route::post('/followTeam','TeamManagerController@followTeam');

Route::resource('/team','TeamManagerController')->middleware('auth');

Route::post('/ApiSearch','PlayerController@playerSearch');
Route::resource('/ApiRegister','RegisterSignUpController');
Route::resource('/ApiLogin','LoginHomeController');
Route::get('/ApiLogout','LoginHomeController@logout');
Route::resource('/ApiCreateTeam','CreateTeamController');


Route::apiResource('/getGameList', 'API\GetGameList');
Route::apiResource('/getPlayerList.team', 'API\GetPlayer');
Route::apiResource('/getRoleGame', 'API\GetRoleGame');
Route::get('/checkRole/{arr}/{game}','API\getPlayerWithID@checkRole');

Route::apiResource('/getPlayerListRole.role', 'API\GetPlayerListRole');
Route::apiResource('/getPlayerWithID.game', 'API\getPlayerWithID');
Route::apiResource('/getPlayerMember.game', 'API\GetPlayerMember');
Route::apiResource('/updateNoti', 'API\UpdateNoti');
