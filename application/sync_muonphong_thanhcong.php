<?php
include 'connect.php';
if (isset($_GET["maGiangVien"]) && isset($_GET["id"]))
{
    $maGiangVien = $_GET["maGiangVien"];
    $id = $_GET["id"];
    
    $sql = "UPDATE muonphong SET Sync=0 WHERE  ID='$id' and MaGiangVien='$maGiangVien'";
        if ($result = mysqli_query($conn, $sql))
    {
        echo '{"status": "200","maphong":' . '"' . $value["MaPhong"] . '"}';
    }
    else
    {
        echo '{"status": "error","id":' . '"' . $value["id"] . '"}';
    }
}
 else
    {
    echo '{"status":"error"}';
    }
$conn->close();
?>
