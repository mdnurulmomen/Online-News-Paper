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

    Route::get('settings/media', 'AdminController@showMediaSettingsForm')->name('admin.settings.media');
    Route::put('settings/media', 'AdminController@submitMediaSettingsForm')->name('admin.settings.media.submit');

    Route::get('settings/headlines', 'AdminController@showHeadlinesSettingForm')->name('admin.settings_headlines');
    Route::put('settings/headlines', 'AdminController@submitHeadlinesSettingForm')->name('admin.settings_headlines_submit');

    Route::get('settings/headlines/sub', 'AdminController@showSubHeadlinesSettingForm')->name('admin.settings_sub_headlines');
    Route::put('settings/headlines/sub', 'AdminController@submitSubHeadlinesSettingForm')->name('admin.settings_sub_headlines_submit');

    Route::get('settings/categories/front', 'AdminController@showFrontCategoriesForm')->name('admin.settings.index_categories');
    Route::put('settings/categories/front', 'AdminController@submitFrontCategoriesForm')->name('admin.settings.index_categories.submit');

    Route::get('settings/categories/footer', 'AdminController@showFooterCategoriesForm')->name('admin.settings.footer_categories');
    Route::put('settings/categories/footer', 'AdminController@submitFooterCategoriesForm')->name('admin.settings.footer_categories.submit');


    Route::get('create/video', 'AdminController@showCreateVideoForm')->name('admin.create.video');
    Route::put('create/video', 'AdminController@submitCreateVideoForm')->name('admin.created.video.submit');
    Route::get('video/all', 'AdminController@showAllVideos')->name('admin.view.videos');
    Route::get('video/edit/{videoId}', 'AdminController@showVideoEditForm')->name('admin.edit.video');
    Route::put('video/edit/{videoId}', 'AdminController@submitVideoEditForm')->name('admin.edited.video.submit');
    Route::delete('video/delete/{videoId}', 'AdminController@videoDeleteMethod')->name('admin.delete.video');

    Route::get('create/image', 'AdminController@showCreateImageForm')->name('admin.create.image');
    Route::put('create/image', 'AdminController@submitCreateImageForm')->name('admin.created.image.submit');
    Route::get('images/all', 'AdminController@showAllImages')->name('admin.view.images');
    Route::get('image/edit/{imageId}', 'AdminController@showImageEditForm')->name('admin.edit.image');
    Route::put('image/edit/{imageId}', 'AdminController@submitImageEditForm')->name('admin.edited.image.submit');
    Route::delete('image/delete/{imageId}', 'AdminController@imageDeleteMethod')->name('admin.delete.image');

    Route::get('create/category', 'AdminController@showCreateCategoryForm')->name('admin.create.category');
    Route::put('create/category', 'AdminController@submitCreateCategoryForm')->name('admin.created.category.submit');
    Route::get('categories/all', 'AdminController@showAllCategories')->name('admin.view.categories');
    Route::get('category/{categoryId}/edit', 'AdminController@showCategoryEditForm')->name('admin.edit.category');
    Route::put('category/{categoryId}/edit', 'AdminController@submitCategoryEditForm')->name('admin.edited.category.submit');
    Route::delete('category/delete/{categoryId}', 'AdminController@categoryDeleteMethod')->name('admin.delete.category');

    Route::get('create/editor', 'AdminController@showCreateEditorForm')->name('admin.create.editor');
    Route::put('create/editor', 'AdminController@submitCreateEditorForm')->name('admin.created.editor.submit');
    Route::get('editors/all', 'AdminController@showAllEditors')->name('admin.view.editors');
    Route::get('editor/{editorId}/edit', 'AdminController@showEditorEditForm')->name('admin.edit.editor');
    Route::put('editor/{editorId}/edit', 'AdminController@submitEditorEditForm')->name('admin.edited.editor.submit');
    Route::delete('editor/delete/{editorId}', 'AdminController@editorDeleteMethod')->name('admin.delete.editor');

    Route::get('create/reporter', 'AdminController@showCreateReporterForm')->name('admin.create.reporter');
    Route::put('create/reporter', 'AdminController@submitCreateReporterForm')->name('admin.created.reporter.submit');
    Route::get('reporters/all', 'AdminController@showAllReporters')->name('admin.view.reporters');
    Route::get('reporter/{reporterId}/edit', 'AdminController@showReporterEditForm')->name('admin.edit.reporter');
    Route::put('reporter/{reporterId}/edit', 'AdminController@submitReporterEditForm')->name('admin.edited.reporter.submit');
    Route::delete('reporter/delete/{reporterId}', 'AdminController@reporterDeleteMethod')->name('admin.delete.reporter');

    Route::get('create/news', 'AdminController@showCreateNewsForm')->name('admin.create.news');
    Route::put('create/news', 'AdminController@submitCreateNewsForm')->name('admin.created.news.submit');
    Route::get('news/all', 'AdminController@showAllNews')->name('admin.view.news');
    Route::get('news/edit/{newsId}', 'AdminController@showNewsEditForm')->name('admin.edit.news');
    Route::put('news/edit/{newsId}', 'AdminController@submitNewsEditForm')->name('admin.edited.news.submit');
    Route::delete('news/delete/{newsId}', 'AdminController@newsDeleteMethod')->name('admin.delete.news');

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

    Route::get('news/all', 'EditorController@showAllNews')->name('editor.view.news');
    Route::get('news/edit/{newsId}', 'EditorController@showNewsEditForm')->name('editor.edit.news');
    Route::put('news/edit/{newsId}', 'EditorController@submitNewsEditForm')->name('editor.edited.news.submit');
    // Route::delete('news/delete/{newsId}', 'EditorController@newsDeleteMethod')->name('editor.delete.news');

    Route::get('images/all', 'EditorController@showAllImages')->name('editor.view.images');
    Route::get('image/edit/{imageId}', 'EditorController@showImageEditForm')->name('editor.edit.image');
    Route::put('image/edit/{imageId}', 'EditorController@submitImageEditForm')->name('editor.edited.image.submit');

    Route::get('video/all', 'EditorController@showAllVideos')->name('editor.view.videos');
    Route::get('video/edit/{videoId}', 'EditorController@showVideoEditForm')->name('editor.edit.video');
    Route::put('video/edit/{videoId}', 'EditorController@submitVideoEditForm')->name('editor.edited.video.submit');

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

    Route::get('create/news', 'ReporterController@showCreateNewsForm')->name('reporter.create.news');
    Route::put('create/news', 'ReporterController@submitCreateNewsForm')->name('reporter.created.news.submit');
    Route::get('view/news', 'ReporterController@showAllNews')->name('reporter.view.news');
    Route::get('edit/news/{newsId}', 'ReporterController@showNewsEditForm')->name('reporter.edit.news');
    Route::put('edit/news/{newsId}', 'ReporterController@submitNewsEditForm')->name('reporter.edited.news.submit');


    Route::get('create/image', 'ReporterController@showCreateImageForm')->name('reporter.create.image');
    Route::get('images/all', 'ReporterController@showAllImages')->name('reporter.view.images');
    Route::get('image/edit/{imageId}', 'ReporterController@showImageEditForm')->name('reporter.edit.image');
    Route::put('image/edit/{imageId}', 'ReporterController@submitImageEditForm')->name('reporter.edited.image.submit');

    Route::get('create/video', 'ReporterController@showCreateVideoForm')->name('reporter.create.video');
    Route::get('video/all', 'ReporterController@showAllVideos')->name('reporter.view.videos');
    Route::get('video/edit/{videoId}', 'ReporterController@showVideoEditForm')->name('reporter.edit.video');
    Route::put('video/edit/{videoId}', 'ReporterController@submitVideoEditForm')->name('reporter.edited.video.submit');



    Route::get('logout', 'ReporterController@logout')->name('reporter.logout');
});


    Route::get('/', 'FrontController@showIndexMethod')->name('front.index');
    Route::get('news/{newsId}', 'FrontController@showSpecificNews')->name('user.specific.category');
    Route::get('category/{categoryUrl}', 'FrontController@showCategoryNews')->name('user.specific.category');
    Route::get('image/{imageId}', 'FrontController@showSpecificImage')->name('user.specific.image');
    Route::get('video/{videoId}', 'FrontController@showSpecificVideo')->name('user.specific.video');

    Route::get('user', 'UserController@showLoginForm')->name('user.login');
    Route::post('user', 'UserController@login')->name('user.login.submit');

    Route::get('user/registration', 'UserController@showRegistrationForm')->name('user.register');
    Route::post('user/registration', 'UserController@register')->name('user.register.submit');

    Route::post('user/comment', 'UserController@submitCommentForm')->name('user.comment.submit');

    Route::get('user/logout', 'UserController@logout')->name('user.logout');
