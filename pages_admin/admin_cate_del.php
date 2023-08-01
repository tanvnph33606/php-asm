
<?php
require_once '../admin/connect.php';

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Lấy thông tin ảnh của danh mục từ cơ sở dữ liệu
    $sql = $conn->prepare("SELECT category_img FROM category WHERE category_id = :category_id");
    $sql->execute([':category_id' => $category_id]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $img_name = $row['category_img'];


    // Xóa danh mục khỏi cơ sở dữ liệu
    $sql = $conn->prepare("DELETE FROM category WHERE category_id = :category_id");
    $sql->execute([':category_id' => $category_id]);

    // Xóa ảnh danh mục khỏi thư mục (nếu có)
    if (!empty($img_name)) {
        $img_path = "../assets/img/" . $img_name;
        if (file_exists($img_path)) {
            unlink($img_path);
        }
    }

    header("Location: ./index.php?act=category");
    exit();
} else {
    echo '<script>
    Swal.fire({
    icon: "error",
    title: "Lỗi!",
    text: "Không có id danh mục để xóa.",
    });
    </script>';
    header("Location: ./index.php?act=category");
    exit();
}
?>