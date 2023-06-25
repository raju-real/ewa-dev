<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomePageController@index')
    ->name('home');
Route::get('membership-form','HomePageController@membershipForm')
    ->name('membership-form');
Route::post('become-a-member','HomePageController@memberRegistration')
    ->name('become-a-member');
Route::post('send-guest-message','HomePageController@sendGuestMessage')
    ->name('send-guest-message');


// Auth activity route
Route::get('login','HomePageController@loginPage')
    ->name('login');
Route::post('user-login','HomePageController@userLogin')
    ->name('user-login');
Route::group(['middleware' => ['auth','has_approval'] ] ,function() {
    Route::get('dashboard', 'DashboardController@dashboard')
        ->name('dashboard');
    // Profile
    Route::get('profile', 'ProfileController@profile')
        ->name('profile');
    Route::get('edit-profile','ProfileController@editProfileForm')
        ->name('edit-profile');
    Route::put('update-profile','ProfileController@updateProfileForm')
        ->name('update-profile');
    Route::get('member-requests','MemberController@memberRequests')
        ->name('member-requests');
    Route::get('approve-request/{id}','MemberController@approveRequest')
        ->name('approve-request');
    Route::resource('members','MemberController');
    // Post
    Route::post('submit-post','ProfileController@submitPost')
        ->name('submit-post');
    Route::get('load-post','ProfileController@loadPost')
        ->name('load-post');
    // Settings
    Route::get('website-settings','SettingController@websiteSetting')
        ->name('website-settings');
    Route::put('update-website-settings','SettingController@updateWebsiteSetting')
        ->name('update-website-settings');
    Route::resource('events','EventController');
    Route::resource('designations','DesignationController');
    Route::resource('engineer-types','EngineerTypeController');

    Route::get('logout',function () {
        \Illuminate\Support\Facades\Auth::logout();
        \Illuminate\Support\Facades\Session::flush();
        return redirect()->route('home');
    })->name('logout');
});

Route::get('insert-fake-user',function () {
   for ($count = 0;$count <= 10;$count ++) {
       $user = new \App\Models\User();
       $user->member_id = \App\Models\User::getMemberId();
       $user->name = 'user'.$count;
       $user->email = 'user'.$count.'@mail.com';
       $user->mobile = '02589958'.$count;
       $user->approve_status = 'yes';
       $user->password = \Illuminate\Support\Facades\Hash::make('123456');
       $user->save();
   }
});

