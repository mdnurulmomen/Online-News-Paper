<?php

Route::group(['prefix'=>'admin', 'middleware'=>'guest:admin'], function (){
    Route::get('/', 'AdminController@showLoginForm')->name('admin.loginForm');
    Route::post('/', 'AdminController@login')->name('admin.loginFormSubmit');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth:admin'], function (){
    Route::get('/home', 'AdminController@homeMethod')->name('admin.home');

    Route::get('/profile', 'AdminController@showProfileForm')->name('admin.profileUpdateForm');
    Route::put('/profile', 'AdminController@submitProfileForm')->name('admin.updatedProfileSubmit');
    Route::get('/password', 'AdminController@showPasswordForm')->name('admin.passwordUpdateForm');
    Route::post('/password', 'AdminController@submitPasswordForm')->name('admin.updatedPasswordSubmit');

    Route::get('/category', 'AdminController@showCreateCategoryForm')->name('admin.createCategory');
    Route::put('/category', 'AdminController@submitCreateCategoryForm')->name('admin.createdCategorySubmit');
    Route::get('/editor', 'AdminController@showCreateEditorForm')->name('admin.createEditor');
    Route::put('/editor', 'AdminController@submitCreateEditorForm')->name('admin.createdEditorSubmit');
    Route::get('/reporter', 'AdminController@showCreateReporterForm')->name('admin.createReporter');
    Route::put('/reporter', 'AdminController@submitCreateReporterForm')->name('admin.createdReporterSubmit');

    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
});