<?php
Route::group(['prefix'=>'admin', 'middleware'=>'guest:admin'], function (){
    Route::get('/', 'AdminController@showLoginForm')->name('admin.login');
    Route::post('/', 'AdminController@login')->name('admin.login_submit');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth:admin'], function (){
    Route::get('home', 'AdminController@homeMethod')->name('admin.home');

    Route::get('profile', 'AdminController@showProfileForm')->name('admin.update_profile');
    Route::put('profile', 'AdminController@submitProfileForm')->name('admin.updated_profile_submit');
    Route::get('password', 'AdminController@showPasswordForm')->name('admin.update_password');
    Route::post('password', 'AdminController@submitPasswordForm')->name('admin.updated_password_submit');

    Route::get('settings/general', 'AdminController@showGeneralSettingsForm')->name('admin.settings_general');
    Route::put('settings/general', 'AdminController@submitGeneralSettingsForm')->name('admin.settings_general_submit');

    Route::get('settings/media', 'AdminController@showMediaSettingsForm')->name('admin.settings_media');
    Route::put('settings/media', 'AdminController@submitMediaSettingsForm')->name('admin.settings_media_submit');

    Route::get('settings/headlines', 'AdminController@showHeadlinesSettingForm')->name('admin.settings_headlines');
    Route::put('settings/headlines', 'AdminController@submitHeadlinesSettingForm')->name('admin.settings_headlines_submit');

    Route::get('settings/headlines/sub', 'AdminController@showSubHeadlinesSettingForm')->name('admin.settings_sub_headlines');
    Route::put('settings/headlines/sub', 'AdminController@submitSubHeadlinesSettingForm')->name('admin.settings_sub_headlines_submit');

    Route::get('settings/categories/menu', 'AdminController@showMenuCategoriesForm')->name('admin.settings_menu_categories');
    Route::put('settings/categories/menu', 'AdminController@submitMenuCategoriesForm')->name('admin.settings_menu_categories_submit');

    Route::get('settings/categories/front', 'AdminController@showFrontCategoriesForm')->name('admin.settings_index_categories');
    Route::put('settings/categories/front', 'AdminController@submitFrontCategoriesForm')->name('admin.settings_index_categories_submit');


    Route::get('settings/categories/footer', 'AdminController@showFooterCategoriesForm')->name('admin.settings_footer_categories');
    Route::put('settings/categories/footer', 'AdminController@submitFooterCategoriesForm')->name('admin.settings_footer_categories_submit');


    Route::get('create/video', 'AdminController@showCreateVideoForm')->name('admin.create_video');
    Route::put('create/video', 'AdminController@submitCreateVideoForm')->name('admin.created_video_submit');
    Route::get('video/all', 'AdminController@showAllVideos')->name('admin.view_videos');
    Route::get('video/edit/{videoId}', 'AdminController@showVideoEditForm')->name('admin.edit_video');
    Route::put('video/edit/{videoId}', 'AdminController@submitVideoEditForm')->name('admin.edited_video_submit');
    Route::delete('video/delete/{videoId}', 'AdminController@videoDeleteMethod')->name('admin.delete_video');

    Route::get('create/image', 'AdminController@showCreateImageForm')->name('admin.create_image');
    Route::put('create/image', 'AdminController@submitCreateImageForm')->name('admin.created_image_submit');
    Route::get('images/all', 'AdminController@showAllImages')->name('admin.view_images');
    Route::get('image/edit/{imageId}', 'AdminController@showImageEditForm')->name('admin.edit_image');
    Route::put('image/edit/{imageId}', 'AdminController@submitImageEditForm')->name('admin.edited_image_submit');
    Route::delete('image/delete/{imageId}', 'AdminController@imageDeleteMethod')->name('admin.delete_image');

    Route::get('create/category', 'AdminController@showCreateCategoryForm')->name('admin.create_category');
    Route::put('create/category', 'AdminController@submitCreateCategoryForm')->name('admin.created_category_submit');
    Route::get('categories/all', 'AdminController@showAllCategories')->name('admin.view_categories');
    Route::get('category/{categoryId}/edit', 'AdminController@showCategoryEditForm')->name('admin.edit_category');
    Route::put('category/{categoryId}/edit', 'AdminController@submitCategoryEditForm')->name('admin.edited_category_submit');
    Route::delete('category/delete/{categoryId}', 'AdminController@categoryDeleteMethod')->name('admin.delete_category');

    Route::get('create/editor', 'AdminController@showCreateEditorForm')->name('admin.create_editor');
    Route::put('create/editor', 'AdminController@submitCreateEditorForm')->name('admin.created_editor_submit');
    Route::get('editors/all', 'AdminController@showAllEditors')->name('admin.view_editors');
    Route::get('editor/{editorId}/edit', 'AdminController@showEditorEditForm')->name('admin.edit_editor');
    Route::put('editor/{editorId}/edit', 'AdminController@submitEditorEditForm')->name('admin.edited_editor_submit');
    Route::delete('editor/delete/{editorId}', 'AdminController@editorDeleteMethod')->name('admin.delete_editor');

    Route::get('create/reporter', 'AdminController@showCreateReporterForm')->name('admin.create_reporter');
    Route::put('create/reporter', 'AdminController@submitCreateReporterForm')->name('admin.created_reporter_submit');
    Route::get('reporters/all', 'AdminController@showAllReporters')->name('admin.view_reporters');
    Route::get('reporter/{reporterId}/edit', 'AdminController@showReporterEditForm')->name('admin.edit_reporter');
    Route::put('reporter/{reporterId}/edit', 'AdminController@submitReporterEditForm')->name('admin.edited_reporter_submit');
    Route::delete('reporter/delete/{reporterId}', 'AdminController@reporterDeleteMethod')->name('admin.delete_reporter');

    Route::get('create/news', 'AdminController@showCreateNewsForm')->name('admin.create_news');
    Route::put('create/news', 'AdminController@submitCreateNewsForm')->name('admin.created_news_submit');
    Route::get('news/all', 'AdminController@showAllNews')->name('admin.view_news');
    Route::get('news/edit/{newsId}', 'AdminController@showNewsEditForm')->name('admin.edit_news');
    Route::put('news/edit/{newsId}', 'AdminController@submitNewsEditForm')->name('admin.edited_news_submit');
    Route::delete('news/delete/{newsId}', 'AdminController@newsDeleteMethod')->name('admin.delete_news');

    Route::get('logout', 'AdminController@logout')->name('admin.logout');
});

