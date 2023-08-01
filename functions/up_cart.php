<?php
session_start();
require_once '../admin/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['account'])) {
    $productId = $_POST['product_id'];
    $quantity = intval($_POST['quantity']);

    // Kiểm tra số lượng tồn kho
    // (Bạn cần thay thế các điều kiện kiểm tra số lượng tồn kho thích hợp)
    $sql_check_stock = $conn->prepare("SELECT product_quantity FROM product WHERE product_id = :product_id");
    $sql_check_stock->execute([':product_id' => $productId]);
    $stock = $sql_check_stock->fetchColumn();

    if ($quantity < 1 || $quantity > $stock) {
        echo "Hết hàng";
    } else {
        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $sql_update = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id");
        $sql_update->execute([
            ':quantity' => $quantity,
            ':product_id' => $productId,
            ':user_id' => $_SESSION['account']['user_id']
        ]);

        echo "Thành công!";
    }
} else {
    echo "unauthorized";
}
