<?php
// Kết nối đến cơ sở dữ liệu
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
                            <a class="breadcrumb-item" href="./index.php?act=news"">Danh sách sản phẩm</a>
                            <a class=" breadcrumb-item active" aria-current="page">Thêm tin tức</a>
                        </nav>
                    </div>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $isSuccess = true;
                        $news_title = $_POST['news_title'] ?? '';
                        $news_user = $_POST['news_user'] ?? '';
                        $news_date = $_POST['news_date'] ?? '';
                        $news_tags = $_POST['news_tags'] ?? '';
                        $news_desc = $_POST['news_desc'] ?? '';
                        $news_desc_detail = $_POST['news_desc_detail'] ?? '';


                        $img_name = $_FILES['news_img']['name'];
                        $img_url = $_FILES['news_img']['tmp_name'];
                        $img_size = $_FILES['news_img']['size'];
                        $img_type = $_FILES['news_img']['type'];
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
                                    text: "File đã tồn tại.",
                                });
                                </script>';
                            } else {
                                move_uploaded_file($img_url, $targetFile);
                                try {
                                    $sql = $conn->prepare("INSERT INTO news (news_title, news_user, news_date, news_tags, news_img, news_desc) VALUES (:news_title, :news_user, :news_date, :news_tags, :news_img, :news_desc)");

                                    $sql->execute([
                                        ':news_title' => $news_title,
                                        ':news_user' => $news_user,
                                        ':news_date' => $news_date,
                                        ':news_tags' => $news_tags,
                                        ':news_img' => $img_name,
                                        ':news_desc' => $news_desc,
                                    ]);

                                    $sql_detail = $conn->prepare("INSERT INTO news_detail (news_id, news_detail) VALUES (:news_id, :news_detail)");
                                    $sql_detail->execute([
                                        ':news_id' => $conn->lastInsertId(),
                                        ':news_detail' => $news_desc_detail
                                    ]);

                                    if ($isSuccess == true) {
                                        // thành công
                                        echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "Thành công!",
                                            text: "Thêm tin tức thành công.",
                                        }).then(() => {
                                            window.location.href = "./index.php?act=news";
                                        });
                                            </script>';
                                    }
                                } catch (PDOException $e) {
                                    $isSuccess = false;
                                    echo "Lỗi: " . $e->getMessage();
                                    echo '<script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Lỗi!",
                                        text: "Thêm thất bại.",
                                    });
                                    </script>';
                                }
                            }
                        } else {
                            $isSuccess = false;
                            echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Lỗi!",
                                    text: "Chỉ được phép upload ảnh định dạng jpg hoặc png và kích thước nhỏ hơn 10MB.",
                                });
                                </script>';
                        }
                    }
                    ?>
                    <!-- form -->
                    <div class="content_form">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row g-4">

                                <div class="mb-3 col-lg-4">
                                    <label for="news_user" class="form-label">Tên người đăng</label>
                                    <input type="text" name="news_user" id="news_user" class="form-control" placeholder="Ví dụ: Admin" aria-describedby="helpId" required />
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="news_date" class="form-label">Ngày đăng</label>

                                    <input type="date" name="news_date" id="news_date" class="form-control" placeholder="Ví dụ: Hoa quả" aria-describedby="helpId" required />
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="news_tags" class="form-label">Tags</label>
                                    <input type="text" name="news_tags" id="news_tags" class="form-control" placeholder="Ví dụ: Hoa quả tươi" aria-describedby="helpId" required />
                                </div>


                                <div class="mb-3 col-lg-3">
                                    <label for="news_title" class="form-label">Tiêu đề</label>
                                    <textarea class="form-control" name="news_title" placeholder="Ghi mô tả ngắn gọn" id="news_title" style="height: 100px" required></textarea>
                                </div>

                                <div class="mb-3 col-lg-9">
                                    <label for="news_desc" class="form-label">Mô tả tin tức</label>
                                    <textarea class="form-control" name="news_desc" placeholder="Ghi mô tả ngắn gọn" id="news_desc" style="height: 100px" required></textarea>
                                </div>


                                <div class="mb-3 col-lg-3">
                                    <label for="formFile" class="form-label">Chọn ảnh</label>
                                    <input class="form-control d-none" type="file" name="news_img" id="formFile" />
                                    <div class="text-center mb-4 mt-2">
                                        <img src="" id="img-upload" class="img-upload border" alt="">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" name="" id="btn-upload" class="btn btn-success form__btn-btn">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <span class="ms-1">Chọn ảnh tin tức</span>
                                        </button>
                                    </div>
                                </div>


                                <div class="mb-3 col-lg-12">
                                    <label for="form__edit" class="form-label">Mô tả chi tiết tin tức</label>
                                    <textarea class="form__edit" name="news_desc_detail" id="form__edit"></textarea>
                                </div>

                                <!-- btn -->
                            </div>
                            <div class="form__btn">
                                <button type="submit" class="btn btn-primary form__btn-btn">Lưu lại</button>
                                <a href="./index.php?act=news" class="btn btn-danger form__btn-btn">Hủy bỏ</a>
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

    <!-- ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/ckeditor.js"></script>

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