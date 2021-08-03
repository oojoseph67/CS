<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChoosePageController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\StaffPageController;
use App\Http\Controllers\PaymentController;

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


Route::view('/', 'auth.register')->name('register');

Route::view('/register-do', 'auth.register-data-operator')->name('register-data-operator');

Route::view('/register-teacher', 'auth.register-teacher')->name('register-teacher');

Route::view('/login', 'auth.login')->name('login');

Route::get('/choose', [ChoosePageController::class, 'index'])->name('choose');


Route::group(['middleware' => ['auth', 'student', 'payment_verification'], 'prefix' => 'stu'], function () {
    
    
    Route::get('/', [StudentPageController::class, 'index'])->name('student.home');

    Route::post('/personalForm', [StudentPageController::class, 'personalForm'])->name('personal-form');
    Route::post('/document', [StudentPageController::class, 'document'])->name('document');

    Route::post('/preliminaryForm', [StudentPageController::class, 'preliminaryForm'])->name('preliminary-form');
    Route::post('/clearanceForm', [StudentPageController::class, 'clearanceForm'])->name('clearance-form');
    Route::post('/guarrantorForm', [StudentPageController::class, 'guarrantorForm'])->name('guarrantor-form');

    Route::post('/updatePreliminaryForm', [StudentPageController::class, 'updatePreliminaryForm'])->name('update-preliminary-form');
    
});

Route::group(['middleware' => ['auth', 'hod'], 'prefix' => 'hod'], function (){

    Route::get('/', [StaffPageController::class, 'hodIndex'])->name('hod.home');

    Route::post('/clearance', [StaffPageController::class, 'clearanceStatus'])->name('clearance-status');
});

Route::view('/unpaid', 'students.unpaid')->name('unpaid')->middleware('auth');

Route::view('/acceptance_fee', 'students.acceptance_fee')->name('acceptance_fee')->middleware('auth');

Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');

Route::get('/payment/callback',  [PaymentController::class, 'handleGatewayCallback'])->name('callback');


// Route::get('/', function () {
//     return view('dashboard');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
