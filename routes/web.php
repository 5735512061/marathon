<?php

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::get('locale/{locale}',function($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});


// ลงทะเบียนแอดมิน
Route::get('/register','Auth\RegisterController@ShowRegisterForm');
Route::post('/register','Auth\RegisterController@register');

Route::group(['prefix' => ''], function(){
    Route::get('/','Frontend\\FrontendsController@index');
    Route::get('/news','Frontend\\FrontendsController@news');
    Route::get('/news-information/{id}','Frontend\\FrontendsController@newsInformation');
    Route::get('/gallery','Frontend\\FrontendsController@gallery');
    Route::get('/gallery-information/{id}','Frontend\\FrontendsController@galleryInformation');
    Route::get('/about-us','Frontend\\FrontendsController@aboutUs');
    Route::get('/contact-us','Frontend\\FrontendsController@contactUs');
});

// admin
Route::group(['prefix' => 'admin'], function(){
    // เข้าสู่ระบบแอดมิน
    Route::get('/login','Auth\LoginController@ShowLoginForm')->name('admin.login');
    Route::post('/login','Auth\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::get('/change-password', 'Backend\ChangePasswordController@changePasswordIndex')->name('password.change');
    Route::post('/change-password', 'Backend\ChangePasswordController@changePassword')->name('password.update');
    Route::get('/change-profile/{id}', 'Backend\AdminsController@changeProfileIndex');
    Route::post('/change-profile', 'Backend\AdminsController@changeProfile');

    Route::get('/news', 'Backend\AdminsController@news')->name('admin.home');
    Route::get('/create-news', 'Backend\AdminsController@createNews');
    Route::post('/create-news', 'Backend\AdminsController@createNewsPost');
    Route::get('/news-delete/{id}','Backend\\AdminsController@newsDelete');
    Route::get('/news-image-multi-information/{id}','Backend\\AdminsController@newsImageMultiInfor');
    Route::post('/update-news','Backend\\AdminsController@updateNews');
    Route::post('/update-news-image-multi','Backend\\AdminsController@updateNewsImageMulti');
    Route::get('/edit-news/{id}','Backend\\AdminsController@editNews');
    Route::post('/edit-news','Backend\\AdminsController@updateNewsPost');
    Route::post('/upload-news-image-multi','Backend\\AdminsController@uploadNewsImageMulti');
    Route::get('/news-image-multi-delete/{id}','Backend\\AdminsController@newsImageMultiDelete');

    Route::get('/gallery', 'Backend\AdminsController@gallery');
    Route::get('/create-gallery', 'Backend\AdminsController@createGallery');
    Route::post('/create-gallery', 'Backend\AdminsController@createGalleryPost');
    Route::get('/gallery-delete/{id}','Backend\\AdminsController@galleryDelete');
    Route::get('/gallery-image-multi-information/{id}','Backend\\AdminsController@galleryImageMultiInfor');
    Route::post('/update-gallery','Backend\\AdminsController@updateGallery');
    Route::post('/update-gallery-image-multi','Backend\\AdminsController@updateGalleryImageMulti');
    Route::post('/upload-gallery-image-multi','Backend\\AdminsController@uploadGalleryImageMulti');
    Route::get('/gallery-image-multi-delete/{id}','Backend\\AdminsController@galleryImageMultiDelete');

    Route::get('/image-slide', 'Backend\AdminsController@imageSlide');
    Route::get('/create-slide', 'Backend\AdminsController@createSlide');
    Route::post('/create-slide', 'Backend\AdminsController@createSlidePost');
    Route::get('/slide-delete/{id}','Backend\\AdminsController@slideDelete');
    Route::post('/update-slide', 'Backend\AdminsController@updateSlide');

    Route::get('/image-logo', 'Backend\AdminsController@imageLogo');
    Route::get('/create-logo', 'Backend\AdminsController@createLogo');
    Route::post('/create-logo', 'Backend\AdminsController@createLogoPost');
    Route::get('/logo-delete/{id}','Backend\\AdminsController@logoDelete');
    Route::post('/update-logo', 'Backend\AdminsController@updateLogo');

    Route::get('/contact', 'Backend\AdminsController@contact');
    Route::post('/create-contact', 'Backend\AdminsController@createContact');

    Route::get('/countdown', 'Backend\AdminsController@countdown');
    Route::get('/create-countdown', 'Backend\AdminsController@createCountdown');
    Route::post('/create-countdown', 'Backend\AdminsController@createCountdownPost');
    Route::post('/update-countdown', 'Backend\AdminsController@updateCountdown');
    Route::get('/countdown-delete/{id}','Backend\\AdminsController@countdownDelete');

    Route::get('/image-link', 'Backend\AdminsController@imageLink');
    Route::post('/create-image-link', 'Backend\AdminsController@imageLinkPost');
});