<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () { 
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/welcome', [
        'uses' => 'DrumkitController@getWelcome', 
        'as' => 'welcome'
    ]);

    Route::post('/signup', [ 
        'uses' => 'UserController@postSignup', 
        'as' => 'signup'
    ]); 

    Route::post('/signin', [ 
        'uses' => 'UserController@postSignin', 
        'as' => 'signin' 
    ]); 

    Route::get('/signout', [ 
        'uses' => 'UserController@getSignout', 
        'as' => 'signout' 
    ]); 

    Route::get('/dashboard', [
        'uses' => 'UserController@getDashboard',
        'as' => 'dashboard' 
    ])->middleware('auth'); 

    Route::get('/drums', [ 
        'uses' => 'DrumkitController@getDrums', 
        'as' => 'drums'
    ]); 

    // may become get('/cheapest-drums')
    Route::get('/cheapest', [
        'uses' => 'DrumkitController@getDrumsCheapest', 
        'as' => 'cheapest' 
    ]); 

    /* 
    Route::get('/bookmarkedDrums', [
        'uses' => 'DrumkitController@getBokmarkedDrums', 
        'as' => 'bookmarkedDrums'
    ]); */ 

    Route::post('/bookmark', [
        'uses' => 'DrumkitController@postBookmarkDrum', 
        'as' => 'bookmark'
    ]); 
    
    Route::post('/post-drum', [ 
        'uses' => 'DrumkitController@postCreateDrum', 
        'as' => 'drum.create' 
    ]); 
    Route::get('/drumImage/{filename}', [ 
        'uses' => 'DrumkitController@getDrumImage', 
        'as' => 'drum.image' 
    ]); 

    Route::get('/delete-drum/{id}', [
        'uses' => 'DrumkitController@deleteDrum', 
        'as' => 'drum.delete'
    ]); 
}); 

