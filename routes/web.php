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

Route::get('/', function () {
    return view('welcome');
})->name("front");

Auth::routes();

Route::group(['middleware' => 'app_auth', 'namespace' => 'App\Http\Controllers'], function()
{
    Route::get('/home', 'HomeController@index')->name('home');

    //Meeting Controller Routes
    Route::get('/get-meetings', 'MeetingController@getMeetings')->name('get-meetings');
    Route::get('/get-meeting-details', 'MeetingController@getMeetingDetails')->name('get-meeting-details');
    Route::get('/get-society-reports', 'MeetingController@getSocietyReports')->name('get-society-reports');
    Route::get('/get-society-matters', 'MeetingController@getSocietyMatters')->name('get-society-matters');
    Route::get('/get-society-tasks', 'MeetingController@getSocietyTasks')->name('get-society-tasks');
    Route::get('/get-single-report', 'MeetingController@getSingleReport')->name('get-single-report');
    Route::get('/get-single-matter', 'MeetingController@getSingleMatter')->name('get-single-matter');
    Route::get('/get-single-task', 'MeetingController@getSingleTask')->name('get-single-task');
    Route::get('/toggle-task-status/{task}', 'MeetingController@toggleTaskStatus')->name('toggle-task-status');
    Route::get('/toggle-matter-status/{matter}', 'MeetingController@toggleMatterStatus')->name('toggle-matter-status');
    Route::put('/edit-report/{report}', 'MeetingController@editReport')->name('edit-report');
    Route::put('/edit-task/{task}', 'MeetingController@editTask')->name('edit-task');
    Route::put('/edit-matter/{matter}', 'MeetingController@editMatter')->name('edit-matter');
    Route::put('/edit-meeting/{meeting}', 'MeetingController@editMeeting')->name('edit-meeting');
    Route::post('/create-report', 'MeetingController@createReport')->name('create-report');
    Route::post('/create-task', 'MeetingController@createTask')->name('create-task');
    Route::post('/create-matter', 'MeetingController@createMatter')->name('create-matter');
    Route::post('/create-meeting', 'MeetingController@createMeeting')->name('create-meeting');
    Route::delete('/delete-matter/{matter}', 'MeetingController@deleteMatter')->name('delete-matter');
    Route::delete('/delete-task/{task}', 'MeetingController@deleteTask')->name('delete-task');
    Route::delete('/delete-report/{report}', 'MeetingController@deleteReport')->name('delete-report');
    Route::delete('/delete-meeting/{meeting}', 'MeetingController@deleteMeeting')->name('delete-meeting');

    //Member Controller Routes
    Route::get('/members', 'MemberController@getAllMembers')->name('members');
    Route::get('/executives', 'MemberController@getExecutives')->name('executives');
    Route::get('/commitees', 'MemberController@getCommitees')->name('commitees');
    Route::get('/floor-members', 'MemberController@getFloorMembers')->name('floor-members');
    Route::get('/roles', 'MemberController@getSocietyRoles')->name('roles');
    Route::post('/members', 'MemberController@addNewMember')->name('add-member');
    Route::post('/roles', 'MemberController@createRole')->name('add-roles');
    Route::post('/commitees', 'MemberController@createCommitee')->name('add-commitee');
    Route::put('/commitees/{commitee}', 'MemberController@editCommitee')->name('edit-commitee');
    Route::put('/members/{member}', 'MemberController@editMember')->name('edit-member');
    Route::put('/roles/{role}', 'MemberController@editRole')->name('edit-role');
    Route::delete('/members/{member}', 'MemberController@removeMember')->name('remove-member');
    Route::delete('/commitees/{commitee}', 'MemberController@removeCommitee')->name('remove-commitee');
    Route::delete('/roles/{role}', 'MemberController@removeRole')->name('remove-role');
    Route::get('/commitees/{commitee}', 'MemberController@getSingleCommitee')->name('single-commitee');
    Route::get('/members/{member}', 'MemberController@getSingleMember')->name('single-member');
    // Route::get('/roles/{role}', 'MemberController@getSingleRole')->name('single-role');


});
