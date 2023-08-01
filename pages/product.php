<?php
// Kết nối đến cơ sở dữ liệu
require_once '../admin/connect.php';


(isset($_GET['id'])) ? $id = $_GET['id'] : $id = "";
$sql_sort = $conn->prepare("SELECT * FROM category WHERE category_id = :category_id");
$sql_sort->execute([
    'category_id' => $id
]);
$row_sort = $sql_sort->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $row_sort['category_name']; ?></title>

    <!-- font themify -->
    <link rel="stylesheet" href="../assets/font/themify-icons/themify-icons.css" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <!-- aos -->
    <link rel="stylesheet" href="../assets/library/aos-master/dist/aos.css" />


    <!-- nice-select -->
    <link rel="stylesheet" href="../assets/library/jquery-nice-select-1.1.0/css/nice-select.css" />

    <!-- jquery-theme -->

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/normalize.css" />
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/product.css" />

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
                                        <a href="../pages/home.php">Trang chủ</a>
                                    </li>
                                    <span class="breadcrumb__icon">
                                        <i class="ti-angle-right"></i></span>
                                    <li class="breadcrumb__item active"><?php echo $row_sort['category_name']; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main>
            <!-- product -->
            <section class="product">
                <div class="container">
                    <div data-aos="fade-up" data-aos-duration="1000" class="row g-5">
                        <div class="col-lg-3">
                            <!-- filter -->
                            <?php include_once '../modules/product/filter.php'; ?>
                        </div>

                        <div class="col-lg-9">
                            <!-- sortby -->
                            <div class="row mb-4">
                                <div class="sort position-relative d-flex justify-content-between align-items-center">
                                    <!-- name -->
                                    <div class="sort__title ps-3">
                                        <h2><?php echo $row_sort['category_name']; ?></h2>
                                    </div>

                                    <div class="sort__choose">
                                        <select id="sort__choose">
                                            <option data-display="Select">Sắp xếp theo</option>
                                            <option value="1" selected>Mặc định</option>
                                            <option value="2">Hàng mới nhất</option>
                                            <option value="3">Hàng cũ nhất</option>
                                            <option value="4">Giá tăng dần</option>
                                            <option value="5">Giá giảm dần</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- procuct__main1 -->

                            <?php

                            include_once '../modules/product/product.php'; ?>



                            <!-- pagination -->
                            <div class="row mt-5">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-long-arrow-alt-left"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link active" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">...</li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">60</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-long-arrow-alt-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- footer -->
        <?php include_once("../includes/footer.php"); ?>
    </div>


    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- aos -->
    <script src="../assets/library/aos-master/dist/aos.js"></script>

    <!-- jquery -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- jquery ui -->

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

    <!-- slick -->
    <script src="../assets/library/slick-1.8.1/slick/slick.min.js"></script>

    <!-- nice-select -->
    <script src="../assets/library/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js"></script>

    <!-- main js -->
    <script src="../assets/js/main.js"></script>
    <script>
        //nice select
        $(document).ready(function() {
            $("select").niceSelect();
            $("select").niceSelect("update");

            // slider-range (product)

            let minValue = 0;
            let maxValue = 10000000;

            let $slider = $("#filter__range-price");
            let $minPrice = $(".filter__text-min");
            let $maxPrice = $(".filter__text-max");

            $slider.slider({
                range: true,
                min: minValue,
                max: maxValue,
                values: [minValue, maxValue],
                slide: function(event, ui) {
                    $minPrice.text(ui.values[0].toLocaleString() + "₫");
                    $maxPrice.text(ui.values[1].toLocaleString() + "₫");
                },
            });

            $minPrice.text($slider.slider("values", 0).toLocaleString() + "₫");
            $maxPrice.text($slider.slider("values", 1).toLocaleString() + "₫");
        });
    </script>
</body>

</html>