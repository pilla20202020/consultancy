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
    | Country CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'countries.', 'prefix' => 'country',], function () {
        Route::get('', 'Country\CountryController@index')->name('index');
        Route::get('country-data', 'Country\CountryController@getAllData')->name('data');
        Route::get('change-status','Country\CountryController@changeStatus')->name('change_status');
    });


    /*
    |--------------------------------------------------------------------------
    | State CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'states.', 'prefix' => 'state',], function () {
        Route::get('', 'State\StateController@index')->name('index');
        Route::get('state-data', 'State\StateController@getAllData')->name('data');
        Route::get('create', 'State\StateController@create')->name('create');
        Route::post('', 'State\StateController@store')->name('store');
        Route::get('{state}/edit', 'State\StateController@edit')->name('edit');
        Route::put('{state}', 'State\StateController@update')->name('update');
        Route::get('change-status','State\StateController@changeStatus')->name('change_status');
    });

        /*
    |--------------------------------------------------------------------------
    | Provice State CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'districts.', 'prefix' => 'district',], function () {
        Route::get('', 'District\DistrictController@index')->name('index');
        Route::get('country-data', 'District\DistrictController@getAllData')->name('data');
        Route::get('get-states', 'District\DistrictController@getState')->name('get_states');
        Route::get('create', 'District\DistrictController@create')->name('create');
        Route::post('', 'District\DistrictController@store')->name('store');
        Route::get('{district}/edit', 'District\DistrictController@edit')->name('edit');
        Route::put('{district}', 'District\DistrictController@update')->name('update');
        Route::get('change-status','District\DistrictController@changeStatus')->name('change_status');
    });


    /*
    |--------------------------------------------------------------------------
    | College CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'colleges.', 'prefix' => 'college',], function () {
        Route::get('', 'College\CollegeController@index')->name('index');
        Route::get('college-data', 'College\CollegeController@getAllData')->name('data');
        Route::get('get-state', 'College\CollegeController@getStates')->name('get_states');
        Route::get('create', 'College\CollegeController@create')->name('create');
        Route::post('', 'College\CollegeController@store')->name('store');
        Route::get('{college}/edit', 'College\CollegeController@edit')->name('edit');
        Route::put('{college}', 'College\CollegeController@update')->name('update');
        Route::get('change-status','College\CollegeController@changeStatus')->name('change_status');
    });

    Route::group(['as'=>'common.', 'prefix'=>'common'], function(){
        Route::post('states', 'Common\CommonController@getStatesByCountryId')->name('state.countryId');
        Route::post('colleges', 'Common\CommonController@getCollegesByStateId')->name('college.provinceId');
        Route::post('provinces', 'Common\CommonController@getProvincesByCountryId')->name('province.countryId');
        Route::post('districts', 'Common\CommonController@getDistrictsByProvinceId')->name('district.provinceId');
    });


    /*
    |--------------------------------------------------------------------------
    | Agent CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'agent.', 'prefix' => 'agent',], function () {
        Route::get('', 'Agent\AgentController@index')->name('index');
        Route::get('create', 'Agent\AgentController@create')->name('create');
        Route::post('', 'Agent\AgentController@store')->name('store');
        Route::get('{agent}/edit', 'Agent\AgentController@edit')->name('edit');
        Route::put('{agent}', 'Agent\AgentController@update')->name('update');
        Route::get('agent/{id}/destroy', 'Agent\AgentController@destroy')->name('destroy');

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
        Route::get('addcommencement', 'Admission\AdmissionController@addCommencement')->name('addcommencement');
        Route::get('getcommencementlist', 'Admission\AdmissionController@getCommencedAdmission')->name('getcommencedadmission');

        Route::get('commission-rate/{id}/', 'Admission\AdmissionController@commissionRate')->name('commission');
        Route::post('commission/store','Admission\AdmissionController@storeCommissionRate')->name('store_commission');
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
        Route::get('get-commission-by-parameter', 'CommissionClaim\CommissionClaimController@getCommissionByParameter')->name('get_commission_by_parameter');
        Route::get('claimed', 'CommissionClaim\CommissionClaimController@claimed')->name('claimed');
        Route::get('get-claimed-commission-by-parameter', 'CommissionClaim\CommissionClaimController@getClaimedCommissionByParameter')->name('get_claimed_commission_by_parameter');
        Route::get('create', 'CommissionClaim\CommissionClaimController@create')->name('create');
        Route::post('', 'CommissionClaim\CommissionClaimController@store')->name('store');
        Route::get('{commission-claim}/edit', 'CommissionClaim\CommissionClaimController@edit')->name('edit');
        Route::put('{commission-claim}', 'CommissionClaim\CommissionClaimController@update')->name('update');
        Route::get('commission-claim/{id}/destroy', 'CommissionClaim\CommissionClaimController@destroy')->name('destroy');

    });

});
