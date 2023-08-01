<?php
session_start();
require_once '../admin/connect.php';

if (isset($_SESSION) && !empty($_SESSION['account']) && $_SESSION['account']['role_id'] == 2) {
    $row = $_SESSION['account'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isSuccess = true;

        if (!empty($_FILES['img']['name'])) {
            $img_name = $_FILES['img']['name'];
            $img_url = $_FILES['img']['tmp_name'];
            $img_size = $_FILES['img']['size'];
            $img_type = $_FILES['img']['type'];
            $targetFile = "../assets/img/" . $img_name;


            $allowedTypes = array('image/jpeg', 'image/png');
            $maxFileSize = 10000000; // 10mb

            if (in_array($img_type, $allowedTypes) && $img_size < $maxFileSize) {
                if (file_exists($targetFile)) {
                    echo 'lỗi tồn tại';
                    $isSuccess = false;
                    if ($isSuccess == false) {
                        $_SESSION['profile_type'] = 'error';
                        $_SESSION['profile_message'] = 'File đã tồn tại.';
                        header('location:../pages/profile.php?act=profile-edit');
                    }
                } else {
                    move_uploaded_file($img_url, $targetFile);
                    $sql_img = $conn->prepare("UPDATE users SET img = :img WHERE user_id = :user_id");

                    $sql_img->execute([
                        ':user_id' => $row['user_id'],
                        ':img' => $img_name,
                    ]);
                }
            } else {
                echo 'lỗi định dạng';
                $isSuccess = false;
                if ($isSuccess == false) {
                    $_SESSION['profile_type'] = 'error';
                    $_SESSION['profile_message'] = 'File < 10MB & định dạng png hoặc jpeg.';
                    header('location:../pages/profile.php?act=profile-edit');
                }
            }
        }
        echo 'ảnh chưa up';

        try {
            $fullname = $_POST['fullname'] ?? '';
            $address = $_POST['address'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $email = $_POST['email'] ?? '';
            $sql = $conn->prepare("UPDATE users SET fullname = :fullname, address = :address, phone = :phone, email = :email WHERE user_id = :user_id");
            $sql->execute(
                [
                    ':fullname' => $fullname,
                    ':address' => $address,
                    ':phone' => $phone,
                    ':email' => $email,
                    ':user_id' => $row['user_id'],
                ]
            );
            if ($isSuccess == true) {
                $_SESSION['profile_type'] = 'success';
                $_SESSION['profile_message'] = 'Thay đổi thông tin thành công.';
                header('location:../pages/profile.php?act=profile-edit');
            }
        } catch (Exception $e) {
            $_SESSION['profile_type'] = 'error';
            $_SESSION['profile_message'] = 'Thay đổi thông tin thất bại.';
            header('location:../pages/profile.php?act=profile-edit');
            echo 'lỗi:' . $e->getMessage();
        }
    } else {
        echo 'lỗi POST';
    }
} else {
    echo 'lỗi Ko session';
}
