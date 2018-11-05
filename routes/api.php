<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function() {
    Route::get('/profile', 'APIController@getProfile');
    Route::get('/jobs', 'APIController@getJobs');
    Route::get('/conferences', 'APIController@getConferences');
    Route::get('/projects', 'APIController@getProjects');
    Route::get('/skills', 'APIController@getSkills');
    Route::get('/schools', 'APIController@getSchools');
});