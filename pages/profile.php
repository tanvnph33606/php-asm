<?php
// Kết nối đến cơ sở dữ liệu
require_once '../admin/connect.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hồ sơ</title>

    <!-- font themify -->
    <link rel="stylesheet" href="../assets/font/themify-icons/themify-icons.css" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

    <!-- aos -->
    <link rel="stylesheet" href="../assets/library/aos-master/dist/aos.css" />

    <!-- slick -->

    <link rel="stylesheet" href="../assets/library/slick-1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="../assets/library/slick-1.8.1/slick/slick-theme.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/normalize.css" />
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/profile.css" />

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
                            <h2 class="breadcrumb__title">Hồ sơ của bạn</h2>
                            <nav class="mt-3">
                                <ol class="breadcrumb__list d-flex justify-content-center align-items-center">
                                    <li class="breadcrumb__item">
                                        <a href="../index.html">Trang chủ</a>
                                    </li>
                                    <span class="breadcrumb__icon">
                                        <i class="ti-angle-right"></i></span>
                                    <li class="breadcrumb__item active">Hồ sơ của bạn</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- about_company -->

        <main>


            <!-- show -->
            <?php
            if (isset($_SESSION) && !empty($_SESSION['account']) && $_SESSION['account']['role_id'] == 2) {
                $row = $_SESSION['account'];
            }



            if (isset($_GET['act']) && $_GET['act'] == 'profile') {
                include_once '../modules/profile/profile_show.php';
            } else {
                include_once '../modules/profile/profile_edit.php';
            }
            ?>



            <!-- subcribe -->
            <?php
            include_once '../modules/about/subscribe.php';

            ?>
        </main>

        <!-- footer -->
        <?php
        include_once '../includes/footer.php';
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