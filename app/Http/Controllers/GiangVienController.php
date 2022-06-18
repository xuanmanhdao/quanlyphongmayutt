<?php

namespace App\Http\Controllers;

use App\Models\GiangVien;
use App\Http\Requests\StoreGiangVienRequest;
use App\Http\Requests\UpdateGiangVienRequest;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class GiangVienController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); // Cắt chuỗi route theo ký tự . rồi push vào arr[]
        $arr = array_map('ucfirst', $arr); // Viết hoa chữ cái đầu trong arr[]
        $tieuDe = implode(' > ', $arr); // Nối chuỗi value của arr[] vào ký tự /
        View::share('tieuDe', $tieuDe);
    }

    public function index()
    {
        return view('giangvien.index');
    }

    public function api()
    {
        // // Cách 1: query builder
        //     $giangVien = GiangVien::select('giangvien.MaGiangVien','HoTen','GioiTinh','Email','SDT','taikhoan.quyen')
        //    ->leftJoin('taikhoan','giangvien.MaGiangVien','=','taikhoan.MaGiangVien')
        //    ->where('giangvien.MaGiangVien', '=' ,$giangvien->MaGiangVien)->get();

        // return DataTables::of($query)
        //     ->editColumn('GioiTinh', function ($object) {
        //         return $object->getGioiTinh();
        //     })
        //     ->addColumn('btnEdit', function ($object) {
        //         return route('giangvien.edit', $object->MaGiangVien);
        //     })
        //     ->addColumn('TinhTrang', function ($object) {
        //         return  $object->TaiKhoan->getTenQuyen();
        //     })
        //     ->addColumn('btnDestroy', function ($object) {
        //         return route('giangvien.destroy', $object->MaGiangVien);
        //     })
        //     ->make(true);

        // Cách 2: GiangVien::query()->with('TaiKhoan')
        return DataTables::of(GiangVien::query()->with('TaiKhoan'))
            ->editColumn('GioiTinh', function ($object) {
                return $object->getGioiTinh();
            })
            ->addColumn('btnEdit', function ($object) {
                return route('giangvien.edit', $object->MaGiangVien);
            })
            ->addColumn('TinhTrang', function ($object) {
                return  $object->TaiKhoan->getTenQuyen();
            })
            ->addColumn('btnDestroy', function ($object) {
                return route('giangvien.destroy', $object->MaGiangVien);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('giangvien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGiangVienRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGiangVienRequest $request)
    {
        $giangVien = new GiangVien();
        $giangVien->fill($request->all()); // Lấy hết dữ liệu
        $giangVien->fill($request->except('_token')); // Lấy hết dữ liệu ngoại trừ thuộc tính _token
        // dd( response()->json([$phong]));
        $giangVien->save();
        if (http_response_code() === 200) {
            // $taiKhoan=new TaiKhoan();
            // $taiKhoan->fill($request->all());
            // $taiKhoan->save();
            // dd($taiKhoan);

            // TaiKhoan::create($request->only('MaGiangVien'));

            // $maGiangVien = $request->post('MaGiangVien');
            // $matKhauMacDinh = '123456';
            // TaiKhoan::create([
            //     'MaGiangVien' => $maGiangVien,
            //     'MatKhau' => Hash::make($matKhauMacDinh),
            // ]);

            return redirect()->route('giangvien.index')->with('success', 'Đã thêm thành công');
        }



        // Phong::create($request->validated());
        // Điều hướng

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function show(GiangVien $giangVien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */

    public function edit(GiangVien $giangvien)
    {
        // Chưa select quyen
        // return view('giangvien.edit', [
        //     'each' => $giangvien,
        // ]);

        // Đã select quyền
        // Cách 1: query builder
        //     $giangVien = GiangVien::select('giangvien.MaGiangVien','HoTen','GioiTinh','Email','SDT','taikhoan.quyen')
        //    ->leftJoin('taikhoan','giangvien.MaGiangVien','=','taikhoan.MaGiangVien')
        //    ->where('giangvien.MaGiangVien', '=' ,$giangvien->MaGiangVien)->get();

        // Cách 2:
        $quyen = TaiKhoan::find($giangvien->MaGiangVien, ['quyen']);
        // $taiKhoan=TaiKhoan::find($giangvien->MaGiangVien);
        // dd($taiKhoan);
        return view('giangvien.edit', [
            'each' => $giangvien,
            // 'taiKhoan' => $taiKhoan
            'quyenTaiKhoan' => $quyen
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGiangVienRequest  $request
     * @param  \App\Models\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGiangVienRequest $request, GiangVien $giangvien)
    {
        // dd($request);
        if ($request->MaGiangVien == "superadmin") {
            return redirect()->route('giangvien.index')->with('error', 'Tài khoản root không thể sửa');;
        }
        $giangvien->fill($request->all()); // Lấy hết dữ liệu
        $giangvien->fill($request->except('_token')); // Lấy hết dữ liệu ngoại trừ thuộc tính _token

        // dd(response()->json([$request]));
        $giangvien->save();
        if (http_response_code() === 200) {
            TaiKhoan::where('MaGiangVien', $request->MaGiangVien)->update(['Quyen' => $request->Quyen]);;
            // dd($taiKhoan);
            return redirect()->route('giangvien.index')->with('success', 'Đã sửa thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiangVien $giangvien)
    {
        $giangvien->delete();

        // return redirect()->route('classrooms.index');

        // trả về json
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = 'Bạn đã xóa thành công';

        return response($arr, 200);
    }
}
