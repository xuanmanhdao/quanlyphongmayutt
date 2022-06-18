<?php
    require_once 'connect.php';
    $IDTK = $_POST['idtk'] ?? '';
    $MatKhau = $_POST['pass'] ?? '';


    $trangthai = array();
    $trangthai = ['StatusCode' => '400','Message' => 'Thêm không thành công'];

    if($IDTK == '' || $MatKhau == ''  )
    {
        $trangthai = ['StatusCode' => '401','Message' => 'Chưa nhập đủ dữ liệu'];
        echo json_encode($trangthai);  
    }
    else
    {
        $sqls = "UPDATE `taikhoan` SET `MatKhau`='". $MatKhau."' WHERE MaGiangVien = '". $IDTK ."'";   
        if($conn->query($sqls) === true)
        {
            $trangthai = ['StatusCode' => '200','Message' => 'Update thành công'];
            return json_encode($trangthai);
        }
        else
        {
            return json_encode($trangthai);  
        }
    }


   
?>