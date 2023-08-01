<?php

//Thông tin kết nối

const _HOST = 'localhost';
const _USER = 'root';
const _PASS = '';
const _DB = 'asm';



try {
    $conn = new PDO('mysql:host=' . _HOST . ';dbname=' . _DB . ';charset=utf8', _USER, _PASS);
    // echo "Kết nối  thành công!";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}


// Tạo kết nối
// $conn = new mysqli(_HOST, _USER, _PASS, _DB);

// // Kiểm tra kết nối
// if ($conn->connect_error) {
//     die("Kết nối thất bại: " . $conn->connect_error);
// }

// echo "Kết nối thành công!";
