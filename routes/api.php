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

// Route::group(["domain" => "api.domain.key"], function() {
//     // your api routes.
// });

// Chưa jwt
Route::post('duyetdangnhap', [App\Http\Controllers\Api\AuthControllerAPI::class, 'duyetDangNhap'])->name('duyetdangnhap');

Route::post('duyetdoimatkhau', [App\Http\Controllers\Api\AuthControllerAPI::class, 'duyetDoiMatKhau'])->name('duyetdoimatkhau');

// Route::get('connect', [App\Http\Controllers\nckh\connect::class])->name('connect');

// Route::get('ds_lichmuonphong', [App\Http\Controllers\nckh\ds_lichmuonphong::class, 'ds_lichmuonphong'])->name('ds_lichmuonphong');

Route::get('ds_lichmuonphong', [App\Http\Controllers\nckh\ds_lichmuonphong::class, 'ds_lichmuonphong'])->name('ds_lichmuonphong');

Route::get('infoQuanLy', [App\Http\Controllers\nckh\infoQuanLy::class, 'infoQuanLy'])->name('infoQuanLy');

Route::get('phong', [App\Http\Controllers\nckh\phong::class, 'phong'])->name('phong');

Route::get('sync_muonphong', [App\Http\Controllers\nckh\sync_muonphong::class, 'sync_muonphong'])->name('sync_muonphong');

Route::post('sendemail', [App\Http\Controllers\nckh\SendEmail::class, 'SendEmail'])->name('SendEmail'); // bug

Route::post('them_lichmuonphong', [App\Http\Controllers\nckh\them_lichmuonphong::class, 'them_lichmuonphong'])->name('them_lichmuonphong'); // json

Route::get('sync_muonphong_thanhcong', [App\Http\Controllers\nckh\sync_muonphong_thanhcong::class, 'sync_muonphong_thanhcong'])->name('sync_muonphong_thanhcong'); // value







Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/* Đã JWT
Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'authJWT'
], function () {
    Route::post('duyetdangnhap', [App\Http\Controllers\Api\AuthControllerAPI::class, 'duyetDangNhap'])->name('duyetdangnhap');
    Route::post('duyetdoimatkhau', [App\Http\Controllers\Api\AuthControllerAPI::class, 'duyetDoiMatKhau'])->name('duyetdoimatkhau');
    Route::post('lammoi', [App\Http\Controllers\Api\AuthControllerAPI::class, 'lamMoi'])->name('lammoi');
});
*/
