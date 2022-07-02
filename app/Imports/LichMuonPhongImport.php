<?php

namespace App\Imports;

use App\Models\LichMuonPhong;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class LichMuonPhongImport implements ToArray, WithHeadingRow, SkipsOnError
{
    use Importable;
    use SkipsErrors;
    
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function array(array $arrayDataExcel)
    {

        $trangThaiQuery = true;
        foreach ($arrayDataExcel as $rowData) {
            try {
                $ngayMuon = $rowData["ngay_muon"];
                $tietHoc = $rowData["tiet_hoc"];
                $maPhong = $rowData["ma_phong"];
                $maGiangVien = $rowData["ma_giang_vien"];
                $ghiChu = $rowData["ghi_chu"];

                $arrayTietHoc = explode(',', $tietHoc);
                $arrayTietHoc = implode('|', $arrayTietHoc);

                $checkLichMuonPhongHopLe = DB::table('lichmuonphong')
                    ->where('NgayMuon', $ngayMuon)
                    ->where('TietHoc', 'regexp', $arrayTietHoc)
                    ->where('MaPhong', $maPhong)
                    // ->toSql();
                    ->first();
                if ($checkLichMuonPhongHopLe === null) {
                    try {
                        $insertLichMuonPhong = LichMuonPhong::create([
                            'NgayMuon' => $ngayMuon,
                            'TietHoc' => $tietHoc,
                            'MaPhong' => $maPhong,
                            'MaGiangVien' => $maGiangVien,
                            'GhiChu' => $ghiChu,
                            'Sync' => 0
                        ]);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        $trangThaiQuery = false;
                    }
                } else {
                    $trangThaiQuery = false;
                    // dd($trangThaiQuery);
                }
            } catch (\Throwable $e) {
                dd($e);
            }
        }

        if ($trangThaiQuery === true) {
            return response()->json("Thêm thành công", 201);
        } 
        else {
            dd("Lỗi khi thêm");
        }

        // return view('lichmuonphong.previewFileExcel', [
        //     'dataFileExcel' => $array
        // ]);
        // dd($array);
        // return redirect()->route('lichmuonphong.previewFileExcel', array($arrayDataExcel));
    }

    public function onError(Throwable $e)
    {
        
    }
}
