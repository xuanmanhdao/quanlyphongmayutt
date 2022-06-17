<?php
  include 'connect.php';
    $trangthai = array();
    $mangTaiKhoan = array();
    $trangthai = ['TaiKhoan' => $mangTaiKhoan,'StatusCode' => '400','Message' => 'Thông tin tài khoản không đúng'];
  
    $taikhoan =$_POST['taikhoan'] ?? '';
    $pass = $_POST['pass'] ?? '';

    // $taikhoan = 'GV01';
    // $pass = '1';

    $taikhoan = strip_tags($taikhoan);
    $taikhoan = addslashes($taikhoan);
    $pass = strip_tags($pass);
    $pass = addslashes($pass);
    if($taikhoan == '' || $pass == '')
    {
        $trangthai = ['TaiKhoan' => $mangTaiKhoan,'StatusCode' => '401','Message' => 'Thông tin tài khoản chưa có'];
        echo json_encode($trangthai);   
    }
    else{        
        $sql = "SELECT * FROM taikhoan, giangvien  WHERE giangvien.MaGiangVien = taikhoan.MaGiangVien and taikhoan.MaGiangVien = '". $taikhoan."' and taikhoan.MatKhau = '".$pass."'";
        $result = mysqli_query($conn, $sql);
        $each=mysqli_num_rows($result);
        if($each > 0 )
        {
            class TaiKhoan
            {
                public function TaiKhoan($MaGV,$PassWord,$Quyen,$TenGV,$SDT,$Email)
                {
                    $this->MaGV = $MaGV;
                    $this->PassWord = $PassWord;
                    $this->Quyen = $Quyen;
                    $this->TenGV = $TenGV;
                    $this->SDT = $SDT;
                    $this->Email = $Email;
                }
            }   
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($mangTaiKhoan, new TaiKhoan($row['MaGiangVien'],$row['MatKhau'], $row['Quyen'],$row['HoTen'],$row['SDT'],$row['Email']));
            }
            $trangthai = ['StatusCode' => '200','Message' => 'Truy cập thành công','Data'=> $mangTaiKhoan];
            echo json_encode($trangthai);
        }
        else
        {
            $trangthai = ['TaiKhoan' => $mangTaiKhoan,'StatusCode' => '401','Message' => 'Thông tin tài khoản chưa có'];
            echo json_encode($trangthai);
        }
    }

   
?>