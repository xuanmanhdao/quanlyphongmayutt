<?php

namespace App\Http\Controllers\nckh;

use App\Http\Controllers\Controller;

class them_lichmuonphong extends Controller
{
    public function them_lichmuonphong()
    {
        require_once(app_path() . '/Http/Controllers/nckh/connect.php');
        if (isset($_POST["them_muonphong"])) {
            $content = $_POST["them_muonphong"];

            $json = json_decode($content, true);

            foreach ($json as $key => $value) {
                $maGv = $value["maGiangVien"];
                $ngayMuon = $value["ngayMuon"];
                $tietHoc = $value["tietHoc"];
                $maPhong = $value["maPhong"];
                $ghiChu = $value["ghiChu"];
                $sync = $value["sync"];

                $sql = "INSERT INTO `lichmuonphong` ( `NgayMuon`, `TietHoc`, `MaPhong`, `MaGiangVien`, `Sync`, `GhiChu`) VALUES ( '" . $ngayMuon . "', '" . $tietHoc . "', '" . $maPhong  . "', '" . $maGv . "', '" . $sync . "', '" . $ghiChu . "');";
                if ($result = mysqli_query($conn, $sql)) {
                    return '{"status": "200","maphong":"' . $maPhong . '"}';
                } else {
                    return '{"status": "error","id":"' . $value["id"] . '"}';
                }
            }
        }
        $conn->close();
    }
}
