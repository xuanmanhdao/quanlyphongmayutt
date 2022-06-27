<?php

namespace App\Http\Controllers;

use App\Enums\LichMuonPhongTietHoc;
use App\Models\LichMuonPhong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
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

    public function index()
    {
        return view('dashboard');
    }

    public function timKiemTheoNgay(Request $request)
    {
        $data = $request->all();
        $tuNgay = $data['TuNgay'];
        $denNgay = $data['DenNgay'];
        $results = array();

        // $get = LichMuonPhong::whereBetween('NgayMuon', [$tuNgay, $denNgay])->orderBy('NgayMuon', 'ASC')->get();
        // foreach ($get as $key => $val) {
        //     $chartData[] = array(
        //         'khoangThoiGian' => $val->NgayMuon,
        //         'maPhong' => $val->MaPhong,
        //         'maGiangVien' => $val->MaGiangVien,
        //         'tietHoc' => $val->TietHoc
        //     );
        // }

        $getSoLuongLichMuonPhong = DB::table('lichmuonphong')
            ->select(DB::raw('COUNT(*) as SoLuongLichMuonPhong, NgayMuon'))
            ->whereBetween(DB::raw("STR_TO_DATE(NgayMuon, '%d-%m-%Y')"), [DB::raw("STR_TO_DATE('$tuNgay', '%d-%m-%Y')"), DB::raw("STR_TO_DATE('$denNgay', '%d-%m-%Y')")])
            ->groupBy('NgayMuon')
            ->orderBy(DB::raw("STR_TO_DATE(NgayMuon, '%d-%m-%Y')"), 'asc')
            ->get();
        foreach ($getSoLuongLichMuonPhong as $key => $val) {
            $chartDataSoLuongLichMuonPhong[] = array(
                'khoangThoiGian' => $val->NgayMuon,
                'soLuongLichMuonPhong' => $val->SoLuongLichMuonPhong
            );
        }

        $getSoLuotGiangVienMuonPhong = DB::table('lichmuonphong')
            ->select(DB::raw('MaGiangVien, NgayMuon, COUNT(*) as SoLanGiangVienMuon'))
            ->whereBetween(DB::raw("STR_TO_DATE(NgayMuon, '%d-%m-%Y')"), [DB::raw("STR_TO_DATE('$tuNgay', '%d-%m-%Y')"), DB::raw("STR_TO_DATE('$denNgay', '%d-%m-%Y')")])
            ->groupBy('NgayMuon', 'MaGiangVien')
            ->orderBy(DB::raw("STR_TO_DATE(NgayMuon, '%d-%m-%Y')"), 'asc')
            ->get();
            // ->toSql();
            // dd($getSoLuotGiangVienMuonPhong);
        foreach ($getSoLuotGiangVienMuonPhong as $key => $val) {
            $chartDataSoLuotGiangVienMuonPhong[] = array(
                'khoangThoiGian' => $val->NgayMuon,
                'maGiangVien' => $val->MaGiangVien,
                'soLanGiangVienMuon' => $val->SoLanGiangVienMuon
            );
        }


        $subQueryToSQL = DB::table('lichmuonphong')
            ->select(DB::raw('MaGiangVien, NgayMuon, COUNT(*) as SoLanGiangVienMuon'))
            ->whereBetween(DB::raw("STR_TO_DATE(NgayMuon, '%d-%m-%Y')"), [DB::raw("STR_TO_DATE('$tuNgay', '%d-%m-%Y')"), DB::raw("STR_TO_DATE('$denNgay', '%d-%m-%Y')")])
            ->groupBy('NgayMuon', 'MaGiangVien')
            ->orderBy(DB::raw("STR_TO_DATE(NgayMuon, '%d-%m-%Y')"), 'asc');

        $getSoLuongGiangVienMuon = DB::table(DB::raw("({$subQueryToSQL->toSql()}) as sub"))
            ->select(DB::raw('COUNT(sub.MaGiangVien) as SoGiangVien,sub.NgayMuon'))
            ->mergeBindings($subQueryToSQL) // you need to get underlying Query Builder
            ->groupBy('sub.NgayMuon')
            ->orderBy(DB::raw("STR_TO_DATE(sub.NgayMuon, '%d-%m-%Y')"), 'asc')
            // // print $getSoLuongGiangVienMuon->toSql();
            ->get();
           
        foreach ($getSoLuongGiangVienMuon as $key => $val) {
            $chartDataSoLuongGiangVienMuon[] = array(
                'khoangThoiGian' => $val->NgayMuon,
                'soGiangVienMuon' => $val->SoGiangVien,
            );
        }

        // $resultsArray = array_merge_recursive($chartDataSoLuongLichMuonPhong,$chartDataSoLuongGiangVienMuon);
        // print_r($resultsArray);

        // array_map(function($a, $b) use (&$results) {

        //     $key = current(array_keys($a));
        //     $a[$key] = array('thoiGian' => $a[$key]);

        //     // Obtain the key again as the second array may have a different key.
        //     $key = current(array_keys($b));
        //     $b[$key] = array('soLichMuon' => $b[$key]);

        //     // $key = current(array_keys($c));
        //     // $c[$key] = array('soGiangVienMuon' => $c[$key]);

        //     $results += array_merge_recursive($a, $b);

        // }, $chartDataSoLuongLichMuonPhong, $chartDataSoLuongGiangVienMuon);
        // var_dump($results);

        // print_r(array_replace_recursive($chartDataSoLuongLichMuonPhong, $chartDataSoLuongGiangVienMuon));

        $results = array_replace_recursive($chartDataSoLuongLichMuonPhong, $chartDataSoLuongGiangVienMuon);

        // $results2=array_replace_recursive($results, $chartDataSoLuotGiangVienMuonPhong);

        // dd($results2);


        // dd($chartDataSoLuotGiangVienMuonPhong);


        // echo $data=json_encode($chartData);
        // return response()->json($chartDataSoLuongLichMuonPhong);
        return response()->json($results);
    }

    public function thongKeSoLanGiangVienMuon(Request $request){
        $data = $request->all();
        $tuNgay = $data['TuNgay'];
        $denNgay = $data['DenNgay'];
        $getSoLuotGiangVienMuonPhong = DB::table('lichmuonphong')
            ->select(DB::raw('MaGiangVien, NgayMuon, COUNT(*) as SoLanGiangVienMuon'))
            ->whereBetween(DB::raw("STR_TO_DATE(NgayMuon, '%d-%m-%Y')"), [DB::raw("STR_TO_DATE('$tuNgay', '%d-%m-%Y')"), DB::raw("STR_TO_DATE('$denNgay', '%d-%m-%Y')")])
            ->groupBy('NgayMuon', 'MaGiangVien')
            ->orderBy(DB::raw("STR_TO_DATE(NgayMuon, '%d-%m-%Y')"), 'asc')
            // ->paginate(2);
            ->get();
            // ->paginate(10);
            // print $getSoLuotGiangVienMuonPhong->toSql();
        foreach ($getSoLuotGiangVienMuonPhong as $key => $val) {
            $chartDataSoLuotGiangVienMuonPhong[] = array(
                'khoangThoiGian' => $val->NgayMuon,
                'maGiangVien' => $val->MaGiangVien,
                'soLanGiangVienMuon' => $val->SoLanGiangVienMuon
            );
        }

        // dd($chartDataSoLuotGiangVienMuonPhong);
        return response()->json($chartDataSoLuotGiangVienMuonPhong);
    }
}
