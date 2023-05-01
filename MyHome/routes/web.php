<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VendController;
use App\Http\Controllers\Auth\ForgotPasswordController;  


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
  
Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('loginVend', [VendController::class, 'index'])->name('loginVend');
Route::post('loginVend', [VendController::class, 'index'])->name('loginVend');
Route::get('post-loginVend', [VendController::class, 'postLoginVend'])->name('loginVend.post');
Route::post('post-loginVend', [VendController::class, 'postLoginVend'])->name('loginVend.post');
Route::get('vendorRegistration', [VendController::class, 'vendorRegistration'])->name('register');
Route::post('post-vendorRegistration', [VendController::class, 'postvendorRegistration'])->name('vendorRegister.post');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/index', function () {
    return view('index');
});

Route::get('/userHub', function () {
    return view('userHub');
});

Route::post('/userHub', function () {
    return view('userHub');
});

Route::get('/update', function () {
    return view('update');
});

Route::post('/update', function () {
    return view('update');
});

Route::get('/vendorHub', function () {
    return view('vendorHub');
});

Route::post('/vendorHub', function () {
    return view('vendorHub');
});