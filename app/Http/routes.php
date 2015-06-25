<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// until we have a front end, forward home routes to admin
Route::get('/', function () {
    return redirect('/admin');
});

/**
 * Content Management System Routes
 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'CMS'], function () {

    //demo of admin skin
    Route::get('styleguide', 'CmsController@styleGuide');

    // Dashboard
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'CmsController@dashboard']);

    // Users
    Route::group(['before' => 'perm:edit-profile'], function () {
        Route::get('profile/', ['as' => 'admin.profile', 'uses' => 'UserController@profile']);
        Route::get('profile/edit', ['as' => 'admin.profile.edit', 'uses' => 'UserController@editProfile']);
        Route::put('profile', ['as' => 'admin.profile.update', 'uses' => 'UserController@updateProfile']);
    });

    Route::group(['before' => 'perm:edit-users'], function () {
        Route::get('users/create', ['as' => 'admin.users.create', 'uses' => 'UserController@create']);
        Route::post('users', ['as' => 'admin.users.store', 'uses' => 'UserController@store']);

        Route::get('users/{cms_user}/edit', ['as' => 'admin.users.edit', 'uses' => 'UserController@edit']);
        Route::put('users/{cms_user}', ['as' => 'admin.users.update', 'uses' => 'UserController@update']);
        Route::get('users/{cms_user}/delete', ['as' => 'admin.users.delete', 'uses' => 'UserController@delete']);
    });

    Route::group(['before' => 'perm:view-users'], function () {
        Route::get('users/', ['as' => 'admin.users', 'uses' => 'UserController@index']);
        Route::get('users/{cms_user}', ['as' => 'admin.users.show', 'uses' => 'UserController@show']);
    });

    // Batch Files
    Route::group(['before' => 'perm:view-batch-files'], function () {
        Route::get('files/', ['as' => 'admin.files', 'uses' => 'FileController@index']);
        Route::get('files/create', ['as' => 'admin.files.create', 'uses' => 'FileController@create']);
        Route::post('files', ['as' => 'admin.files.store', 'uses' => 'FileController@store']);
    });

    Route::group(['before' => 'perm:delete-download-batch-files'], function () {
        Route::get('files/{cms_batch_file}/download', ['as' => 'admin.files.download', 'uses' => 'FileController@download']);
        Route::get('files/{cms_batch_file}/edit', ['as' => 'admin.files.edit', 'uses' => 'FileController@edit']);
        Route::put('files/{cms_batch_file}', ['as' => 'admin.files.update', 'uses' => 'FileController@update']);
        Route::get('files/{cms_batch_file}/delete', ['as' => 'admin.files.delete', 'uses' => 'FileController@delete']);

    });
    
     // Response Files
    Route::group(['before' => 'perm:view-response-files'], function () {
        Route::get('responses/', ['as' => 'admin.responses', 'uses' => 'ResponseController@index']);
       });
       
        // Response Files
    Route::group(['before' => 'perm:upload-response-files'], function () {
        Route::get('responses/create', ['as' => 'admin.responses.create', 'uses' => 'ResponseController@create']);
        Route::post('responses', ['as' => 'admin.responses.store', 'uses' => 'ResponseController@store']);
       });
       

    Route::group(['before' => 'perm:delete-response-files'], function () {
        Route::get('responses/{cms_response_file}/delete', ['as' => 'admin.responses.delete', 'uses' => 'ResponseController@delete']);

    });
    
    Route::group(['before' => 'perm:download-response-files'], function () {
        Route::get('responses/{cms_response_file}/download', ['as' => 'admin.responses.download', 'uses' => 'ResponseController@download']);
        });
    
     // Return Files
    Route::group(['before' => 'perm:view-return-files'], function () {
        Route::get('return/', ['as' => 'admin.returns', 'uses' => 'ReturnController@index']);
        Route::get('return/create', ['as' => 'admin.returns.create', 'uses' => 'ReturnController@create']);
        Route::post('return', ['as' => 'admin.returns.store', 'uses' => 'ReturnController@store']);
       });

    Route::group(['before' => 'perm:delete-return-files'], function () {
        Route::get('return/{cms_return_file}/delete', ['as' => 'admin.returns.delete', 'uses' => 'ResponseController@delete']);
    });
    
    Route::group(['before' => 'perm:download-return-files'], function () {
        Route::get('return/{cms_return_file}/download', ['as' => 'admin.returns.download', 'uses' => 'ResponseController@download']);
       });
    
    // Payout Report
    Route::group(['before' => 'perm:view-payout-report'], function () {
        Route::get('report/', ['as' => 'admin.reports', 'uses' => 'ReportController@index']);
        Route::get('report/create', ['as' => 'admin.reports.create', 'uses' => 'ReportController@create']);
        Route::post('report', ['as' => 'admin.reports.store', 'uses' => 'ReportController@store']);
       });
    
    Route::group(['before' => 'perm:delete-return-files'], function () {
        Route::get('return/{cms_report}/edit', ['as' => 'admin.reports.edit', 'uses' => 'ReportController@edit']);
        Route::put('return/{cms_report}', ['as' => 'admin.reports.update', 'uses' => 'ReportController@update']);
        Route::get('return/{cms_report}/delete', ['as' => 'admin.reports.delete', 'uses' => 'ReportController@delete']);
    });
    
    Route::group(['before' => 'perm:download-payout-report'], function () {
        Route::get('return/{cms_report}/download', ['as' => 'admin.reports.download', 'uses' => 'ReportController@download']);
       });
});


/**
 * CMS Authentification
 */
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('register', ['as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
    Route::post('register', ['as' => 'auth.register.submit', 'uses' => 'AuthController@postRegister']);
    Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'auth.login.submit', 'uses' => 'AuthController@postLogin']);
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);
});

Route::group(['prefix' => 'password', 'namespace' => 'Auth'], function () {
    Route::get('email', ['as' => 'password.email', 'uses' => 'PasswordController@getEmail']);
    Route::post('password/email', ['as' => 'password.email.submit', 'uses' => 'PasswordController@postEmail']);
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'PasswordController@getReset']);
    Route::post('password/reset', ['as' => 'password.reset.submit', 'uses' => 'PasswordController@postEmail']);
});

