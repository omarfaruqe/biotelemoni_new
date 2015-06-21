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

        Route::delete('users/{cms_user}', ['as' => 'admin.users.delete', 'uses' => 'UserController@delete']);
    });

    Route::group(['before' => 'perm:view-users'], function () {
        Route::get('users/', ['as' => 'admin.users', 'uses' => 'UserController@index']);
        Route::get('users/{cms_user}', ['as' => 'admin.users.show', 'uses' => 'UserController@show']);
    });

    // Ingredients
    Route::group(['before' => 'perm:view-ingredients'], function () {
        Route::get('files/', ['as' => 'admin.files', 'uses' => 'FileController@index']);
        Route::get('files/create', ['as' => 'admin.files.create', 'uses' => 'FileController@create']);
        Route::post('files', ['as' => 'admin.files.store', 'uses' => 'FileController@store']);
        //Route::post('ingredients/delete', ['as' => 'admin.ingredients.delete', 'uses' => 'IngredientController@delete'])->where('cms_ingredient','[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}');
        //Route::get('ingredients/{cms_file}', ['as' => 'admin.ingredients.show', 'uses' => 'IngredientController@show']);
    });

    Route::group(['before' => 'perm:edit-ingredients'], function () {
        Route::get('files/{cms_file}/download', ['as' => 'admin.files.download', 'uses' => 'FileController@download']);
        Route::get('files/{cms_file}/edit', ['as' => 'admin.files.edit', 'uses' => 'FileController@edit']);
        Route::put('files/{cms_file}', ['as' => 'admin.files.update', 'uses' => 'FileController@update']);
        Route::get('files/{cms_file}/delete', ['as' => 'admin.files.delete', 'uses' => 'FileController@delete']);

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

