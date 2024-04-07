<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
Route::get('/dashboard',[MainController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

// User
Route::get('edit-profile',[ProfileController::class,'edit_profile'])->name('edit_profile');
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::POST('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('distributor-profile/{id}',[ProfileController::class,'distributor_profile'])->name('distributor-profile');
Route::get('client-profile/{id}',[ProfileController::Class,'client_profile'])->name('client-profile');
Route::post('update-password',[ProfileController::class,'update_password'])->name('update-password');

//Files
Route::get('all-tweets',[FileController::class,'index'])->name('all-files');
Route::get('all-gpts-content',[FileController::class,'all_gpts_content'])->name('all-gpts-content');

Route::get('add-tweet',[FileController::class,'create'])->name('add-files');
Route::get('add-gpt-file',[FileController::class,'gpt_file'])->name('add-gpt-file');
Route::POST('store-gpt-file',[FileController::class,'store_gpt'])->name('store-gpt');


Route::post('store-tweet',[FileController::class,'store'])->name('store-tweet');
Route::get('edit-files/{id}',[FileController::class,'edit'])->name('edit-file');
Route::post('update-files/{id}',[FileController::class,'update'])->name('update-files');
Route::get('delete-tweet/{id}',[FileController::class,'destroy'])->name('delete-file');
Route::post('import-excel',[FileController::class,'import_excel'])->name('import-excel');
Route::get('file-data/{id}',[FileController::class,'file_data'])->name('file-data');
Route::post('ledger-payment',[FileController::class,'ledger_payment'])->name('ledger-payment');
Route::get('delete_all',[MainController::class,'delete_all'])->name('delete_all');
Route::get('export_data',[FileController::class,'export_data'])->name('export-data');
Route::get('delete-ledger/{id}',[FileController::class,'delete_ledger'])->name('delete-ledger');
Route::POST('update-ledger/{id}',[FileController::class,'update_ledger'])->name('update-ledger');
Route::POST('update-file-dealer/{id}',[FileController::class,'update_file_dealer'])->name('update-file-dealer');
Route::POST('assigned-dealers',[FileController::class,'assigned_dealers'])->name('assigned_dealers');
Route::get('file-status/{status}',[FileController::class,'file_status'])->name('file_status');
Route::POST('files-filter',[FileController::class,'filter_file'])->name('file_filer');
Route::POST('sorting-filter',[FileController::class,'filter_file_sorting'])->name('filter_file_sorting');
Route::get('files-filter',[FileController::class,'filter_file'])->name('file_filer');
Route::get('export-files/{type}',[FileController::class,'export_files'])->name('export-files');
Route::POST('bulk_status',[FileController::class,'bulk_status'])->name('bulk_status');




//Twitter

Route::get('setting',[SettingController::class,'index'])->name('setting-details');
Route::POST('store-setting',[SettingController::class,'store'])->name('store-setting');
Route::POST('post-tweet',[TweetController::class,'postTweet'])->name('post-tweet');
Route::view('pricing','backend_app.pricing')->name('pricing');
Route::view('billing','backend_app.account-billing')->name('billing');



});
require __DIR__.'/auth.php';
