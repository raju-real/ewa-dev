<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomePageController@index')
    ->name('home');
Route::get('membership-form','HomePageController@membershipForm')
    ->name('membership-form');
Route::post('become-a-member','HomePageController@memberRegistration')
    ->name('become-a-member');

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
    // Settings
    Route::get('website-settings','SettingController@websiteSetting')
        ->name('website-settings');
    Route::put('update-website-settings','SettingController@updateWebsiteSetting')
        ->name('update-website-settings');
    Route::resource('designations','DesignationController');
    Route::resource('engineer-types','EngineerTypeController');

    Route::get('logout',function () {
        \Illuminate\Support\Facades\Auth::logout();
        \Illuminate\Support\Facades\Session::flush();
        return redirect()->route('home');
    })->name('logout');
});

