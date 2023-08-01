
<?php
require_once '../admin/connect.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    try {
        //xóa khóa ngoại
        $sql_detail = $conn->prepare("DELETE FROM product_detail WHERE product_id = :product_id");
        $sql_detail->execute([':product_id' => $product_id]);


        $sql_thumb = $conn->prepare("DELETE FROM product_thumb WHERE product_id = :product_id");
        $sql_thumb->execute([':product_id' => $product_id]);



        // Lấy thông tin ảnh 
        $sql_img = $conn->prepare("SELECT product_img FROM product WHERE product_id = :product_id");
        $sql_img->execute([':product_id' => $product_id]);
        $row = $sql_img->fetch(PDO::FETCH_ASSOC);
        $img_name = $row['product_img'];


        // Xóa khỏi cơ sở dữ liệu
        $sql_main = $conn->prepare("DELETE FROM product WHERE product_id = :product_id");
        $sql_main->execute([':product_id' => $product_id]);

        // Xóa ảnh khỏi thư mục 
        if (!empty($img_name)) {
            $img_path = "../assets/img/" . $img_name;
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }


        header("Location: ./index.php?act=product");
        exit();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage() . $e->getFile();

        echo '<script>
        Swal.fire({
        icon: "error",
        title: "Lỗi!",
        text: "Xóa thất bại.",
        });
        </script>';
        header("Location: ./index.php?act=news");
        exit();
    }
} else {
    echo '<script>
    Swal.fire({
    icon: "error",
    title: "Lỗi!",
    text: "Không có id sản phẩm để xóa.",
    });
    </script>';
    header("Location: ./index.php?act=product");
    exit();
}
?>