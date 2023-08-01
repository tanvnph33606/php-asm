


<?php
session_start();
require_once '../admin/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['account'])) {
    $productId = $_POST['product_id'];

    // Xóa sản phẩm từ giỏ hàng
    $sql_delete = $conn->prepare("DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id");
    $sql_delete->execute([
        ':product_id' => $productId,
        ':user_id' => $_SESSION['account']['user_id']
    ]);

    echo "Xóa thành công";
    // header('Location: ../pages/home.php');
} else {
    echo  "Không thành công";
}
?>