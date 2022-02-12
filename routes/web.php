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
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

//auth route for all
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name
    ('dashboard');
});
//auth route for superadmin
Route::group(['middleware' => ['auth','role:superadmin']], function () {
    Route::get('/all-odds',              [App\Http\Controllers\OddController::class, 'allOdds']);
    Route::get('/add-odds',              [App\Http\Controllers\OddController::class, 'addOdds']);
    Route::post('/add-odds',             [App\Http\Controllers\OddController::class, 'saveOdds'])->name('saveodds');
    Route::get('/edit-odds/{id}',        [App\Http\Controllers\OddController::class, 'editOdds']);
    Route::patch('/all-odds/{id}',       [App\Http\Controllers\OddController::class, 'updateOdds'])->name('updateodds');
    Route::patch('/delete-odds/{id}',    [App\Http\Controllers\OddController::class, 'destroyOdds'])->name('deleteodds');

    //for merchant
    Route::get('/all-merchant',          [App\Http\Controllers\MerchantController::class, 'allMerchant']);
    Route::get('/admin-add-merchant',          [App\Http\Controllers\MerchantController::class, 'addMerchant']);
    Route::get('/admin-add-merchant',          [App\Http\Controllers\MerchantController::class, 'adminAddMerchant']);
    Route::post('/all-merchant',         [App\Http\Controllers\MerchantController::class, 'saveMerchant'])->name('savemerchant');
    Route::get('/edit-merchant/{id}',    [App\Http\Controllers\MerchantController::class, 'editMerchant']);
    Route::patch('/all-merchant/{id}',   [App\Http\Controllers\MerchantController::class, 'updateMerchant'])->name('updatemerchant');

    //for receipt
    Route::get('/all-receipt',           [App\Http\Controllers\ReceiptController::class, 'allReceipt']);
    Route::get('/add-receipt',           [App\Http\Controllers\ReceiptController::class, 'addReceipt']);
    Route::get('/new-receipt/{id}',      [App\Http\Controllers\ReceiptController::class, 'newReceipt']);
    Route::post('/all-receipt',          [App\Http\Controllers\ReceiptController::class, 'saveReceipt'])->name('savereceipt');
    Route::get('/edit-receipt/{id}',     [App\Http\Controllers\ReceiptController::class, 'editReceipt']);
    Route::patch('/all-receipt/{id}',    [App\Http\Controllers\ReceiptController::class, 'updateReceipt'])->name('updatereceipt');
    Route::get('/search',                [App\Http\Controllers\ReceiptController::class, 'search'])->name('search');
    Route::get('/print-receipt',         [App\Http\Controllers\ReceiptController::class, 'printReceipt']);
    Route::get('/print-preview',         [App\Http\Controllers\ReceiptController::class, 'printPreview'])->name('printpreview');
});

//auth for user
Route::group(['middleware' => ['auth']], function () {
    Route::get('/all-odds',              [App\Http\Controllers\OddController::class, 'allOdds']);
    Route::get('/add-odds',              [App\Http\Controllers\OddController::class, 'addOdds']);
    Route::post('/add-odds',             [App\Http\Controllers\OddController::class, 'saveOdds'])->name('saveodds');
    Route::get('/edit-odds/{id}',        [App\Http\Controllers\OddController::class, 'editOdds']);
    Route::patch('/all-odds/{id}',       [App\Http\Controllers\OddController::class, 'updateOdds'])->name('updateodds');
    Route::patch('/delete-odds/{id}',    [App\Http\Controllers\OddController::class, 'destroyOdds'])->name('deleteodds');

    //for merchant
    Route::get('/all-merchant',          [App\Http\Controllers\MerchantController::class, 'allMerchant']);
    Route::get('/add-merchant',          [App\Http\Controllers\MerchantController::class, 'addMerchant']);
    Route::post('/all-merchant',         [App\Http\Controllers\MerchantController::class, 'saveMerchant'])->name('savemerchant');
    Route::get('/edit-merchant/{id}',    [App\Http\Controllers\MerchantController::class, 'editMerchant']);
    Route::patch('/all-merchant/{id}',   [App\Http\Controllers\MerchantController::class, 'updateMerchant'])->name('updatemerchant');

    //for receipt
    Route::get('/all-receipt',           [App\Http\Controllers\ReceiptController::class, 'allReceipt']);
    Route::get('/add-receipt',           [App\Http\Controllers\ReceiptController::class, 'addReceipt']);
    Route::get('/new-receipt/{id}',      [App\Http\Controllers\ReceiptController::class, 'newReceipt']);
    Route::post('/all-receipt',          [App\Http\Controllers\ReceiptController::class, 'saveReceipt'])->name('savereceipt');
//    Route::get('/edit-receipt/{id}',     [App\Http\Controllers\ReceiptController::class, 'editReceipt']);
//    Route::patch('/all-receipt/{id}',    [App\Http\Controllers\ReceiptController::class, 'updateReceipt'])->name('updatereceipt');
    Route::get('/search',                [App\Http\Controllers\ReceiptController::class, 'search'])->name('search');
    Route::get('/print-receipt',         [App\Http\Controllers\ReceiptController::class, 'printReceipt']);
    Route::get('/print-preview',         [App\Http\Controllers\ReceiptController::class, 'printPreview'])->name('printpreview');
});
//auth route for user
//Route::group(['middleware' => ['auth', 'role:user']], function () {
    //Route::get('/dashboard/myprofile', [App\Http\Controllers\DashboardController::class, 'myprofile'])
       // ->name('dashboard.myprofile');
//});

//auth route for zonal-admin
Route::group(['middleware' => ['auth', 'role:blogwriter']], function () {
    Route::get('/dashboard/postcreate', [App\Http\Controllers\DashboardController::class,'postcreate'])
        ->name('dashboard.postcreate');
});

//auth route for admin
Route::group(['middleware' => ['auth', 'role:blogwriter']], function () {
    Route::get('/dashboard/postcreate', [App\Http\Controllers\DashboardController::class,'postcreate'])
        ->name('dashboard.postcreate');
});

require __DIR__.'/auth.php';
