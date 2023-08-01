<?php
session_start();
require_once '../admin/connect.php';
(isset($_GET['id'])) ? $id_pro = $_GET['id'] : $id_pro = '';

if (isset($_SESSION['account']) && $_SESSION['account']['role_id'] == 2) {

    $user = $_SESSION['account'];

    // lấy dữ liệu của product
    $sql_pro = $conn->prepare("SELECT * FROM product WHERE product_id = :id");
    $sql_pro->execute(
        [
            ':id' => $id_pro,
        ]
    );
    // dữ liệu ở đây
    $row_pro = $sql_pro->fetch(PDO::FETCH_ASSOC);

    // lấy ra giá và số lượng còn trong kho
    $sql_pro_price = $row_pro['product_price_new'];


    //lấy dữ liệu của cart
    $sql_cart = $conn->prepare("SELECT * FROM cart WHERE product_id = :id AND user_id = :user_id");
    $sql_cart->execute(
        [
            ':id' => $row_pro['product_id'],
            ':user_id' => $user['user_id'],
        ]
    );
    $row_cart = $sql_cart->fetchAll(PDO::FETCH_ASSOC);

    //kiểm tra có sản phẩm có trong giỏ hàng hay chưa chưa có thì thêm còn có thì +1
    if (!empty($row_cart)) {
        $sql_up_cart = $conn->prepare("UPDATE cart SET quantity = quantity + 1 , cart_price = :cart_price WHERE product_id = :id AND user_id = :user_id");
        $sql_up_cart->execute(
            [
                ':id' => $row_pro['product_id'],
                ':user_id' => $user['user_id'],
                ':cart_price' => $sql_pro_price,
            ]
        );
        $_SESSION['cart_message'] = 'Thêm sản phẩm thành công.';
    } else {
        $sql_add_cart = $conn->prepare("INSERT INTO cart (product_id , user_id, quantity, cart_img, cart_name, cart_price) VALUES (:id, :user_id, 1, :cart_img, :cart_name, :cart_price)");
        $sql_add_cart->execute(
            [
                ':id' => $row_pro['product_id'],
                ':user_id' => $user['user_id'],
                ':cart_img' => $row_pro['product_img'],
                ':cart_name' => $row_pro['product_name'],
                ':cart_price' => $sql_pro_price,

            ]
        );
        $_SESSION['cart_message'] = 'Thêm sản phẩm thành công.';
    }

    //về trang chi tiết sản phẩm
    header('location:../pages/detail-product.php?act=product_detail&id=' . $row_pro['product_id']);
} else {
    header('location:../pages/login.php');
}