Route::group(['prefix'=>'editor', 'middleware'=>'guest:editor'], function (){
    Route::get('/', 'EditorController@showLoginForm')->name('editor.login');
    Route::post('/', 'EditorController@login')->name('editor.login_submit');
});

Route::group(['prefix'=>'editor', 'middleware'=>'auth:editor'], function(){
    Route::get('home', 'EditorController@homeMethod')->name('editor.home');

    Route::get('update/profile', 'EditorController@showProfileForm')->name('editor.update_profile');
    Route::put('update/profile', 'EditorController@submitProfileForm')->name('editor.updated_profile_submit');
    Route::get('update/password', 'EditorController@showPasswordForm')->name('editor.update_password');
    Route::post('update/password', 'EditorController@submitPasswordForm')->name('editor.updated_password_submit');

    Route::get('news/all', 'EditorController@showAllNews')->name('editor.view_news');
    Route::get('news/edit/{newsId}', 'EditorController@showNewsEditForm')->name('editor.edit_news');
    Route::put('news/edit/{newsId}', 'EditorController@submitNewsEditForm')->name('editor.edited_news_submit');
    // Route::delete('news/delete/{newsId}', 'EditorController@newsDeleteMethod')->name('editor.delete.news');

    Route::get('images/all', 'EditorController@showAllImages')->name('editor.view_images');
    Route::get('image/edit/{imageId}', 'EditorController@showImageEditForm')->name('editor.edit_image');
    Route::put('image/edit/{imageId}', 'EditorController@submitImageEditForm')->name('editor.edited_image_submit');

    Route::get('video/all', 'EditorController@showAllVideos')->name('editor.view_videos');
    Route::get('video/edit/{videoId}', 'EditorController@showVideoEditForm')->name('editor.edit_video');
    Route::put('video/edit/{videoId}', 'EditorController@submitVideoEditForm')->name('editor.edited_video_submit');

    Route::get('logout', 'EditorController@logout')->name('editor.logout');
});

