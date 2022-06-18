<?php

namespace App\Http\Controllers\nckh;

use App\Http\Controllers\Controller;

class SendEmail extends Controller
{
    public function SendEmail()
    {
        require_once(app_path() . '/Http/Controllers/nckh/connect.php');
        $trangthai = array();
        $mangTaiKhoan = array();
        $trangthai = ['TaiKhoan' => $mangTaiKhoan, 'StatusCode' => '400', 'Message' => 'Thông tin tài khoản không đúng'];
        $taikhoan = $_POST['taikhoan'] ?? '';

        //$taikhoan = 'MAGH01';

        $taikhoan = strip_tags($taikhoan);
        $taikhoan = addslashes($taikhoan);

        if ($taikhoan == '') {
            $trangthai = ['TaiKhoan' => $mangTaiKhoan, 'StatusCode' => '401', 'Message' => 'Thông tin tài khoản chưa có'];
            return json_encode($trangthai);
        } else {
            $sql = "SELECT gv.MaGiangVien , gv.HoTen , tk.MatKhau,gv.Email FROM giangvien gv ,taikhoan tk WHERE tk.MaGiangVien = gv.MaGiangVien and tk.MaGiangVien = '" . $taikhoan . "'";
            $result = mysqli_query($conn, $sql);
            $each = mysqli_num_rows($result);
            if ($each > 0) {
                // class TaiKhoan
                // {
                //     public function TaiKhoan($MaGV, $PassWord, $TenGV, $Email)
                //     {
                //         $this->MaGV = $MaGV;
                //         $this->PassWord = $PassWord;
                //         $this->TenGV = $TenGV;
                //         $this->Email = $Email;
                //     }
                // }

                $row = mysqli_fetch_assoc($result);
                $Email  = $row['Email'];
                $msg = "Chào bạn " . $row['HoTen'] . " chúng tôi là admin của ứng dụng Quản lý lịch đặt phòng UTT \n Tài khoản là " . $row['MaGiangVien'] . " và mật khẩu là : " . $row['MatKhau'] . "";
                $trangthai = ['StatusCode' => '200', 'Message' => 'Truy cập thành công'];
                $msg = wordwrap($msg, 70);
                mail($Email, "My subject", $msg);
                // echo $msg;
                // echo $Email;
                return json_encode($trangthai);
            } else {
                $trangthai = ['TaiKhoan' => $mangTaiKhoan, 'StatusCode' => '401', 'Message' => 'Thông tin tài khoản chưa có'];
                return json_encode($trangthai);
            }
        }
    }
}
