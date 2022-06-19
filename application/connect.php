<?php 
$servername = "us-cdbr-east-05.cleardb.net";
$database = "heroku_82d1fe0733f17ad";
$username = "bbfec1379cec72";
$password = "1b12596a";
$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($conn, 'UTF8');