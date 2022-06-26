<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\TaiKhoan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    //
    public function dangNhap()
    {
        return view('auth.dangnhap');
    }

    public function duyetDangNhap(Request $request)
    {
        try {
            // dd($request);
            $taiKhoan = TaiKhoan::query()
                ->where('MaGiangVien', '=', $request->post('MaGiangVien'))
                // ->where('MatKhau', '=', $request->post('MatKhau'))
                // ->get();
                ->firstOrFail();
            // dd($taiKhoan);
            if (!Hash::check($request->post('MatKhau'), $taiKhoan->MatKhau)) {
                throw new Exception("Sai mật khẩu");
            }
            // dd($taiKhoan);
            // put sẽ ghi đè lên nếu nó tồn tại rồi
            session()->put('MaGiangVien', $taiKhoan->MaGiangVien);
            session()->put('Quyen', $taiKhoan->Quyen);

            // return redirect()->route('phong.index',function($taiKhoan){
            //     response()->json([
            //         'success' => true,
            //         'statusCode'=>200,
            //         'message' => 'Đăng nhập thành công',
            //         'data' => $taiKhoan
            //     ]);
            // });
            if (session()->get('Quyen') !== 0) {
                return redirect()->route('lichmuonphong.index');
            } else if (session()->get('Quyen') == 0) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('lichmuonphong.index');
            }
            // return 
        } catch (Throwable $e) {
            return redirect()->route('dangnhap')->with('error', 'Đăng nhập thất bại! Kiểm tra lại tài khoản hoặc mật khẩu!');
        }
    }


    public function quenMatKhau()
    {
        return view('auth.quenmatkhau');
    }

    public function dangXuat()
    {
        session()->flush();
        return redirect()->route('dangnhap');
    }

    public function doiMatKhau()
    {
        return view('auth.doimatkhau');
    }

    public function duyetDoiMatKhau(Request $request)
    {
        try {

            $maGiangVien = session()->get('MaGiangVien');
            // dd($request);
            $taiKhoan = TaiKhoan::query()
                ->where('MaGiangVien', '=', $maGiangVien)
                // ->where('MatKhau', '=', $request->post('MatKhau'))
                // ->get();
                ->firstOrFail();
            // dd($taiKhoan);
            if (!Hash::check($request->post('MatKhau'), $taiKhoan->MatKhau)) {
                throw new Exception("Sai mật khẩu");
            }
            return redirect()->route('thaydoimatkhau');
        } catch (Throwable $e) {
            return redirect()->route('dangnhap')->with('error', 'Xác minh mật khẩu thất bại! Vui lòng đăng nhập lại!');
        }
    }

    public function thayDoiMatKhau()
    {
        return view('auth.thaydoimatkhau');
    }

    public function xacNhanDoiMatKhau(ChangePasswordRequest $request)
    {
        $maGiangVien = session()->get('MaGiangVien');
        $matKhau = $request->post('MatKhau');

        TaiKhoan::where('MaGiangVien', '=', $maGiangVien)->update(['MatKhau' => Hash::make($matKhau)]);
        session()->flush();
        return redirect()->route('dangnhap')->with('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại!');
    }
}
