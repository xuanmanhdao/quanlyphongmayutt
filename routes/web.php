<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\LichMuonPhongController;
use App\Http\Controllers\lienHeSuCoController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Middleware\KiemTraDangNhapMiddleware;
use App\Http\Middleware\KiemTraQuyenAdminMiddleware;
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

Route::get('', function () {
    return view('auth.dangnhap');
});

Route::get('lichmuonphong/api_index_test', [LichMuonPhongController::class, 'api'])->name('lichmuonphong.api_index_test');


Route::get('/lienhebaocaosuco', [lienHeSuCoController::class, 'index'])->name('contact');

Route::get('dangnhap', [AuthController::class, 'dangNhap'])->name('dangnhap');

Route::post('duyet_dang_nhap', [AuthController::class, 'duyetDangNhap'])->name('duyet_dang_nhap');

Route::get('quenmatkhau', [AuthController::class, 'quenMatKhau'])->name('quenmatkhau');


Route::group([
    // Cách 1
    // 'middleware' => 'admin',

    // Cách 2
    'middleware' => KiemTraDangNhapMiddleware::class,
], function () {
    Route::get('dangxuat', [AuthController::class, 'dangXuat'])->name('dangxuat');

    Route::get('doimatkhau', [AuthController::class, 'doiMatKhau'])->name('doimatkhau');

    Route::post('duyet_doi_mat_khau', [AuthController::class, 'duyetDoiMatKhau'])->name('duyet_doi_mat_khau');

    Route::get('thaydoimatkhau', [AuthController::class, 'thayDoiMatKhau'])->name('thaydoimatkhau');

    Route::post('xacnhandoimatkhau', [AuthController::class, 'xacNhanDoiMatKhau'])->name('xacnhandoimatkhau');

    Route::get('phong/api_index', [PhongController::class, 'api'])->name('phong.api_index');
    Route::resource('phong', PhongController::class)->except([
        'create',
        'show',
        'edit',
        'destroy',
    ]);

    Route::get('giangvien/api_index', [GiangVienController::class, 'api'])->name('giangvien.api_index');
    Route::resource('giangvien', GiangVienController::class)->except([
        'create',
        'show',
        'edit',
        'destroy',
    ]);;

    // Route::get('taikhoan/api_index', [TaiKhoanController::class, 'api'])->name('taikhoan.api_index');
    // Route::resource('taikhoan', TaiKhoanController::class);

    Route::get('lichmuonphong/api_index', [LichMuonPhongController::class, 'api'])->name('lichmuonphong.api_index');
    Route::get('lichmuonphong/api_index/api_tiet_hoc', [LichMuonPhongController::class, 'apiTietHoc'])->name('lichmuonphong.api_index.api_tiet_hoc');
    Route::get('lichmuonphong/api_index/api_giang_vien', [LichMuonPhongController::class, 'apiMaGiangVien'])->name('lichmuonphong.api_index.api_giang_vien');
    Route::post('lichmuonphong/api_index/api_ngay_muon', [LichMuonPhongController::class, 'apiNgayMuon'])->name('lichmuonphong.api_index.api_ngay_muon');
    // Route::post('lichmuonphong/api_index/api_tiet_hoc_selected', [LichMuonPhongController::class, 'apiTietHocSelected'])->name('lichmuonphong.api_index.api_tiet_hoc_selected');
    Route::post('lichmuonphong/api_index/api_phong_kha_dung', [LichMuonPhongController::class, 'apiGetPhongKhaDung'])->name('lichmuonphong.api_index.api_phong_kha_dung');
    Route::resource('lichmuonphong', LichMuonPhongController::class)->except([
        'create',
        'show',
        'edit',
        'destroy',
    ]);;

    Route::group([
        'middleware' => KiemTraQuyenAdminMiddleware::class
    ], function () {
        Route::get('phong/create', [PhongController::class, 'create'])->name('phong.create');
        Route::get('phong/{phong}/edit', [PhongController::class, 'edit'])->name('phong.edit');
        Route::delete('phong/{phong}', [PhongController::class, 'destroy'])->name('phong.destroy');

        Route::get('giangvien/create', [GiangVienController::class, 'create'])->name('giangvien.create');
        Route::get('giangvien/{giangvien}/edit', [GiangVienController::class, 'edit'])->name('giangvien.edit');
        Route::delete('giangvien/{giangvien}', [GiangVienController::class, 'destroy'])->name('giangvien.destroy');

        Route::get('lichmuonphong/create', [LichMuonPhongController::class, 'create'])->name('lichmuonphong.create');
        Route::get('lichmuonphong/{lichmuonphong}/edit', [LichMuonPhongController::class, 'edit'])->name('lichmuonphong.edit');
        Route::delete('lichmuonphong/{lichmuonphong}', [LichMuonPhongController::class, 'destroy'])->name('lichmuonphong.destroy');
        Route::post('lichmuonphong/importexcel', [LichMuonPhongController::class, 'importExcel'])->name('lichmuonphong.importExcel');
        Route::get('lichmuonphong/previewfileexcel', [LichMuonPhongController::class, 'previewFileExcel'])->name('lichmuonphong.previewFileExcel');


        // Route::delete('giangvien/{giangvien}', [GiangVienController::class, 'edit'])->name('giangvien.destroy');
        // Route::delete('lichmuonphong/{lichmuonphong}', [LichMuonPhongController::class, 'destroy'])->name('lichmuonphong.destroy');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('xulytimkiemtheongay', [DashboardController::class, 'timKiemTheoNgay'])->name('xulytimkiemtheongay');
        Route::post('thongkesolangiangvienmuon', [DashboardController::class, 'thongKeSoLanGiangVienMuon'])->name('thongkesolangiangvienmuon');


    });
});
