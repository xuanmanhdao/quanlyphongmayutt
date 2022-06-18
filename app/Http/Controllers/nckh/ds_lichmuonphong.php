<?php

namespace App\Http\Controllers\nckh;

use App\Http\Controllers\Controller;
use DateTime;

class ds_lichmuonphong extends Controller
{
    public function ds_lichmuonphong()
    {
        require_once(app_path() . '/Http/Controllers/nckh/connect.php');
        // include_once(app_path() . '\Http\Controllers\nckh\connect.php');
        $sql = "SELECT * FROM lichmuonphong";
        $result = mysqli_query($conn, $sql);
        $data = array();
        $sl = 0;
        function isdate($date)
        {
            $now = new DateTime();
            $year = $now->format('Y');
            if ($now->format('m') < 8) { //trc tháng 8 năm học cũ
                $dateStart = new DateTime('01-8-' . ($year - 1));
                $dateEnd = new DateTime('01-8-' . $year);
                if ($date >= $dateStart && $dateEnd >= $date) {
                    return true;
                }
            } else { //sang tháng 8 năm học mới
                $dateStart = new DateTime('01-8-' . $year);
                $dateEnd = new DateTime('01-8-' . ($year + 1));
                if ($date >= $dateStart && $dateEnd >= $date) {
                    return true;
                }
            }
            return false;
        }
        $conn->close();
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $datesql = new DateTime($row['NgayMuon']);

                if (isdate($datesql) === true) {
                    $sl++;
                    $dataArray['ID'] = $row['id'];
                    $dataArray['MaGiangVien'] = $row['MaGiangVien'];
                    $dataArray['NgayMuon'] = $row['NgayMuon'];
                    $dataArray['TietHoc'] = $row['TietHoc'];
                    $dataArray['MaPhong'] = $row['MaPhong'];
                    $dataArray['GhiChu'] = $row['GhiChu'];
                    $dataArray['Sync'] = $row['Sync'];
                    $data[] = $dataArray;
                } else {
                    break;
                    echo '{"status":"204"}';
                }
            }
            return '{"status":"200","soluong":"' . $sl . '","data":' . json_encode($data, JSON_UNESCAPED_UNICODE) . '}';
        } else {
            return '{"status":"204"}';
        }
    }
}
