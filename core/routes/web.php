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







Route::get('categories/all', 'AdminController@showAllCategories')->name('admin.view.categories');
Route::get('category/{categoryId}/edit', 'AdminController@showCategoryEditForm')->name('admin.edit.category');
Route::put('category/{categoryId}/edit', 'AdminController@submitCategoryEditForm')->name('admin.edited.category.submit');
Route::get('category/delete/{categoryId}', 'AdminController@categoryDeleteMethod')->name('admin.delete.category');


Route::get('editors/all', 'AdminController@showAllEditors')->name('admin.view.editors');
Route::get('editor/{editorId}/edit', 'AdminController@showEditorEditForm')->name('admin.edit.editor');
Route::put('editor/{editorId}/edit', 'AdminController@submitEditorEditForm')->name('admin.edited.editor.submit');
Route::get('editor/delete/{editorId}', 'AdminController@editorDeleteMethod')->name('admin.delete.editor');

Route::get('reporters/all', 'AdminController@showAllReporters')->name('admin.view.reporters');
Route::get('reporter/{reporterId}/edit', 'AdminController@showReporterEditForm')->name('admin.edit.reporter');
Route::put('reporter/{reporterId}/edit', 'AdminController@submitReporterEditForm')->name('admin.edited.reporter.submit');
Route::get('reporter/delete/{reporterId}', 'AdminController@reporterDeleteMethod')->name('admin.delete.reporter');

Route::get('post/all', 'AdminController@showAllPosts')->name('admin.view.post');
Route::get('post/{postid}/edit', 'AdminController@showPostEditForm')->name('admin.edit.post');
Route::put('post/{postid}/edit', 'AdminController@submitPostEditForm')->name('admin.edited.post.submit');
Route::get('post/{postid}/delete', 'AdminController@postDeleteMethod')->name('admin.delete.post');

Route::get('logout', 'AdminController@logout')->name('admin.logout');
});

Route::group(['prefix'=>'editor', 'middleware'=>'guest:editor'], function (){
Route::get('/', 'EditorController@showLoginForm')->name('editor.login');
Route::post('/', 'EditorController@login')->name('editor.login.submit');
});

Route::group(['prefix'=>'editor', 'middleware'=>'auth:editor'], function(){
Route::get('home', 'EditorController@homeMethod')->name('editor.home');

Route::get('update/profile', 'EditorController@showProfileForm')->name('editor.update.profile');
Route::put('update/profile', 'EditorController@submitProfileForm')->name('editor.updated.profile.submit');
Route::get('update/password', 'EditorController@showPasswordForm')->name('editor.update.password');
Route::post('update/password', 'EditorController@submitPasswordForm')->name('editor.updated.password.submit');

Route::get('post/all', 'EditorController@showAllPosts')->name('editor.view.post');
Route::get('post/{postid}/edit', 'EditorController@showPostEditForm')->name('editor.edit.post');
Route::put('post/{postid}/edit', 'EditorController@submitPostEditForm')->name('editor.edited.post.submit');
Route::get('post/{postid}/delete', 'EditorController@postDeleteMethod')->name('editor.delete.post');

Route::get('logout', 'EditorController@logout')->name('editor.logout');
});

Route::group(['prefix'=>'reporter', 'middleware'=>'guest:reporter'], function (){
Route::get('/', 'ReporterController@showLoginForm')->name('reporter.login');
Route::post('/', 'ReporterController@login')->name('reporter.login.submit');
});

Route::group(['prefix'=>'reporter', 'middleware'=>'auth:reporter'], function(){
Route::get('home', 'ReporterController@homeMethod')->name('reporter.home');

Route::get('update/profile', 'ReporterController@showProfileForm')->name('reporter.update.profile');
Route::put('update/profile', 'ReporterController@submitProfileForm')->name('reporter.updated.profile.submit');
Route::get('update/password', 'ReporterController@showPasswordForm')->name('reporter.update.password');
Route::post('update/password', 'ReporterController@submitPasswordForm')->name('reporter.updated.password.submit');

Route::get('create/post', 'ReporterController@showCreatePostForm')->name('reporter.create.post');
Route::put('create/post', 'ReporterController@submitCreatePostForm')->name('reporter.created.post.submit');

Route::get('view/posts', 'ReporterController@showAllPost')->name('reporter.view.posts');
Route::get('edit/{postid}/post', 'ReporterController@showPostEditForm')->name('reporter.edit.post');
Route::put('edit/{postid}/post', 'ReporterController@submitPostEditForm')->name('reporter.edited.post.submit');

Route::get('logout', 'ReporterController@logout')->name('reporter.logout');
});