<?php
include 'connect.php';
$sql = "SELECT * FROM muonphong where Sync = 1";
$result = mysqli_query($conn, $sql);
$data = array();
if ($result->num_rows > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $dataArray['ID'] = $row['ID'];
        $dataArray['MaGiangVien'] = $row['MaGiangVien'];
        $dataArray['NgayMuon'] = $row['NgayMuon'];
        $dataArray['TietHoc'] = $row['TietHoc'];
        $dataArray['MaPhong'] = $row['MaPhong'];
        $dataArray['GhiChu'] = $row['GhiChu'];
        $dataArray['Sync'] = $row['Sync'];
        $data[] = $dataArray;
    }
    echo '{"status":"200","soluong":"' . mysqli_num_rows($result) . '","muonphong":' . json_encode($data, JSON_UNESCAPED_UNICODE) . '}';
}
else
{
      echo '{"status":"204"}';

}

$conn->close();
?>
