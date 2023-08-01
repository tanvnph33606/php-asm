<?php

require_once 'connect.php';




// Lấy giá trị từ biểu mẫu
$pro_name = $_POST['pro_name'];
$pro_price_old = $_POST['price_old'];
$pro_price_new = $_POST['price_new'];
$pro_detail = $_POST['detail'];


try {
    $sql = $conn->prepare("INSERT INTO product (pro_name, price_old, price_new, detail) VALUES (:pro_name, :price_old, :price_new, :detail)");

    $sql->execute([
        ':pro_name' => $pro_name,
        ':price_old' => $pro_price_old,
        ':price_new' => $pro_price_new,
        ':detail' => $pro_detail
    ]);

    echo 'Thêm thành công!';
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
