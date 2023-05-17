<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyUserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThailandController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\LoginController;
 
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
 
Route::middleware('auth:api')->group(function () {
    //PassportAuthController
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    //StaffController
    Route::post('ins_staff', [StaffController::class, 'store']);
    Route::post('getStaffMas', [StaffController::class, 'getStaffMas']);
    Route::post('insStaffMas', [StaffController::class, 'insStaffMas']);
    Route::post('getStaffAll', [StaffController::class, 'getStaffAll']);
    
    //ThailandController
    Route::get('provinces', [ThailandController::class, 'provinces']);
    Route::post('districts', [ThailandController::class, 'districts']);
    Route::post('subdistricts', [ThailandController::class, 'subdistricts']);
    Route::post('subdistricts_post', [ThailandController::class, 'subdistricts_post']);
    //CompanyController
    Route::post('ins_customer', [CompanyController::class, 'store']);
    Route::post('ins_customer_user', [CompanyUserController::class, 'store']);
    Route::post('ins_job_details', [CompanyController::class, 'insJobDetail']);
    Route::post('import-excel', [CompanyController::class, 'import']);
    Route::post('getCustomerId', [CompanyController::class, 'getCustomerId']);
    Route::post('checkCompanyUserId', [CompanyController::class, 'checkCompanyUserId']);
    Route::post('insCompanyUserId', [CompanyController::class, 'insCompanyUserId']);
    Route::post('getCompanyUser', [CompanyController::class, 'getCompanyUser']);
    Route::post('delCompanyUser', [CompanyController::class, 'delCompanyUser']);
    Route::post('getCompanyUserById', [CompanyController::class, 'getCompanyUserById']);
    Route::post('updateCompanyUserId', [CompanyController::class, 'updateCompanyUserId']);
    Route::post('getJobMaster', [CompanyController::class, 'getJobMaster']);
    Route::post('getJobMasterAll', [CompanyController::class, 'getJobMasterAll']);
    Route::post('getJobMasterByDate', [CompanyController::class, 'getJobMasterByDate']);
    Route::post('getJobMasterByBetweenDate', [CompanyController::class, 'getJobMasterByBetweenDate']);
    Route::post('updateJobStatus', [CompanyController::class, 'updateJobStatus']);
    Route::post('getJobMasterByDateAll', [CompanyController::class, 'getJobMasterByDateAll']);
    Route::post('getCompanyAll', [CompanyController::class, 'getCompanyAll']);
    Route::post('getCompanyOwnerId', [CompanyController::class, 'getCompanyOwnerId']);
    
    
    
    
    //BackendController
    Route::post('insMasterBasket', [BackendController::class, 'insMasterBasket']); 
    Route::post('getMasterBasket', [BackendController::class, 'getMasterBasket']);
    Route::post('delMasterBasket', [BackendController::class, 'delMasterBasket']); 
    Route::post('getMasterBasketId', [BackendController::class, 'getMasterBasketId']);
    Route::post('updateMasterBasket', [BackendController::class, 'updateMasterBasket']);
    Route::post('getMasterBasketStaffId', [BackendController::class, 'getMasterBasketStaffId']);
    Route::post('deleteMasterBasketStaffId', [BackendController::class, 'deleteMasterBasketStaffId']);
    Route::post('getJobStatusAll', [BackendController::class, 'getJobStatusAll']);
    Route::post('getMasterBasketAll', [BackendController::class, 'getMasterBasketAll']);
    Route::post('updateJobStatusBSJ', [BackendController::class, 'updateJobStatusBSJ']);
    Route::post('getMasterBasketCompany', [BackendController::class, 'getMasterBasketCompany']);
    Route::post('updateBasketCompany', [BackendController::class, 'updateBasketCompany']);
    
    //LoginController
    Route::post('getCompanyDetails', [LoginController::class, 'getCompanyDetails']);
    
    
     
});

Route::middleware('auth:api')->group(function () {
    Route::resource('posts', PostController::class);
});
