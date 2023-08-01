<?php

require_once 'connect.php';



// Lấy giá trị từ biểu mẫu hoặc từ nguồn dữ liệu khác
$pro_id = $_POST['pro_id'];
$pro_name = $_POST['pro_name'];
$pro_price_old = $_POST['price_old'];
$pro_price_new = $_POST['price_new'];
$pro_detail = $_POST['detail'];

// Câu lệnh UPDATE
$sql = "UPDATE product SET pro_name = :pro_name, price_old = :price_old, price_new = :price_new, detail = :detail WHERE pro_id = :pro_id";

try {
    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare($sql);

    // Truyền giá trị vào câu lệnh UPDATE
    $stmt->execute([
        ':pro_name' => $pro_name,
        ':price_old' => $pro_price_old,
        ':price_new' => $pro_price_new,
        ':detail' => $pro_detail,
        ':pro_id' => $pro_id
    ]);

    echo 'Cập nhật thành công!';
} catch (PDOException $e) {
    echo 'Lỗi: ' . $e->getMessage();
}

$sql = "UPDATE users SET name=?, surname=?, sex=? WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $surname, $sex, $id]);
