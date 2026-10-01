<?php
$host   = 'localhost';   
$dbUser = 'root';
$dbPass = '';             
$dbName = 'raffle_db';

$conn = mysqli_connect($host, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die('فشل الاتصال بقاعدة البيانات: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');
?>