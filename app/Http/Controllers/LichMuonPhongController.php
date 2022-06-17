<?php

namespace App\Http\Controllers;

use App\Enums\LichMuonPhongTietHoc;
use App\Models\LichMuonPhong;
use App\Http\Requests\StoreLichMuonPhongRequest;
use App\Http\Requests\UpdateLichMuonPhongRequest;
use App\Models\GiangVien;
use App\Models\Phong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class LichMuonPhongController extends Controller
{

    public function __construct()
    {
        // $this->model=(new LichMuonPhong())->query();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); // Cắt chuỗi route theo ký tự . rồi push vào arr[]
        $arr = array_map('ucfirst', $arr); // Viết hoa chữ cái đầu trong arr[]
        $tieuDe = implode(' > ', $arr); // Nối chuỗi value của arr[] vào ký tự /
        View::share('tieuDe', $tieuDe);

        $arrLichMuonPhongSoTiet = LichMuonPhongTietHoc::getArrayView();
        // dd($arrLichMuonPhongSoTiet);
        View::share('arrLichMuonPhongSoTiet', $arrLichMuonPhongSoTiet);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrGiangVien = GiangVien::query()->get();
        $arrPhong = Phong::query()->get();
        return view('lichmuonphong.index', compact('arrGiangVien', 'arrPhong'));
    }


    public function api()
    {
        return DataTables::of(LichMuonPhong::query())
            ->editColumn('TietHoc', function ($object) {
                $arrTietHoc = explode(',', $object->TietHoc);
                return LichMuonPhongTietHoc::getKeyByValue($arrTietHoc);
            })
            ->rawColumns(['GhiChu'])
            ->addColumn('btnEdit', function ($object) {
                return route('lichmuonphong.edit', $object->id);
            })
            ->addColumn('btnDestroy', function ($object) {
                return route('lichmuonphong.destroy', $object->id);
            })
            // Tìm kiếm theo TietHoc cách 2: xử lý ở backend
            ->filterColumn('TietHoc', function ($query, $keyword) {
                if ($keyword !== '0') {
                    $query->where('TietHoc', 'like', '%' . $keyword . '%');
                }
            })
            ->filterColumn('TietHoc', function ($query, $keyword) {
                if ($keyword !== '0') {
                    $query->where('TietHoc', 'like', '%' . $keyword . '%');
                }
            })
            ->filterColumn('MaGiangVien', function ($query, $keyword) {
                if ($keyword !== '0') {
                    $query->where('MaGiangVien', 'like', '%' . $keyword . '%');
                }
            })
            ->filterColumn('NgayMuon', function ($query, $keyword) {
                if ($keyword !== '0') {
                    // dd($keyword);
                    $query->where('NgayMuon', 'regexp', $keyword);
                }
            })
            ->filterColumn('MaPhong', function ($query, $keyword) {
                if ($keyword !== '0') {
                    $query->where('MaPhong', 'like', '%' . $keyword . '%');
                }
            })
            ->make(true);
        /*
        return DataTables::of(LichMuonPhong::query()->with('GiangVien'))

            ->editColumn('TietHoc', function ($object) {
                $arrTietHoc = explode(',', $object->TietHoc);
                return LichMuonPhongTietHoc::getKeyByValue($arrTietHoc);
            })
            ->addColumn('btnEdit', function ($object) {
                return route('lichmuonphong.edit', $object->MaGiangVien);
            })
            ->addColumn('btnDestroy', function ($object) {
                return route('lichmuonphong.destroy', $object->MaGiangVien);
            })
            ->filterColumn('HoTen', function($query, $keyword){
                $query->whereHas('giangvien', function($q) use ($keyword){
                    return $q->where('MaGiangvien', $keyword);
                });
            })
            ->make(true);
            */
    }

    public function apiTietHoc()
    {
        // return LichMuonPhong::query()->get(); // select *

        // Cách 1:
        // return LichMuonPhong::query()->select([
        //     'id',
        //     'TietHoc'
        // ])->get(); // select id và TietHoc

        // Cách 2:
        return LichMuonPhong::query()->get([
            'id',
            'TietHoc'
        ]); // select id và TietHoc
    }

    public function apiMaGiangVien(Request $request)
    {

        // Cách 2:
        return LichMuonPhong::query()->where('MaGiangVien', 'like', '%' . $request->get('q') . '%')->get([
            'id',
            'MaGiangVien'
        ]); // select id và MaGiangVien
    }

    public function apiNgayMuon(Request $request)
    {
        // $query=LichMuonPhong::query()->where('NgayMuon', 'like', '%' . $request->post('NgayMuon') . '%')->get(); // select id và NgayMuon
        // dd( response()->json([$query]));
        return LichMuonPhong::query()->where('NgayMuon', 'like', '%' . $request->post('NgayMuon') . '%')->get();

        /*dd( response()->json([$phong]));
        if (http_response_code() === 200) {
            // echo 'Thành công. Dữ liệu: '.$query;
            echo 1;
            // return redirect()->route('giangvien.index')->with('success', 'Đã thêm thành công');
        }else{
            echo 0;
        }
        */
    }

    public function apiTietHocSelected(Request $request)
    {
        // dd( $request->post('TietHoc'));
        $arrayTietHoc = explode(',', $request->post('TietHoc'));
        // return LichMuonPhong::query()->where('TietHoc', 'like', '%' . $request->post('TietHoc') . '%')->get();
        // return LichMuonPhong::query()->whereIn('TietHoc', $arrayTietHoc)->get();
        // return LichMuonPhong::query()->where('TietHoc', 'regexp', $arrayTietHoc, 'T[0-9]+')->get();
        return LichMuonPhong::query()->where('TietHoc', 'regexp', $arrayTietHoc)->get();
    }

    public function apiGetPhongKhaDung(Request $request)
    {
        // dd($request);
        if ($request->post('TietHoc')) {
            $arrayTietHoc = explode(',', $request->post('TietHoc'));
            $arrayTietHoc = implode('|', $arrayTietHoc);
            // dd($arrayTietHoc);
        }
        if ($request->post('NgayMuon')) {
            $valueNgayMuon = $request->post('NgayMuon');
        }
        if ($arrayTietHoc !== '' && $valueNgayMuon !== '') {
            /*  Câu lệnh query thuần
            select * 
            from phong 
            where MaPhong not in (select MaPhong 
                                  from lichmuonphong 
                                  where NgayMuon = "28-05-2022" and TietHoc REGEXP "1|2|3")
                          and TinhTrang != 1  
        */

            $query = Phong::whereNotIn(
                'MaPhong',
                function ($q) use ($valueNgayMuon, $arrayTietHoc) {
                    $q->select('MaPhong')->from('lichmuonphong')
                        ->where('NgayMuon', '=', $valueNgayMuon)
                        ->where('TietHoc', 'regexp', $arrayTietHoc);
                }
            )->where('TinhTrang', '<>', 1)->get();
            return response()->json($query, 201);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $giangVienHoatDong = DB::table('giangvien')
            ->join('taikhoan', 'giangvien.MaGiangVien', '=', 'taikhoan.MaGiangVien')
            ->where('taikhoan.Quyen', '!=', '2')
            ->get();
        return view('lichmuonphong.create', [
            'giangVienHoatDong' => $giangVienHoatDong
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLichMuonPhongRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLichMuonPhongRequest $request)
    {
        // dd($request);
        // Format $request->TietHoc từ array -> string
        $stringTietHoc = '';
        foreach ($request->TietHoc as $value) {
            $stringTietHoc = $stringTietHoc . ',' . $value;
        }
        $stringTietHoc = substr($stringTietHoc, 1);

        // Format $request->NgayMuon từ yyyy-mm-dd -> dd-mm-yyyy
        $stringNgayMuon = explode('-',  $request->NgayMuon);
        $stringNgayMuon = array_reverse($stringNgayMuon);
        $stringNgayMuon = implode('-', $stringNgayMuon);

        // Tạo mới
        $lichMuonPhong = new LichMuonPhong();
        $lichMuonPhong->fill($request->all()); // Lấy hết dữ liệu
        $lichMuonPhong->fill($request->except('_token')); // Lấy hết dữ liệu ngoại trừ thuộc tính _token
        $lichMuonPhong->setNgayMuon($stringNgayMuon);
        $lichMuonPhong->setTietHoc($stringTietHoc);
        $lichMuonPhong->setMaPhong($request->MaPhong);
        $lichMuonPhong->setMaGiangVien($request->MaGiangVien);
        // dd( response()->json([$phong]));
        $lichMuonPhong->save();
        if (http_response_code() === 200) {
            return redirect()->route('lichmuonphong.index')->with('success', 'Đã thêm thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LichMuonPhong  $lichMuonPhong
     * @return \Illuminate\Http\Response
     */
    public function show(LichMuonPhong $lichMuonPhong)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LichMuonPhong  $lichMuonPhong
     * @return \Illuminate\Http\Response
     */
    public function edit(LichMuonPhong $lichmuonphong)
    {
        // dd($lichmuonphong);
        return view('lichmuonphong.edit', [
            'each' => $lichmuonphong,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLichMuonPhongRequest  $request
     * @param  \App\Models\LichMuonPhong  $lichMuonPhong
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLichMuonPhongRequest $request, LichMuonPhong $lichmuonphong)
    {
        // dd($request);
        $stringTietHoc = '';
        foreach ($request->TietHoc as $value) {
            $stringTietHoc = $stringTietHoc . ',' . $value;
        }
        $stringTietHoc = substr($stringTietHoc, 1);

        // Format $request->NgayMuon từ yyyy-mm-dd -> dd-mm-yyyy
        $stringNgayMuon = explode('-',  $request->NgayMuon);
        $stringNgayMuon = array_reverse($stringNgayMuon);
        $stringNgayMuon = implode('-', $stringNgayMuon);

        $lichmuonphong->fill($request->all()); // Lấy hết dữ liệu
        $lichmuonphong->fill($request->except('_token')); // Lấy hết dữ liệu ngoại trừ thuộc tính _token
        $lichmuonphong->setNgayMuon($stringNgayMuon);
        $lichmuonphong->setSyncUpdate();
        $lichmuonphong->setTietHoc($stringTietHoc);
        $lichmuonphong->setMaPhong($request->MaPhong);
        $lichmuonphong->setMaGiangVien($request->MaGiangVien);
        $lichmuonphong->setGhiChu($request->GhiChu);
        // dd(response()->json([$request]));
        $lichmuonphong->save();
        return redirect()->route('lichmuonphong.index')->with('success', 'Đã sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LichMuonPhong  $lichMuonPhong
     * @return \Illuminate\Http\Response
     */
    public function destroy(LichMuonPhong $lichmuonphong)
    {
        // dd($lichmuonphong->delete());
        $lichmuonphong->delete();

        // trả về json
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = 'Bạn đã xóa thành công';

        // return response($arr, 200);

        return response()->json(null, 204);

        // return redirect()->route('lichmuonphong.index')->with('success', 'Đã xóa thành công');
    }
}
