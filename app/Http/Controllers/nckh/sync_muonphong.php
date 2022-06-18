<?php

namespace App\Http\Controllers\nckh;

use App\Http\Controllers\Controller;

class sync_muonphong extends Controller
{
    public function sync_muonphong()
    {
        require_once(app_path() . '/Http/Controllers/nckh/connect.php');
        $sql = "SELECT * FROM lichmuonphong where Sync = 1";
        $result = mysqli_query($conn, $sql);
        // dd($result->num_rows);
        $data = array();
        if ($result !== false && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $dataArray['ID'] = $row['id'];
                $dataArray['MaGiangVien'] = $row['MaGiangVien'];
                $dataArray['NgayMuon'] = $row['NgayMuon'];
                $dataArray['TietHoc'] = $row['TietHoc'];
                $dataArray['MaPhong'] = $row['MaPhong'];
                $dataArray['GhiChu'] = $row['GhiChu'];
                $dataArray['Sync'] = $row['Sync'];
                $data[] = $dataArray;
            }
            return '{"status":"200","soluong":"' . mysqli_num_rows($result) . '","muonphong":' . json_encode($data, JSON_UNESCAPED_UNICODE) . '}';
        } else {
            return '{"status":"204"}';
        }

        $conn->close();
    }
}
