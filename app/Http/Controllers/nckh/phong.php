<?php

namespace App\Http\Controllers\nckh;

use App\Http\Controllers\Controller;

class phong extends Controller
{
    public function phong()
    {
        require_once(app_path() . '/Http/Controllers/nckh/connect.php');
        $sql = "SELECT * FROM phong";
        $result = mysqli_query($conn, $sql);
        $data = array();
        if ($result->num_rows > 0) {
            // Load dữ liệu lên website
            while ($row = mysqli_fetch_assoc($result)) {
                $dataArray['MaPhong'] = $row['MaPhong'];
                $dataArray['TenPhong'] = $row['TenPhong'];
                $dataArray['SoMay'] = $row['SoMay'];
                $dataArray['TinhTrang'] = $row['TinhTrang'];
                $dataArray['GhiChu'] = $row['GhiChu'];

                $data[] = $dataArray;
            }
            return '{"status":"200","data":' . json_encode($data, JSON_UNESCAPED_UNICODE) . '}';
        } else {
            return '{"status":"204"}';
        }

        $conn->close();
    }
}
