<?php
include 'connect.php';
$sql = "SELECT * FROM giangvien gv, taikhoan tk WHERE gv.MaGiangVien=tk.MaGiangVien and Quyen=0 ORDER BY RAND() LIMIT 1";
$result = mysqli_query($conn, $sql);
$data = array();
if ($result->num_rows > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $dataArray['MaGiangVien'] = $row['MaGiangVien'];
        $dataArray['HoTen'] = $row['HoTen'];
        $dataArray['Email'] = $row['Email'];
        $dataArray['SDT'] = $row['SDT'];
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
