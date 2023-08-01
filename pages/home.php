<?php
// Kết nối đến cơ sở dữ liệu
include_once '../admin/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang chủ</title>

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

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/normalize.css" />
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/home.css" />

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/shape32.png" type="image/x-icon" />
</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
    <!-- header -->
    <div class="main">
        <header class="">
            <div class="header sticky">
                <div class="container position-relative">

                    <?php
                    include_once '../includes/header.php';
                    ?>

                    <div class="header__thumb">
                        <img src="../assets/img/shape1.png" alt="" />
                    </div>
                </div>
            </div>
        </header>

        <!-- banner -->
        <?php include_once '../modules/home/banner.php'; ?>


        <main>
            <!-- category -->
            <?php include_once '../modules/home/category.php'; ?>

            <!-- product__top -->
            <?php include_once '../modules/home/product.php'; ?>

            <!-- store -->

            <?php include_once '../modules/home/store.php'; ?>

            <!-- featured -->

            <?php include_once '../modules/home/featured.php'; ?>

            <!-- ogranic -->
            <?php include_once '../modules/home/ogranic.php'; ?>

            <!-- comment -->

            <?php include_once '../modules/home/comment.php'; ?>

            <!-- blog -->
            <?php include_once '../modules/home/news.php'; ?>
        </main>

        <!-- footer -->
        <?php
        include_once '../includes/footer.php'
        ?>
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
</body>

</html>