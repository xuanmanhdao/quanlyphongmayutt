<?php
    require_once 'connect.php';
    $IDTK = $_POST['idtk'] ?? '';
    $MatKhau = $_POST['pass'] ?? '';


    $trangthai = array();
    $trangthai = ['StatusCode' => '400','Message' => 'Sửa không thành công'];

    if($IDTK == '' || $MatKhau == ''  )
    {
        $trangthai = ['StatusCode' => '401','Message' => 'Chưa nhập đủ dữ liệu'];
        echo json_encode($trangthai);  
    }
    else
    {
        $hash = password_hash($MatKhau, PASSWORD_BCRYPT);
        $sqls = "UPDATE `taikhoan` SET `MatKhau`='". $hash."' WHERE MaGiangVien = '". $IDTK ."'";   
        if($conn->query($sqls) === true)
        {
            $trangthai = ['StatusCode' => '200','Message' => 'Update thành công'];
            echo json_encode($trangthai);
        }
        else
        {
            echo json_encode($trangthai);  
        }
    }


   
?>