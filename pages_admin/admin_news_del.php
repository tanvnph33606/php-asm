
<?php
require_once '../admin/connect.php';

if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    try {
        // xóa khóa ngoại
        $sql_detail = $conn->prepare("DELETE FROM news_detail WHERE news_id = :news_id");
        $sql_detail->execute([':news_id' => $news_id]);


        // Lấy thông tin ảnh từ cơ sở dữ liệu
        $sql_img = $conn->prepare("SELECT news_img FROM news WHERE news_id = :news_id");
        $sql_img->execute([':news_id' => $news_id]);
        $row = $sql_img->fetch(PDO::FETCH_ASSOC);
        $img_name = $row['news_img'];


        // Xóa khỏi cơ sở dữ liệu
        $sql_main = $conn->prepare("DELETE FROM news WHERE news_id = :news_id");
        $sql_main->execute([':news_id' => $news_id]);

        // Xóa ảnh khỏi thư mục (nếu có)
        if (!empty($img_name)) {
            $img_path = "../assets/img/" . $img_name;
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }

        header("Location: ./index.php?act=news");
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
    text: "Không có id tin tức để xóa.",
    });
    </script>';
    header("Location: ./index.php?act=news");
    exit();
}
?>