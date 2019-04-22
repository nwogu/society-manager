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

Route::group(['middleware' => ['web', 'app_auth']], function()
{
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'meeting'], function(){
        //Meeting Controller Routes
        Route::get('/get-meetings', 'MeetingController@getMeetings')->name('get-meetings');
        Route::get('/get-meeting-details/{meeting}', 'MeetingController@getMeetingDetails')->name('get-meeting-details');
        Route::get('/get-society-reports', 'MeetingController@getSocietyReports')->name('get-society-reports');
        Route::get('/get-society-matters', 'MeetingController@getSocietyMatters')->name('get-society-matters');
        Route::get('/show-create-matters', 'MeetingController@displayMatterForm')->name('show-create-matters');
        Route::get('/get-society-tasks', 'MeetingController@getSocietyTasks')->name('get-society-tasks');
        Route::get('/get-single-report', 'MeetingController@getSingleReport')->name('get-single-report');
        Route::get('/get-single-matter/{matter}', 'MeetingController@getSingleMatter')->name('get-single-matter');
        Route::post('/add-matter-to-meeting/{matter}', 'MeetingController@addMatterToMeeting')->name('add-matter-to-meeting');
        Route::get('/get-single-task', 'MeetingController@getSingleTask')->name('get-single-task');
        Route::get('/toggle-task-status/{task}', 'MeetingController@toggleTaskStatus')->name('toggle-task-status');
        Route::get('/toggle-matter-status/{matter}', 'MeetingController@toggleMatterStatus')->name('toggle-matter-status');
        Route::put('/edit-report/{report}', 'MeetingController@editReport')->name('edit-report');
        Route::put('/edit-task/{task}', 'MeetingController@editTask')->name('edit-task');
        Route::post('/edit-matter/{matter}', 'MeetingController@editMatter')->name('edit-matter');
        Route::get('/show-edit-matter/{matter}', 'MeetingController@displayEditMatterForm')->name('show-edit-matter');
        Route::post('/edit-meeting/{meeting}', 'MeetingController@editMeeting')->name('edit-meeting');
        Route::get('/edit-meeting/{meeting}', 'MeetingController@displayEditMeetingForm')->name('show-edit-meeting');
        Route::post('/create-report', 'MeetingController@createReport')->name('create-report');
        Route::post('/create-task', 'MeetingController@createTask')->name('create-task');
        Route::post('/create-matter', 'MeetingController@createMatter')->name('create-matter');
        Route::post('/create-meeting', 'MeetingController@createMeeting')->name('create-meeting');
        Route::get('/create-meeting', 'MeetingController@displayMeetingForm')->name('show-create-meeting');
        Route::get('/delete-matter/{matter}', 'MeetingController@deleteMatter')->name('delete-matter');
        Route::get('/confirm-delete-matter/{matter}', 'MeetingController@confirmDeleteMatter')->name('confirm-remove-matter');
        Route::delete('/delete-task/{task}', 'MeetingController@deleteTask')->name('delete-task');
        Route::delete('/delete-report/{report}', 'MeetingController@deleteReport')->name('delete-report');
        Route::get('/delete-meeting/{meeting}', 'MeetingController@deleteMeeting')->name('delete-meeting');
        Route::get('/download-minute/{meeting}', 'MeetingController@downloadMinute')->name('download-minute');
        Route::get('/send-minute-all/{meeting}', 'MeetingController@sendMinutesToAllMembers')->name('send-minute-all');
        Route::post('/send-minute-persons/{meeting}', 'MeetingController@sendMinutesToPersons')->name('send-minute-persons');
        Route::get('/confirm-delete-meeting/{meeting}', 'MeetingController@confirmDeleteMeeting')->name('confirm-delete-meeting');
    });

    Route::group(['prefix' => 'member'], function(){
        //Member Controller Routes
        Route::get('/members', 'MemberController@getAllMembers')->name('members');
        Route::get('/add-member', 'MemberController@displayAddMemberForm')->name('show-add-member');
        Route::get('/executives', 'MemberController@getExecutives')->name('executives');
        Route::get('/commitees', 'MemberController@getCommitees')->name('commitees');
        Route::get('/floor-members', 'MemberController@getFloorMembers')->name('floor-members');
        Route::get('/roles', 'MemberController@getSocietyRoles')->name('roles');
        Route::post('/members', 'MemberController@addNewMember')->name('add-member');
        Route::post('/roles', 'MemberController@createRole')->name('add-roles');
        Route::get('/show-create-role', 'MemberController@displayCreateRoleForm')->name('show-create-role');
        Route::get('/show-edit-role/{role}', 'MemberController@displayEditRoleForm')->name('show-edit-role');
        Route::post('/commitees', 'MemberController@createCommitee')->name('add-commitee');
        Route::put('/commitees/{commitee}', 'MemberController@editCommitee')->name('edit-commitee');
        Route::post('/edit-members/{member}', 'MemberController@editMember')->name('edit-member');
        Route::get('/show-edit-members/{member}', 'MemberController@displayEditMemberForm')->name('show-edit-member');
        Route::post('/roles/{role}', 'MemberController@editRole')->name('edit-role');
        Route::get('/remove-members/{member}', 'MemberController@removeMember')->name('remove-member');
        Route::get('/confirm-remove-members/{member}', 'MemberController@confirmRemoveMember')->name('confirm-remove-member');
        Route::get('/confirm-remove-role/{role}', 'MemberController@confirmRemoveRole')->name('confirm-remove-role');
        Route::delete('/commitees/{commitee}', 'MemberController@removeCommitee')->name('remove-commitee');
        Route::get('/roles/{role}', 'MemberController@removeRole')->name('remove-role');
        Route::get('/commitees/{commitee}', 'MemberController@getSingleCommitee')->name('single-commitee');
        Route::get('/members/{member}', 'MemberController@getSingleMember')->name('single-member');
        // Route::get('/roles/{role}', 'MemberController@getSingleRole')->name('single-role');
    });
    
    Route::group(['prefix' => 'finance'], function(){
        //Finance Routes
        Route::get('/dues', 'FinanceController@getCollectedDues')->name('get-collected-dues');
        Route::get('/show-record-collection', 'FinanceController@showRecordCollection')->name('show-record-collection');
        Route::get('show-edit-collection/{collection}', 'FinanceController@showEditCollection')->name('show-edit-collection');
        Route::get('show-collection/{collection}', 'FinanceController@showCollection')->name('show-collection');
        Route::get('/levies', 'FinanceController@getCollectedLevies')->name('get-collected-levies');
        Route::get('/donations', 'FinanceController@getCollectedDonations')->name('get-collected-donations');
        Route::get('/expenses', 'FinanceController@getCollectedExpenses')->name('get-collected-expenses');
        Route::post('/record-collection', 'FinanceController@recordCollection')->name('record-collection');
        Route::post('/edit-collection/{collection}', 'FinanceController@editCollection')->name('edit-collection');
        Route::get('/delete-collection/{collection}', 'FinanceController@deleteCollection')->name('delete-collection');
    });


});
