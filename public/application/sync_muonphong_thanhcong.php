<?php
include 'connect.php';
if (isset($_GET["id"]))
{
    $id = $_GET["id"];
    
    $sql = "UPDATE lichmuonphong SET Sync= 0 WHERE  ID='$id'";
        if ($result = mysqli_query($conn, $sql))
    {
        echo '{"status": "200"}';
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
