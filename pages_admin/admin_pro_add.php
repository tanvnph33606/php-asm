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
                            <a class="breadcrumb-item" href="#">Danh sách sản phẩm</a>
                            <a class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</a>
                        </nav>
                    </div>

                    <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $isSuccess = true;
                        // Dữ liệu sản phẩm chính
                        $pro_cate = $_POST['pro_cate'] ?? '';
                        $pro_name = $_POST['pro_name'] ?? '';
                        $pro_type = $_POST['pro_type'] ?? '';
                        $pro_off = $_POST['pro_off'] ?? '';
                        $pro_price_old = $_POST['pro_price_old'] ?? '';
                        $pro_price_new = $_POST['pro_price_new'] ?? '';
                        $pro_brand = $_POST['pro_brand'] ?? '';
                        $pro_tags = $_POST['pro_tags'] ?? '';
                        $pro_desc = $_POST['pro_desc'] ?? '';
                        $pro_detail = $_POST['pro_detail'] ?? '';
                        $pro_quantity = $_POST['pro_quantity'] ?? '';

                        // Dữ liệu ảnh thumb sản phẩm
                        $pro_img_info = $_FILES['pro_img_thumb'];


                        $img_name_main = $_FILES['pro_img_main']['name'];
                        $img_url_main = $_FILES['pro_img_main']['tmp_name'];
                        $img_size_main = $_FILES['pro_img_main']['size'];
                        $img_type_main = $_FILES['pro_img_main']['type'];
                        $targetFileMain = "../assets/img/" . $img_name_main;

                        $allowedTypes = array('image/jpeg', 'image/png');
                        $maxFileSize = 10000000; // 10mb

                        if (in_array($img_type_main, $allowedTypes) && $img_size_main < $maxFileSize) {
                            if (file_exists($targetFileMain)) {
                                $isSuccess = false;
                                echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Lỗi!",
                                    text: "File đã tồn tại.",
                                });
                                </script>';
                            } else {
                                move_uploaded_file($img_url_main, $targetFileMain);
                                try {
                                    // Thêm thông tin sản phẩm chính vào bảng product
                                    $sql = $conn->prepare("INSERT INTO product (product_name, product_quantity , product_type, product_off,product_img , product_price_old, product_price_new, product_brand, product_tag, product_desc, category_id) VALUES (:pro_name, :pro_quantity, :pro_type, :pro_off, :pro_img, :pro_price_old, :pro_price_new, :pro_brand, :pro_tags, :pro_desc, :pro_cate)");
                                    $sql->execute([
                                        ':pro_cate' => $pro_cate,
                                        ':pro_name' => $pro_name,
                                        ':pro_type' => $pro_type,
                                        ':pro_off' => $pro_off,
                                        ':pro_quantity' => $pro_quantity,
                                        ':pro_img' => $img_name_main,
                                        ':pro_price_old' => $pro_price_old,
                                        ':pro_price_new' => $pro_price_new,
                                        ':pro_brand' => $pro_brand,
                                        ':pro_tags' => $pro_tags,
                                        ':pro_desc' => $pro_desc
                                    ]);

                                    // Lấy id của sản phẩm vừa được thêm vào bảng product
                                    $lastIdPro = $conn->lastInsertId();

                                    try {
                                        $sql_detail = $conn->prepare("INSERT INTO product_detail (product_id, product_detail) VALUES (:product_id, :pro_detail)");
                                        $sql_detail->execute([
                                            ':product_id' => $lastIdPro,
                                            ':pro_detail' => $pro_detail
                                        ]);
                                    } catch (PDOException $e) {
                                        $isSuccess = false;
                                        echo "Lỗi: " . $e->getMessage();
                                        echo "lỗi: " . $e->getLine();
                                        echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Lỗi!",
                                            text: "Thêm sản phẩm thất bại",
                                            });
                                        </script>';
                                    }

                                    // Duyệt và xử lý từng ảnh
                                    foreach ($pro_img_info['name'] as $key => $pro_img_name) {
                                        $pro_img_tmp = $pro_img_info['tmp_name'][$key];
                                        $pro_img_size = $pro_img_info['size'][$key];
                                        $pro_img_type = $pro_img_info['type'][$key];

                                        // Kiểm tra định dạng và kích thước ảnh
                                        $allowed_file = array('jpg', 'png');
                                        $file_extension = pathinfo($pro_img_name, PATHINFO_EXTENSION);
                                        $max_pro_img_size = 10 * 1024 * 1024; // 10MB

                                        if (!in_array($file_extension, $allowed_file)) {
                                            echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Lỗi!",
                                            text: "Chỉ tải file PNG hoặc JPG.",
                                        });
                                        </script>';
                                            continue;
                                        }

                                        if ($pro_img_size > $max_pro_img_size) {
                                            echo '<script>
                                            Swal.fire({
                                                icon: "error",
                                                title: "Lỗi!",
                                                text: "Kích thước không vượt quá 10MB.",
                                            });
                                        </script>';
                                            continue;
                                        }

                                        // Đường dẫn đầy đủ của file mới
                                        $targetFile = '../assets/img/thumb/' . $pro_img_name;

                                        // Nếu tệp tồn tại trong thư mục, đổi tên để tránh trùng lặp
                                        $counter = 1;
                                        while (file_exists($targetFile)) {
                                            $pro_img_name = pathinfo($pro_img_name, PATHINFO_FILENAME) . '_' . $counter . '.' . $file_extension;
                                            $targetFile = '../assets/img/thumb/' . $pro_img_name;
                                            $counter++;
                                        }

                                        move_uploaded_file($pro_img_tmp, $targetFile);

                                        // Thêm thông tin ảnh vào bảng product_thumb
                                        $sql = $conn->prepare("INSERT INTO product_thumb (product_id, img) VALUES (:product_id, :img)");
                                        $sql->execute([
                                            'product_id' => $lastIdPro,
                                            'img' => $pro_img_name,
                                        ]);
                                    }

                                    // Hiển thị thông báo khi hoàn thành

                                    if ($isSuccess == true) {
                                        echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "Thành công!",
                                            text: "Thêm sản phẩm thành công.",
                                        }).then(() => {
                                            window.location.href = "./index.php?act=product";
                                        });
                                    </script>';
                                    }
                                } catch (PDOException $e) {
                                    $isSuccess = false;
                                    echo "Lỗi: " . $e->getMessage();
                                    echo "lỗi: " . $e->getLine();
                                    echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Lỗi!",
                                            text: "Thêm sản phẩm thất bại",
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
                                text: "Xảy ra lỗi khi tải lên ảnh chính.",
                            });
                            </script>';
                        }
                    }
                    ?>

                    <!-- form -->
                    <div class="content_form">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row g-4">

                                <div class="mb-3 col-lg-3">
                                    <label for="pro_cate" class="form-label">Danh mục</label>
                                    <select name="pro_cate" id="pro_cate" class="form-select" aria-label="Default select example">
                                        <option selected>-- Chọn danh mục sản phẩm --</option>
                                        <?php
                                        $sql_ad_cate = $conn->query("SELECT * FROM category");
                                        $cate_id;
                                        foreach ($sql_ad_cate as $row_ad_cate) {
                                        ?>
                                            <option value="<?php echo $row_ad_cate['category_id']; ?>"><?php echo $row_ad_cate['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="pro_name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="pro_name" id="pro_name" class="form-control" placeholder="Ví dụ: Quả cà chua" aria-describedby="helpId" required />
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="pro_type" class="form-label">Loại sản phẩm</label>
                                    <select class="form-select form-select-lg" name="pro_type" id="pro_type">
                                        <option selected>-- Chọn loại sản phẩm --</option>
                                        <option value="veget">Vegetable</option>
                                        <option value="meat">Meat</option>
                                        <option value="food">Food</option>
                                        <option value="fruit">Fruit</option>
                                    </select>

                                </div>
                                <div class="mb-3 col-lg-1">
                                    <label for="pro_off" class="form-label">Giảm giá</label>
                                    <input type="number" name="pro_off" id="pro_off" class="form-control" placeholder="Ví dụ: -50" aria-describedby="helpId" required />
                                </div>
                                <div class="mb-3 col-lg-2">
                                    <label for="pro_quantity" class="form-label">Số lượng hàng</label>
                                    <input type="number" name="pro_quantity" id="pro_quantity" class="form-control" placeholder="Ví dụ: 560" aria-describedby="helpId" required />
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="pro_price_old" class="form-label">Giá cũ </label>
                                    <input type="number" name="pro_price_old" id="pro_price_old" class="form-control" placeholder="Ví dụ: 50000" aria-describedby="helpId" required />
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="pro_price_new" class="form-label">Giá mới</label>
                                    <input type="number" name="pro_price_new" id="pro_price_new" class="form-control" placeholder="Ví dụ: 25000" aria-describedby="helpId" required />
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="pro_brand" class="form-label">Thương hiệu</label>
                                    <input type="text" name="pro_brand" id="pro_brand" class="form-control" placeholder="Ví dụ: VinEco" aria-describedby="helpId" required />
                                </div>

                                <div class="mb-3 col-lg-3">
                                    <label for="pro_tags" class="form-label">Tags</label>
                                    <input type="text" name="pro_tags" id="pro_tags" class="form-control" placeholder="Ví dụ: Hoa quả tươi" aria-describedby="helpId" required />
                                </div>

                                <div class="mb-3 col-lg-12">
                                    <label for="pro_desc" class="form-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" name="pro_desc" placeholder="Ghi mô tả ngắn gọn" id="pro_desc" style="height: 100px" required></textarea>
                                </div>


                                <div class="mb-3 col-lg-3">
                                    <label for="formFile" class="form-label">Chọn ảnh chính</label>
                                    <input class="form-control d-none" type="file" name="pro_img_main" id="formFile" />
                                    <div class="text-center mb-4 mt-2">
                                        <img src="" id="img-upload" class="img-upload border" alt="">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" name="" id="btn-upload" class="btn btn-success form__btn-btn">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <span class="ms-1">Chọn ảnh chính</span>
                                        </button>
                                    </div>
                                </div>


                                <div class="mb-3 col-lg-3">
                                    <label for="formFile1" class="form-label">Chọn nhiều thumb (Tối thiểu 5 ảnh)</label>
                                    <input class="form-control d-none" type="file" name="pro_img_thumb[]" id="formFile1" multiple />
                                    <div class="text-center mb-4 mt-2">
                                        <img src="" id="img-upload1" class="img-upload border" alt="">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" id="btn-upload1" class="btn btn-success form__btn-btn">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <span class="ms-1">Chọn ảnh thumb</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3 col-lg-12">
                                    <label for="pro_detail" class="form-label">Mô tả chi tiết sản phẩm</label>
                                    <textarea class="form__edit" name="pro_detail" id="form__edit"></textarea>
                                </div>



                                <!-- btn -->
                            </div>
                            <div class="form__btn">
                                <button type="submit" class="btn btn-primary form__btn-btn">Lưu lại</button>
                                <a href="./index.php?act=product" class="btn btn-danger form__btn-btn">Hủy bỏ</a>
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
        //ảnh
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

            //thumb
            $('#btn-upload1').on('click', function() {
                $('#formFile1').click();

                //Hiển thị ảnh xem trước
                $('#formFile1').on('change', function() {
                    let file = this.files[0];
                    if (file) {
                        var render = new FileReader();
                        render.onload = function(e) {
                            $('#img-upload1').attr('src', e.target.result);
                        }
                    }
                    render.readAsDataURL(file);
                })
            });
        })
    </script>
</body>

</html>