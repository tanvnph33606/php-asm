<?php


require_once 'connect.php';


try {


    // Câu lệnh SQL DELETE
    $sql = "DELETE FROM users WHERE id = :id";

    // Chuẩn bị prepared statement
    $stmt = $conn->prepare($sql);

    // Dữ liệu bạn muốn xóa
    $stmt->execute([
        ':id' => 1
    ]);


    // Thực thi câu lệnh DELETE với dữ liệu từ mảng liên kết


    echo "Dữ liệu đã được xóa thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
