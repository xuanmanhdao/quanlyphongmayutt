<?php
$rdir = str_replace("\\", "/", __DIR__); 
require $rdir.'/PHPMailer-master/src/Exception.php';
require $rdir.'/PHPMailer-master/src/PHPMailer.php';
require $rdir.'/PHPMailer-master/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$trangthai = array();
$mangTaiKhoan = array();
$trangthai = ['TaiKhoan' => $mangTaiKhoan, 'StatusCode' => '400', 'Message' => 'Thông tin tài khoản không đúng'];
include 'connect.php';
// $taikhoan = $_POST['taikhoan'] ?? '';
$email=base64_decode($_GET['email']);
$maGiangVien=base64_decode($_GET['magiangvien']);
$token=$_GET['token'];
// echo json_encode( ['email' => $email, 'maGiangVien' => $maGiangVien, 'token' => $token]);
// die();
//$taikhoan = 'MAGH01';

// $taikhoan = strip_tags($taikhoan);
// $taikhoan = addslashes($taikhoan);

if ($maGiangVien == '' || $email=='') {
    $trangthai = ['TaiKhoan' => $mangTaiKhoan, 'StatusCode' => '401', 'Message' => 'Thông tin tài khoản chưa có'];
    echo json_encode($trangthai);
} else {
    $hash = password_hash('123456', PASSWORD_BCRYPT);
    $queryUpdate = "UPDATE `taikhoan` SET `MatKhau`='". $hash."' WHERE MaGiangVien = '". $maGiangVien ."'";  
    $result = mysqli_query($conn, $queryUpdate);

    $sql = "SELECT gv.MaGiangVien , gv.HoTen , tk.MatKhau,gv.Email FROM giangvien gv ,taikhoan tk WHERE tk.MaGiangVien = gv.MaGiangVien and tk.MaGiangVien = '" . $maGiangVien . "'";
    $result = mysqli_query($conn, $sql);
    $each = mysqli_num_rows($result);
    if ($each > 0) {
        $row = mysqli_fetch_assoc($result);
        $Email  = $row['Email'];
        class TaiKhoan
        {
            public function TaiKhoan($MaGV, $PassWord, $TenGV, $Email)
            {
                $this->MaGV = $MaGV;
                $this->PassWord = $PassWord;
                $this->TenGV = $TenGV;
                $this->Email = $Email;
            }
        }

        //Load Composer's autoloader
        // require 'vendor/autoload.php';
        // require 'PHPMailer-master/src/'

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;                      //Enable verbose debug output

            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'thongbao555@gmail.com';                     //SMTP username
            $mail->Password   = 'mlzpgezxtdfifhfo';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('thongbao555@gmail.com', 'Trường đại học Công Nghệ Giao Thông Vận Tải');

            // $mail->setFrom($Email, $row['HoTen']);
            $mail->addAddress($Email, $row['HoTen']);     //Add a recipient

            // $mail->addAddress('xuanmanhdao2001@gmail.com', 'Mạnh Bầu Trời 2');     
            // $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('thongbao555@gmail.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->WordWrap = 70;                                 // Set word wrap to 70 characters
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Thông báo thay đổi thông tin tài khoản';
            $mail->Body    = "Chào bạn <b>" . $row['HoTen'] . "</b> chúng tôi là admin của ứng dụng Quản lý lịch đặt phòng UTT <br> Tài khoản là <b>" . $row['MaGiangVien'] . "</b> và mật khẩu là : <b>123456</b>";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo 'Message has been sent';
            $trangthai = ['StatusCode' => '200', 'Message' => 'Truy cập thành công'];
            echo json_encode($trangthai);
            // echo json_encode( ['email' => $email, 'maGiangVien' => $maGiangVien, 'token' => $token]);
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $trangthai = ['TaiKhoan' => $mangTaiKhoan, 'StatusCode' => '401', 'Message' => 'Mã giảng viên không hợp lệ'];
            echo json_encode($trangthai);
        }

    } else {
        $trangthai = ['TaiKhoan' => $mangTaiKhoan, 'StatusCode' => '401', 'Message' => 'Thông tin tài khoản chưa có'];
        echo json_encode($trangthai);
    }
}