Route::group(['prefix'=>'reporter', 'middleware'=>'guest:reporter'], function (){
    Route::get('/', 'ReporterController@showLoginForm')->name('reporter.login');
    Route::post('/', 'ReporterController@login')->name('reporter.login_submit');
});

Route::group(['prefix'=>'reporter', 'middleware'=>'auth:reporter'], function(){
    Route::get('home', 'ReporterController@homeMethod')->name('reporter.home');
    Route::get('update/profile', 'ReporterController@showProfileForm')->name('reporter.update_profile');
    Route::put('update/profile', 'ReporterController@submitProfileForm')->name('reporter.updated_profile_submit');
    Route::get('update/password', 'ReporterController@showPasswordForm')->name('reporter.update_password');
    Route::post('update/password', 'ReporterController@submitPasswordForm')->name('reporter.updated_password_submit');

    Route::get('create/news', 'ReporterController@showCreateNewsForm')->name('reporter.create_news');
    Route::put('create/news', 'ReporterController@submitCreateNewsForm')->name('reporter.created_news_submit');
    Route::get('view/news', 'ReporterController@showAllNews')->name('reporter.view_news');
    Route::get('edit/news/{newsId}', 'ReporterController@showNewsEditForm')->name('reporter.edit_news');
    Route::put('edit/news/{newsId}', 'ReporterController@submitNewsEditForm')->name('reporter.edited_news_submit');


    Route::get('create/image', 'ReporterController@showCreateImageForm')->name('reporter.create_image');
    Route::put('create/image', 'ReporterController@submitCreateImageForm')->name('reporter.created_image_submit');
    Route::get('images/all', 'ReporterController@showAllImages')->name('reporter.view_images');
    Route::get('image/edit/{imageId}', 'ReporterController@showImageEditForm')->name('reporter.edit_image');
    Route::put('image/edit/{imageId}', 'ReporterController@submitImageEditForm')->name('reporter.edited_image_submit');

    Route::get('create/video', 'ReporterController@showCreateVideoForm')->name('reporter.create_video');
    Route::put('create/video', 'ReporterController@submitCreateVideoForm')->name('reporter.created_video_submit');
    Route::get('video/all', 'ReporterController@showAllVideos')->name('reporter.view_videos');
    Route::get('video/edit/{videoId}', 'ReporterController@showVideoEditForm')->name('reporter.edit_video');
    Route::put('video/edit/{videoId}', 'ReporterController@submitVideoEditForm')->name('reporter.edited_video_submit');



    Route::get('logout', 'ReporterController@logout')->name('reporter.logout');
});


    Route::get('/', 'FrontController@showIndexMethod')->name('front.index');
    Route::get('news/{newsId}', 'FrontController@showSpecificNews')->name('user.specific_category');
    Route::get('category/{categoryUrl}', 'FrontController@showCategoryNews')->name('user.specific_category');
    Route::get('image/{imageId}', 'FrontController@showSpecificImage')->name('user.specific_image');
    Route::get('video/{videoId}', 'FrontController@showSpecificVideo')->name('user.specific_video');

    Route::get('user', 'UserController@showLoginForm')->name('user.login');
    Route::post('user', 'UserController@login')->name('user.login_submit');

    Route::get('user/registration', 'UserController@showRegistrationForm')->name('user.register');
    Route::post('user/registration', 'UserController@register')->name('user.register_submit');

    Route::post('user/comment', 'UserController@submitCommentForm')->name('user.comment_submit');

    Route::get('user/logout', 'UserController@logout')->name('user.logout');
