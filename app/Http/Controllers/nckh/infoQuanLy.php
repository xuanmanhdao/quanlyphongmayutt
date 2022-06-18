<?php

namespace App\Http\Controllers\nckh;

use App\Http\Controllers\Controller;

class infoQuanLy extends Controller
{
    public function infoQuanLy()
    {
        require_once(app_path() . '/Http/Controllers/nckh/connect.php');
        $sql = "SELECT * FROM giangvien gv, taikhoan tk WHERE gv.MaGiangVien=tk.MaGiangVien and Quyen=0 ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $dataArray['MaGiangVien'] = $row['MaGiangVien'];
                $dataArray['HoTen'] = $row['HoTen'];
                $dataArray['Email'] = $row['Email'];
                $dataArray['SDT'] = $row['SDT'];
                $data[] = $dataArray;
            }
            return '{"status":"200","data":' . json_encode($data, JSON_UNESCAPED_UNICODE) . '}';
        } else {
            return '{"status":"204"}';
        }

        $conn->close();
    }
}
