<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('login'));
});

Auth::routes();

Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as' => 'user.','namespace' => 'App\Http\Controllers', 'prefix' => 'user',], function () {
    Route::get('forget-password', 'User\UserController@forgetPassword')->name('forgetPassword');
    Route::post('update-password', 'User\UserController@updatePassword')->name('updatePassword');

});

Route::group(['middleware' => 'auth','namespace' => 'App\Http\Controllers'], function () {
    Route::get('/dashboard','Dashboard\DashboardController@index')->name('dashboard');




    /*
    |--------------------------------------------------------------------------
    | User CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'user.', 'prefix' => 'user',], function () {
        Route::get('', 'User\UserController@index')->name('index')->middleware('permission:user-index');
        Route::get('user-data', 'User\UserController@getAllData')->name('data')->middleware('permission:user-data');
        Route::get('create', 'User\UserController@create')->name('create')->middleware('permission:user-create');
        Route::post('', 'User\UserController@store')->name('store')->middleware('permission:user-store');
        Route::get('{user}/edit', 'User\UserController@edit')->name('edit')->middleware('permission:user-edit');
        Route::put('{user}', 'User\UserController@update')->name('update')->middleware('permission:user-update');
        Route::get('user/{id}/destroy', 'User\UserController@destroy')->name('destroy')->middleware('permission:user-delete');
        Route::get('update-profile', 'User\UserController@profileUpdate')->name('profileUpdate');
        Route::post('update-profile/{id}', 'User\UserController@profileUpdateStore')->name('updateProfile');

    });

    /*
    |--------------------------------------------------------------------------
    | Role CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'role.', 'prefix' => 'role',], function () {
        Route::get('', 'Role\RoleController@index')->name('index')->middleware('permission:role-index');
        Route::get('role-data', 'Role\RoleController@getAllData')->name('data')->middleware('permission:role-data');
        Route::get('create', 'Role\RoleController@create')->name('create')->middleware('permission:role-create');
        Route::post('', 'Role\RoleController@store')->name('store')->middleware('permission:role-store');
        Route::get('{role}/edit', 'Role\RoleController@edit')->name('edit')->middleware('permission:role-edit');
        Route::put('{role}', 'Role\RoleController@update')->name('update')->middleware('permission:role-update');
        Route::get('role/{id}/destroy', 'Role\RoleController@destroy')->name('destroy')->middleware('permission:role-delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Permission CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'permission.', 'prefix' => 'permission',], function () {
        Route::get('', 'Permission\PermissionController@index')->name('index')->middleware('permission:role-index');
        Route::get('permission-data', 'Permission\PermissionController@getAllData')->name('data')->middleware('permission:role-data');
        Route::get('create', 'Permission\PermissionController@create')->name('create')->middleware('permission:permission-create');
        Route::post('', 'Permission\PermissionController@store')->name('store')->middleware('permission:role-store');
        Route::get('{permission}/edit', 'Permission\PermissionController@edit')->name('edit')->middleware('permission:permission-edit');
        Route::put('{permission}', 'Permission\PermissionController@update')->name('update')->middleware('permission:role-update');
        Route::get('permission/{id}/destroy', 'Permission\PermissionController@destroy')->name('destroy')->middleware('permission:permission-delete');
    });


    /*
    |--------------------------------------------------------------------------
    | Student CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'student.', 'prefix' => 'student',], function () {
        Route::get('', 'Student\StudentController@index')->name('index');
        Route::get('student-data', 'Student\StudentController@getAllData')->name('data');
        Route::get('create', 'Student\StudentController@create')->name('create');
        Route::post('', 'Student\StudentController@store')->name('store');
        Route::get('{student}/edit', 'Student\StudentController@edit')->name('edit');
        Route::put('{student}', 'Student\StudentController@update')->name('update');
        Route::get('student/{id}/destroy', 'Student\StudentController@destroy')->name('destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | Admission CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'admission.', 'prefix' => 'admission',], function () {
        Route::get('', 'Admission\AdmissionController@index')->name('index');
        Route::get('admission-data', 'Admission\AdmissionController@getAllData')->name('data');
        Route::get('create', 'Admission\AdmissionController@create')->name('create');
        Route::post('', 'Admission\AdmissionController@store')->name('store');
        Route::get('{admission}/edit', 'Admission\AdmissionController@edit')->name('edit');
        Route::put('{admission}', 'Admission\AdmissionController@update')->name('update');
        Route::get('admission/{id}/destroy', 'Admission\AdmissionController@destroy')->name('destroy');
        Route::get('admission/commission-rate/{id}/', 'Admission\AdmissionController@commissionRate')->name('commission');
        Route::post('admission/commission/store','Admission\AdmissionController@storeCommissionRate')->name('store_commission');
        Route::get('/{id}/delete-commission','Admission\AdmissionController@deleteCommission')->name('delete_commission');
        Route::get('getcommissiondetail', 'Admission\AdmissionController@getCommissionDetail')->name('getcommissiondetail');
        Route::post('addcommissionclaim', 'Admission\AdmissionController@addCommissionClaim')->name('addcommissionclaim');
        Route::post('addfollowup', 'Admission\AdmissionController@addFollowUp')->name('addfollowup');

    });

    /*
    |--------------------------------------------------------------------------
    | Commission Claim List
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'commission-claim.', 'prefix' => 'commission-claim',], function () {
        Route::get('', 'CommissionClaim\CommissionClaimController@index')->name('index');
        Route::get('create', 'CommissionClaim\CommissionClaimController@create')->name('create');
        Route::post('', 'CommissionClaim\CommissionClaimController@store')->name('store');
        Route::get('{commission-claim}/edit', 'CommissionClaim\CommissionClaimController@edit')->name('edit');
        Route::put('{commission-claim}', 'CommissionClaim\CommissionClaimController@update')->name('update');
        Route::get('commission-claim/{id}/destroy', 'CommissionClaim\CommissionClaimController@destroy')->name('destroy');

    });

});
