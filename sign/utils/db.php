<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password,$dbname);
// 检测连接
if ($conn->connect_error) {
die("连接失败: " . $conn->connect_error);
 }
?>