<?php

Route::group(['prefix'=>'admin', 'middleware'=>'guest:admin'], function (){
    Route::get('/', 'AdminController@showLoginForm')->name('admin.loginForm');
    Route::post('/', 'AdminController@login')->name('admin.loginFormSubmit');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth:admin'], function (){
    Route::get('home', 'AdminController@homeMethod')->name('admin.home');

    Route::get('profile', 'AdminController@showProfileForm')->name('admin.profileUpdateForm');
    Route::put('profile', 'AdminController@submitProfileForm')->name('admin.updatedProfileSubmit');
    Route::get('/password', 'AdminController@showPasswordForm')->name('admin.passwordUpdateForm');
    Route::post('/password', 'AdminController@submitPasswordForm')->name('admin.updatedPasswordSubmit');

    Route::get('category', 'AdminController@showCreateCategoryForm')->name('admin.createCategory');
    Route::put('category', 'AdminController@submitCreateCategoryForm')->name('admin.createdCategorySubmit');
    Route::get('editor', 'AdminController@showCreateEditorForm')->name('admin.createEditor');
    Route::put('editor', 'AdminController@submitCreateEditorForm')->name('admin.createdEditorSubmit');
    Route::get('reporter', 'AdminController@showCreateReporterForm')->name('admin.createReporter');
    Route::put('reporter', 'AdminController@submitCreateReporterForm')->name('admin.createdReporterSubmit');


    Route::get('general', 'AdminController@showGeneralSettingsForm')->name('admin.settingsGeneralForm');
    Route::put('general', 'AdminController@submitGeneralSettingsForm')->name('admin.settingsGeneralSubmit');

    Route::get('logout', 'AdminController@logout')->name('admin.logout');
});

Route::group(['prefix'=>'editor', 'middleware'=>'guest:editor'], function (){
    Route::get('/', 'EditorController@showLoginForm')->name('editor.loginForm');
    Route::post('/', 'EditorController@login')->name('editor.loginFormSubmit');
});

Route::group(['prefix'=>'editor', 'middleware'=>'auth:editor'], function(){
   Route::get('home', 'EditorController@homeMethod')->name('editor.home');

   Route::get('profile', 'EditorController@showProfileForm')->name('editor.profileUpdateForm');
   Route::put('profile', 'EditorController@submitProfileForm')->name('editor.updatedProfileSubmit');
   Route::get('password', 'EditorController@showPasswordForm')->name('editor.passwordUpdateForm');
   Route::post('password', 'EditorController@submitPasswordForm')->name('editor.updatedPasswordSubmit');

   Route::get('logout', 'EditorController@logout')->name('editor.logout');
});

Route::group(['prefix'=>'reporter', 'middleware'=>'guest:reporter'], function (){
    Route::get('/', 'ReporterController@showLoginForm')->name('reporter.loginForm');
    Route::post('/', 'ReporterController@login')->name('reporter.loginFormSubmit');
});

Route::group(['prefix'=>'reporter', 'middleware'=>'auth:reporter'], function(){
   Route::get('home', 'ReporterController@homeMethod')->name('reporter.home');

   Route::get('profile', 'ReporterController@showProfileForm')->name('reporter.profileUpdateForm');
   Route::put('profile', 'ReporterController@submitProfileForm')->name('reporter.updatedProfileSubmit');
   Route::get('password', 'ReporterController@showPasswordForm')->name('reporter.passwordUpdateForm');
   Route::post('password', 'ReporterController@submitPasswordForm')->name('reporter.updatedPasswordSubmit');

   Route::get('logout', 'ReporterController@logout')->name('reporter.logout');
});