<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GiangVien;
use App\Models\TaiKhoan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthControllerAPI extends Controller
{
    public function duyetDangNhap(Request $request)
    {
        try {

            $maGiangVien = $request->post('MaGiangVien');
            $matKhau = $request->post('MatKhau');

            $taiKhoan = TaiKhoan::query()
                ->where('MaGiangVien', '=', $maGiangVien)
                ->firstOrFail();

            if (!Hash::check($matKhau, $taiKhoan->MatKhau)) {
                throw new Exception("Sai mật khẩu");
            }

            $giangVien = GiangVien::query()
                ->where('MaGiangVien', '=', $maGiangVien)
                ->get();

            return response()->json(
                [
                    'success' => true,
                    'statusCode' => 200,
                    'message' => 'Đăng nhập thành công',
                    'data' => $giangVien
                ],
                200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        } catch (Throwable $e) {
            return  response()->json([
                'success' => false,
                'statusCode' => 400,
                'message' => 'Đăng nhập thất bại. Tài khoản hoặc mật khẩu không đúng',
                // 'data'=>$request,
            ], 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function duyetDoiMatKhau(Request $request)
    {
        try {

            $maGiangVien = $request->post('MaGiangVien');
            $matKhauCu = $request->post('MatKhauCu');
            $matKhauMoi = $request->post('MatKhauMoi');

            if ($maGiangVien == '' || $matKhauCu == ''  || $matKhauMoi == '') {
                return  response()->json([
                    'success' => false,
                    'statusCode' => 401,
                    'message' => 'Chưa nhập đủ dữ liệu',
                ], 401, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            $taiKhoan = TaiKhoan::query()
                ->where('MaGiangVien', '=', $maGiangVien)
                ->firstOrFail();

            if (!Hash::check($matKhauCu, $taiKhoan->MatKhau)) {
                throw new Exception("Sai mật khẩu");
            } else {
                $query = TaiKhoan::where('MaGiangVien', '=', $maGiangVien)->update(['MatKhau' => Hash::make($matKhauMoi)]);
                if ($query) {
                    return response()->json(
                        [
                            'success' => true,
                            'statusCode' => 200,
                            'message' => 'Đổi mật khẩu thành công',
                        ],
                        200,
                        ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE
                    );
                } else {
                    return  response()->json([
                        'success' => false,
                        'statusCode' => 400,
                        'message' => 'Đổi mật khẩu thất bại',
                    ], 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
                }
            }
        } catch (Throwable $e) {
            return  response()->json([
                'success' => false,
                'statusCode' => 400,
                'message' => 'Tài khoản hoặc mật khẩu sai',
                // 'data'=>$request,
            ], 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
