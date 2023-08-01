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
                            <a class="breadcrumb-item" href="./index.php?act=product">Danh sách sản phẩm</a>
                            <a class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</a>
                        </nav>
                    </div>
                    <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $isSuccess = true;

                        // Dữ liệu sản phẩm chính
                        $pro_id = $_POST['pro_id'] ?? '';
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


                        // Kiểm tra xem có ảnh chính mới được tải lên hay không
                        if (!empty($_FILES['pro_img_main']['name'])) {
                            $img_name_main = $_FILES['pro_img_main']['name'];
                            $img_url_main = $_FILES['pro_img_main']['tmp_name'];
                            $img_size_main = $_FILES['pro_img_main']['size'];
                            $img_type_main = $_FILES['pro_img_main']['type'];


                            // Kiểm tra định dạng và kích thước ảnh
                            $allowedTypes = array('image/jpeg', 'image/png');
                            $maxFileSize = 10000000; // 10MB

                            if (in_array($img_type_main, $allowedTypes) && $img_size_main < $maxFileSize) {


                                // Đường dẫn đầy đủ của file mới
                                $targetFileMain = "../assets/img/" . $img_name_main;

                                // Nếu tệp tồn tại trong thư mục, đổi tên để tránh trùng lặp
                                $counter = 1;
                                while (file_exists($targetFileMain)) {
                                    $img_name_main = pathinfo($img_name_main, PATHINFO_FILENAME) . '_' . $counter . '.' . pathinfo($img_name_main, PATHINFO_EXTENSION);
                                    $targetFileMain = '../assets/img/' . $img_name_main;
                                    $counter++;
                                }

                                // Di chuyển ảnh vào thư mục
                                move_uploaded_file($img_url_main, $targetFileMain);

                                // Sau khi đã xử lý ảnh chính mới, tiến hành cập nhật ảnh chính vào bảng product
                                $sql_update_main = $conn->prepare("UPDATE product SET product_img = :pro_img_main WHERE product_id = :product_id");
                                $sql_update_main->execute([
                                    ':product_id' => $pro_id,
                                    ':pro_img_main' => $img_name_main,
                                ]);
                            } else {
                                $isSuccess = false;
                                echo '<script>
                                Swal.fire({
                                        icon: "error",
                                        title: "Lỗi!",
                                        text: "File ảnh phải <10mb và định dạng PNG và JPEG.",
                                    })
                                </script>';
                            }
                        }




                        //Kiểm tra nếu không thêm ảnh mới sẽ giữ ảnh cũ
                        if (!empty($pro_img_info['name'][0])) {
                            // Kiểm tra và xóa ảnh thumb cũ liên kết với sản phẩm (nếu có)
                            $sql_check_thumb = $conn->prepare("SELECT * FROM product_thumb WHERE product_id = :product_id");
                            $sql_check_thumb->execute([':product_id' => $pro_id]);
                            $existing_thumbs = $sql_check_thumb->fetchAll(PDO::FETCH_ASSOC);

                            if (!empty($existing_thumbs)) {
                                foreach ($existing_thumbs as $thumb) {
                                    $thumb_path = '../assets/img/thumb/' . $thumb['img'];
                                    if (file_exists($thumb_path)) {
                                        unlink($thumb_path); // Xóa tệp thumb cũ
                                    }
                                }

                                // Sau khi đã xóa các ảnh thumb cũ, tiến hành xóa các bản ghi trong bảng product_thumb liên quan đến sản phẩm này
                                $sql_delete_thumb = $conn->prepare("DELETE FROM product_thumb WHERE product_id = :product_id");
                                $sql_delete_thumb->execute([':product_id' => $pro_id]);
                            }

                            // Duyệt và xử lý từng ảnh thumbnail
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

                                // Thực hiện cập nhật thông tin ảnh vào bảng product_thumb
                                $sql_img_thumb = $conn->prepare("INSERT INTO product_thumb (product_id, img) VALUES (:product_id, :img)");
                                $sql_img_thumb->execute([
                                    'product_id' => $pro_id,
                                    'img' => $pro_img_name,
                                ]);
                            }
                        }

                        // Update dữ liệu chính


                        try {
                            // Thực hiện cập nhật thông tin sản phẩm chính vào bảng product
                            $sql = $conn->prepare("UPDATE product SET product_name = :pro_name, product_quantity = :pro_quantity, product_type = :pro_type, product_off = :pro_off, product_price_old = :pro_price_old, product_price_new = :pro_price_new, product_brand = :pro_brand, product_tag = :pro_tags, product_desc = :pro_desc, category_id = :pro_cate WHERE product_id = :product_id");
                            $sql->execute([
                                ':product_id' => $pro_id,
                                ':pro_cate' => $pro_cate,
                                ':pro_name' => $pro_name,
                                ':pro_quantity' => $pro_quantity,
                                ':pro_type' => $pro_type,
                                ':pro_off' => $pro_off,
                                ':pro_price_old' => $pro_price_old,
                                ':pro_price_new' => $pro_price_new,
                                ':pro_brand' => $pro_brand,
                                ':pro_tags' => $pro_tags,
                                ':pro_desc' => $pro_desc
                            ]);

                            $sql_detail = $conn->prepare("UPDATE product_detail SET product_detail = :pro_detail WHERE product_id = :product_id");
                            $sql_detail->execute([
                                ':product_id' => $pro_id,
                                ':pro_detail' => $pro_detail

                            ]);

                            if ($isSuccess == true) {
                                // Hiển thị thông báo khi hoàn thành
                                echo '<script>
                                    Swal.fire({
                                        icon: "success",
                                        title: "Thành công!",
                                        text: "Cập nhật sản phẩm thành công.",
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
                                            text: "Sửa sản phẩm thất bại",
                                        });
                                        </script>';
                        }
                    }




                    if (isset($_GET['id'])) {
                        $pro_url_id = $_GET['id'] ?? '';
                        $sql = $conn->prepare("SELECT * FROM product WHERE product_id = :product_id");
                        $sql->execute([':product_id' => $pro_url_id]);
                        $product = $sql->fetch(PDO::FETCH_ASSOC);

                        $product_cate = $product['category_id'];
                        $sql_cate = $conn->prepare("SELECT * FROM category WHERE category_id = :category_id");
                        $sql_cate->execute([':category_id' => $product_cate]);
                        $category = $sql_cate->fetch(PDO::FETCH_ASSOC);


                        $sql_detail = $conn->prepare("SELECT * FROM product_detail WHERE product_id = :product_id");
                        $sql_detail->execute([':product_id' => $pro_url_id]);
                        $detail = $sql_detail->fetch(PDO::FETCH_ASSOC);

                        $sql_thumb = $conn->prepare("SELECT * FROM product_thumb WHERE product_id = :product_id");
                        $sql_thumb->execute([':product_id' => $pro_url_id]);
                        $thumb = $sql_thumb->fetch(PDO::FETCH_ASSOC);
                    }

                    ?>




                    <!-- form -->
                    <div class="content_form">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row g-4">
                                <div class="mb-3 col-lg-1">
                                    <label for="pro_id" class="form-label">ID (auto)</label>
                                    <input type="number" name="pro_id" value="<?php echo $product['product_id']; ?>" id="pro_id" class="form-control" placeholder="Ví dụ: Quả cà chua" aria-describedby="helpId" readonly />
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="pro_quantity" class="form-label">Số lượng hàng</label>
                                    <input type="number" name="pro_quantity" value="<?php echo $product['product_quantity']; ?>" id="pro_id" class="form-control" placeholder="Ví dụ: Quả cà chua" aria-describedby="helpId" />
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="pro_cate" class="form-label">Danh mục</label>
                                    <select name="pro_cate" id="pro_cate" class="form-select" aria-label="Default select example">

                                        <option>-- Chọn danh mục sản phẩm --</option>
                                        <?php
                                        $sql_ad_cate = $conn->query("SELECT * FROM category");
                                        $cate_id;
                                        foreach ($sql_ad_cate as $row_ad_cate) {
                                        ?>
                                            <option <?php echo ($row_ad_cate['category_id'] == $product_cate) ? 'selected' : '' ?> value="<?php echo $row_ad_cate['category_id']; ?>"><?php echo $row_ad_cate['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pro_name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="pro_name" value="<?php echo $product['product_name']; ?>" id="pro_name" class="form-control" placeholder="Ví dụ: Quả cà chua" aria-describedby="helpId" />
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pro_type" class="form-label">Loại sản phẩm</label>
                                    <select class="form-select form-select-lg" name="pro_type" id="pro_type">
                                        <option>-- Chọn danh mục sản phẩm --</option>
                                        <option <?php echo ($product['product_type'] == 'veget') ? 'selected' : '' ?> value="veget">Vegetable</option>
                                        <option <?php echo ($product['product_type'] == 'meat') ? 'selected' : '' ?> value="meat">Meat</option>
                                        <option <?php echo ($product['product_type'] == 'food') ? 'selected' : '' ?> value="food">Food</option>
                                        <option <?php echo ($product['product_type'] == 'fruit') ? 'selected' : '' ?> value="fruit">Fruit</option>
                                    </select>

                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pro_off" class="form-label">Giảm giá</label>
                                    <input type="number" name="pro_off" value="<?php echo $product['product_off']; ?>" id="pro_off" class="form-control" placeholder="Ví dụ: -50" aria-describedby="helpId" />
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pro_price_old" class="form-label">Giá cũ </label>
                                    <input type="number" name="pro_price_old" value="<?php echo $product['product_price_old']; ?>" id="pro_price_old" class="form-control" placeholder="Ví dụ: 50000" aria-describedby="helpId" />
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pro_price_new" class="form-label">Giá mới</label>
                                    <input type="number" name="pro_price_new" value="<?php echo $product['product_price_new']; ?>" id="pro_price_new" class="form-control" placeholder="Ví dụ: 25000" aria-describedby="helpId" />
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="pro_brand" class="form-label">Thương hiệu</label>
                                    <input type="text" name="pro_brand" value="<?php echo $product['product_brand']; ?>" id="pro_brand" class="form-control" placeholder="Ví dụ: VinEco" aria-describedby="helpId" />
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="pro_tags" class="form-label">Tags</label>
                                    <input type="text" name="pro_tags" value="<?php echo $product['product_tag']; ?>" id="pro_tags" class="form-control" placeholder="Ví dụ: Hoa quả tươi" aria-describedby="helpId" />
                                </div>

                                <div class="mb-3 col-lg-12">
                                    <label for="pro_desc" class="form-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" name="pro_desc" placeholder="Ghi mô tả ngắn gọn" id="pro_desc" style="height: 100px"><?php echo $product['product_desc']; ?></textarea>
                                </div>

                                <div class="mb-3 col-lg-3">
                                    <label for="formFile" class="form-label">Chọn ảnh chính</label>
                                    <input class="form-control d-none" type="file" name="pro_img_main" id="formFile" />
                                    <div class="text-center mb-4 mt-2">
                                        <img src="../assets/img/<?php echo $product['product_img']; ?>" id="img-upload" class="img-upload border" alt="product_img">
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
                                        <img src="../assets/img/thumb/<?php echo $thumb['img']; ?>" id="img-upload1" class="img-upload border" alt="pro_img_thumb">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" id="btn-upload1" class="btn btn-success form__btn-btn">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <span class="ms-1">Chọn ảnh thumb</span>
                                        </button>
                                    </div>
                                </div>


                                <div class="mb-3 col-lg-12">
                                    <label for="pro_detail" class="form-label">Mô tả chi tiết</label>
                                    <textarea class="form__edit" name="pro_detail" id="form__edit"><?php echo $detail['product_detail']; ?></textarea>
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

        //
    </script>
</body>

</html>