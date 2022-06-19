<?php
include 'connect.php';
$sql = "SELECT * FROM phong";
$result = mysqli_query($conn, $sql);
$data = array();
if ($result->num_rows > 0)
{
    // Load dữ liệu lên website
    while ($row = mysqli_fetch_assoc($result))
    {
        $dataArray['MaPhong'] = $row['MaPhong'];
        $dataArray['TenPhong'] = $row['TenPhong'];
        $dataArray['SoMay'] = $row['SoMay'];
        $dataArray['TinhTrang'] = $row['TinhTrang'];
        $dataArray['GhiChu'] = $row['GhiChu'];

        $data[] = $dataArray;
    }
    echo '{"status":"200","data":' . json_encode($data, JSON_UNESCAPED_UNICODE) . '}';
}
else
{
    echo '{"status":"204"}';
}

$conn->close();
?>
