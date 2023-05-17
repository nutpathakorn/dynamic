<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ThailandController;

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

/*
    Route::get('main', function () {
        return view('pages.main');
    })->name('main');
*/

Route::post('addsession', [LoginController::class, 'addsession']);
Route::get('logout', [LoginController::class, 'deletesession']);

Route::get('main', function () {
    return view('pages.main');
});

Route::get('formCreate', function () {
    return view('pages.formCreate');
});

Route::get('master_basket_company', function () {
    return view('pages.master_basket_company');
});


Route::get('/', function () {
    return view('pages.login');
})->name('login');

Route::get('job_assign', function () {
    return view('pages.job_assign');
});

Route::get('job_assign_details', function () {
    return view('pages.job_assign_details');
});

Route::get('report', function () {
    return view('pages.report');
});

Route::get('customer_user', function () {
    return view('pages.customer_user');
});

Route::get('customer_user_details', function () {
    return view('pages.customer_user_details');
});

Route::get('customer_admin_details', function () {
    return view('pages.customer_admin_details');
});

Route::get('staff_details', function () {
    return view('pages.staff_details');
});

Route::get('setting', function () {
    return view('pages.setting');
});

//////////////////////////////////////////////

Route::get('main_admin', function () {
    return view('pages.main_admin');
});

Route::get('staff', function () {
    return view('pages.staff');
});

Route::get('job_assign_admin', function () {
    return view('pages.job_assign_admin');
});

Route::get('report_admin', function () {
    return view('pages.report_admin');
});

Route::get('setting_admin', function () {
    return view('pages.setting_admin');
});

Route::get('customer', function () {
    return view('pages.customer');
});

Route::get('map_admin', function () {
    return view('pages.map_admin');
});

