<?php


function db(){
	// File: db.php
$servername = "localhost";
$username = "roots";
$password = "20112023";
$dbname = "quanlybanhang";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);
	return  $conn;
}
$kn= db();
// Kiểm tra kết nối
if ($kn->connect_error) {
    die("Connection failed: " . $kn->connect_error);
}
?>