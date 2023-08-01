<?php
// Kết nối đến cơ sở dữ liệu
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../admin/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>

    <!-- font themify -->
    <link rel="stylesheet" href="../assets/font/themify-icons/themify-icons.css" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>


    <!-- data-table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />


    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/normalize.css" />
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/ad-index.css" />

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/admin_icon_131692.png" type="image/x-icon" />
</head>

<body>
    <div class="main">
        <!-- header -->
        <header>
            <?php include_once 'admin_header.php'; ?>
        </header>
        <!-- header end -->


        <!-- ========== Start content_main ========== -->

        <main>


            <section class="content">
                <div class="content-main">
                    <div class="content__breadcrumb">
                        <nav class="breadcrumb mb-0">
                            <a class="breadcrumb-item" href="./index.php?act=category">Danh sách danh mục</a>
                            <a class="breadcrumb-item active" aria-current="page">Sửa danh mục</a>
                        </nav>
                    </div>

                    <!-- form -->

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $cate_id = $_POST['cate_id'] ?? '';
                        $cate_name = $_POST['cate_name'] ?? '';
                        $isSuccess = true;


                        if (!empty($_FILES['cate_img']['name'])) {
                            $img_name = $_FILES['cate_img']['name'];
                            $img_url = $_FILES['cate_img']['tmp_name'];
                            $img_size = $_FILES['cate_img']['size'];
                            $img_type = $_FILES['cate_img']['type'];
                            $targetFile = "../assets/img/" . $img_name;

                            $allowedTypes = array('image/jpeg', 'image/png');
                            $maxFileSize = 10000000; // 10mb

                            if (in_array($img_type, $allowedTypes) && $img_size < $maxFileSize) {
                                if (file_exists($targetFile)) {
                                    $isSuccess = false;
                                    echo '<script>
                                    Swal.fire({
                                    icon: "error",
                                    title: "Lỗi!",
                                    text: "File ảnh đã tồn tại.",
                                });
                                </script>';
                                } else {
                                    move_uploaded_file($img_url, $targetFile);
                                    $sql_img = $conn->prepare("UPDATE category SET category_img = :category_img WHERE category_id = :category_id");

                                    $sql_img->execute([
                                        ':category_id' => $cate_id,
                                        ':category_img' => $img_name,
                                    ]);
                                }
                            } else {
                                $isSuccess = false;
                                echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Lỗi!",
                                    text: "Chỉ được phép upload ảnh định dạng jpg hoặc png và kích thước < 10MB.",
                                });
                                </script>';
                            }
                        }

                        try {
                            $sql = $conn->prepare("UPDATE category SET category_name = :category_name WHERE category_id = :category_id");

                            $sql->execute([
                                ':category_id' => $cate_id,
                                ':category_name' => $cate_name,
                            ]);


                            if ($isSuccess == true) {
                                // Thành công
                                echo '<script>
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công!",
                                        text: "Chỉnh sửa danh mục thành công.",
                                    }).then(() => {
                                        window.location.href = "./index.php?act=category";
                                    });
                                    </script>';
                                exit();
                            }
                        } catch (PDOException $e) {
                            $isSuccess = false;
                            echo "Lỗi: " . $e->getMessage();
                            echo '<script>
                                    Swal.fire({
                                    icon: "error",
                                    title: "Lỗi!",
                                    text: "Sửa thất bại.",
                                });
                                </script>';
                        }
                    }






                    if (isset($_GET['id'])) {
                        $cate_url_id = $_GET['id'] ?? '';
                        $sql = $conn->prepare("SELECT * FROM category WHERE category_id = :category_id");
                        $sql->execute([':category_id' => $cate_url_id]);
                        $category = $sql->fetch(PDO::FETCH_ASSOC);
                    }





                    ?>
                    <div class="content_form">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row g-4">
                                <div class="mb-3 col-lg-2">
                                    <label for="" class="form-label">ID danh mục</label>
                                    <input type="text" name="cate_id" id="" class="form-control" value="<?php echo $category['category_id']; ?>" aria-describedby="helpId" readonly />
                                </div>
                                <div class="mb-3 col-lg-10">
                                    <label for="" class="form-label">Tên danh mục</label>
                                    <input type="text" name="cate_name" id="" class="form-control" placeholder="Ví dụ: Hoa quả" aria-describedby="helpId" value="<?php echo $category['category_name']; ?>" required />
                                </div>

                                <div class="mb-3 col-lg-3">
                                    <label for="formFile" class="form-label">Chọn ảnh</label>
                                    <input class="form-control d-none" type="file" name="cate_img" id="formFile" />
                                    <div class="text-center mb-4 mt-2">
                                        <img src="../assets/img/<?php echo $category['category_img']; ?>" id="img-upload" class="img-upload border" alt="category_img">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" name="" id="btn-upload" class="btn btn-success form__btn-btn">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <span class="ms-1">Chọn ảnh danh mục</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="form__btn">
                                <button type="submit" class="btn btn-primary form__btn-btn">Lưu lại</button>
                                <a href="./index.php?act=category" class="btn btn-danger form__btn-btn">Hủy bỏ</a>
                            </div>
                        </form>
                    </div>


                </div>
            </section>
        </main>
        <!-- ========== End content_main ========== -->
    </div>


    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>



    <!-- jquery -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- data-table -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- moment js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- main js -->
    <script src="../assets/js/ckedit.js"></script>

    <script>
        $(document).ready(function() {
            $('#btn-upload').on('click', function() {
                $('#formFile').click();

                //Hiển thị ảnh xem trước
                $('#formFile').on('change', function() {
                    let file = this.files[0];
                    if (file) {
                        var render = new FileReader();
                        render.onload = function(e) {
                            $('#img-upload').attr('src', e.target.result);
                        }
                    }
                    render.readAsDataURL(file);
                })
            });
        })
    </script>
</body>

</html>