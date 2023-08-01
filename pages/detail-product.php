<?php
// Kết nối đến cơ sở dữ liệu
require_once '../admin/connect.php';
// id sản phẩm và lấy ra tên sản phẩm
if (isset($_GET['act']) && $_GET['act'] == 'product_detail' && isset($_GET['id'])) {
    $id_pro = $_GET['id'] ?? '';
}
$sql_name = $conn->prepare("SELECT * FROM product WHERE product_id = :product_id");
$sql_name->execute(
    [
        'product_id' => $id_pro
    ]
);
$row_name = $sql_name->fetch(PDO::FETCH_ASSOC);

//Tên của danh mục sản phẩm
$sql_cate_name = $conn->prepare("SELECT * FROM category WHERE category_id = :category_id");
$sql_cate_name->execute(
    [
        'category_id' => $row_name['category_id']
    ]
);
$row_cate_name = $sql_cate_name->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $row_name['product_name']; ?></title>

    <!-- font themify -->
    <link rel="stylesheet" href="../assets/font/themify-icons/themify-icons.css" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <!-- aos -->
    <link rel="stylesheet" href="../assets/library/aos-master/dist/aos.css" />

    <!-- slick -->

    <link rel="stylesheet" href="../assets/library/slick-1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="../assets/library/slick-1.8.1/slick/slick-theme.css" />

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/normalize.css" />
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/detail-product.css" />

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/shape32.png" type="image/x-icon" />
</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
    <!-- header -->
    <div class="main">
        <header class="">
            <div class="header sticky">
                <div class="container position-relative">
                    <!-- header -->
                    <?php
                    include_once '../includes/header.php';
                    ?>

                </div>
            </div>
        </header>

        <!-- breadcrumb -->
        <section class="breadcrumbb">
            <div style="background-image: url(../assets/img/single-banner.jpg)" class="breadcrumb__main d-flex flex-column justify-content-center text-center align-items-center">
                <div class="container z-1">
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column justify-content-center align-items-center">
                            <h2 class="breadcrumb__title">Sản phẩm của chúng tôi</h2>
                            <nav class="mt-3">
                                <ol class="breadcrumb__list d-flex justify-content-center align-items-center">
                                    <li class="breadcrumb__item">
                                        <a href="../home.php">Trang chủ</a>
                                    </li>
                                    <span class="breadcrumb__icon">
                                        <i class="ti-angle-right"></i></span>
                                    <li class="breadcrumb__item">
                                        <a href="../pages/product.php?act=product&id=<?php echo $row_cate_name['category_id']; ?>"><?php echo $row_cate_name['category_name']; ?></a>
                                    </li>
                                    <span class="breadcrumb__icon">
                                        <i class="ti-angle-right"></i></span>

                                    <li class="breadcrumb__item active"><?php echo $row_name['product_name']; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <main>
            <!-- detail -->
            <section class="detail">
                <div data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000" class="detail__main">
                    <div class="container">
                        <div class="row gx-5">
                            <!-- thumb -->
                            <?php include_once '../modules/product/detail-preview.php' ?>

                            <!-- Info -->
                            <?php include_once '../modules/product/detail-goods.php' ?>

                        </div>
                    </div>
                </div>
            </section>

            <!-- product__inner -->

            <?php include_once '../modules/product/detail-inner.php'; ?>

            <!-- product__top -->
            <?php include_once '../modules/home/product.php'; ?>
        </main>

        <!-- footer -->
        <?php include_once '../includes/footer.php' ?>
    </div>


    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- aos -->
    <script src="../assets/library/aos-master/dist/aos.js"></script>

    <!-- jquery -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- slick -->
    <script src="../assets/library/slick-1.8.1/slick/slick.min.js"></script>

    <!-- main js -->
    <script src="../assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $(".detail__thumb-item").click(function() {
                $(".detail__thumb-item.active").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
</body>

</html>