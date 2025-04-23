<?php


function db(){
	// File: db.php
$servername = "localhost";
$username = "roots";
$password = "20112023";
$dbname = "quanlybanhang";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	return  $conn;
}
?>