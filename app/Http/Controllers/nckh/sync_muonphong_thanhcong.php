<?php

namespace App\Http\Controllers\nckh;

use App\Http\Controllers\Controller;

class sync_muonphong_thanhcong extends Controller
{
    public function sync_muonphong_thanhcong()
    {
        require_once(app_path() . '/Http/Controllers/nckh/connect.php');
        if (isset($_GET["maGiangVien"]) && isset($_GET["id"])) {
            $maGiangVien = $_GET["maGiangVien"];
            $id = $_GET["id"];

            $sql = "UPDATE lichmuonphong SET Sync=0 WHERE id='$id' and MaGiangVien='$maGiangVien'";
            if ($result = mysqli_query($conn, $sql)) {
                return '{"status": "200","maphong":' . '"' . $value["MaPhong"] . '"}';
            } else {
                return '{"status": "error","id":' . '"' . $value["id"] . '"}';
            }
        } else {
            return '{"status":"error"}';
        }
        $conn->close();
    }
}
