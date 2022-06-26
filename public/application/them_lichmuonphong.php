<?php
include 'connect.php';
if(isset( $_POST["them_muonphong"])){
$content = $_POST["them_muonphong"];

$json = json_decode($content, true);

 foreach ($json as $key => $value)
{
    $maGv = $value["maGiangVien"];
     $date = new DateTime($value["ngayMuon"]);
    $ngayMuon =$date->format("d-m-Y");
    $tietHoc = $value["tietHoc"];
    $maPhong = $value["maPhong"];
    $ghiChu = $value["ghiChu"];
    $sync = $value["sync"];
    
    $sql = "INSERT INTO `lichmuonphong` ( `NgayMuon`, `TietHoc`, `MaPhong`, `MaGiangVien`, `Sync`, `GhiChu`) VALUES ( '" . $ngayMuon . "', '" . $tietHoc . "', '" .$maPhong  . "', '" . $maGv . "', '" . $sync . "', '" . $ghiChu . "');";
    if ($result = mysqli_query($conn, $sql))
    {
        echo '{"status": "200","maphong":"' . $maPhong . '"}';
    }
    else
    {
        echo '{"status": "error","id":"' . $value["id"] . '"}';
    }
  }
}
$conn->close();
?>
