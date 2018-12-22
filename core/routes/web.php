<?php

Route::group(['prefix'=>'admin', 'middleware'=>'guest:admin'], function (){
    Route::get('/', 'AdminController@showLoginForm')->name('admin.login');
    Route::post('/', 'AdminController@login')->name('admin.login.submit');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth:admin'], function (){
    Route::get('home', 'AdminController@homeMethod')->name('admin.home');

    Route::get('profile', 'AdminController@showProfileForm')->name('admin.update.profile');
    Route::put('profile', 'AdminController@submitProfileForm')->name('admin.updated.profile.submit');
    Route::get('password', 'AdminController@showPasswordForm')->name('admin.update.password');
    Route::post('password', 'AdminController@submitPasswordForm')->name('admin.updated.password.submit');

    Route::get('settings/general', 'AdminController@showGeneralSettingsForm')->name('admin.settings.general');
    Route::put('settings/general', 'AdminController@submitGeneralSettingsForm')->name('admin.settings.general.submit');

    Route::get('category/create', 'AdminController@showCreateCategoryForm')->name('admin.create.category');
    Route::put('category/create', 'AdminController@submitCreateCategoryForm')->name('admin.created.category.submit');
    Route::get('editor/create', 'AdminController@showCreateEditorForm')->name('admin.create.editor');
    Route::put('editor/create', 'AdminController@submitCreateEditorForm')->name('admin.created.editor.submit');
    Route::get('reporter/create', 'AdminController@showCreateReporterForm')->name('admin.create.reporter');
    Route::put('reporter/create', 'AdminController@submitCreateReporterForm')->name('admin.created.reporter.submit');

    Route::get('post/all', 'AdminController@showAllPosts')->name('admin.view.post');
    Route::get('post/{postid}/edit', 'AdminController@showPostEditForm')->name('admin.edit.post');
    Route::put('post/{postid}/edit', 'AdminController@submitPostEditForm')->name('admin.edited.post.submit');
    Route::get('post/{postid}/delete', 'AdminController@postDeleteMethod')->name('admin.delete.post');


    Route::get('employee/all', 'AdminController@showAllEmployees')->name('admin.view.employees');
    Route::get('employee/{employeeid}/edit/{employeetype}', 'AdminController@showEmployeeEditForm')->name('admin.edit.employee');
    Route::put('employee/{employeeid}/edit/{employeetype}', 'AdminController@submitEmployeeEditForm')->name('admin.edited.employee.submit');
    Route::get('employee/{employeeid}/delete/{employeetype}', 'AdminController@employeeDeleteMethod')->name('admin.delete.employee');

    Route::get('logout', 'AdminController@logout')->name('admin.logout');
});

Route::group(['prefix'=>'editor', 'middleware'=>'guest:editor'], function (){
    Route::get('/', 'EditorController@showLoginForm')->name('editor.login');
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