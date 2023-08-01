<?php
// Kết nối đến cơ sở dữ liệu
require_once '../admin/connect.php';

//lấy ra tên tin tức
if (isset($_GET['act']) && $_GET['act'] == 'news_detail' && isset($_GET['id'])) {
    $id_news = $_GET['id'];
}
$sql_new_title = $conn->prepare("SELECT * FROM news WHERE news_id = :news_id");
$sql_new_title->execute(
    [
        'news_id' => $id_news
    ]
);
$row_new_title = $sql_new_title->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $row_new_title['news_title']; ?></title>

    <!-- font themify -->
    <link rel="stylesheet" href="../assets/font/themify-icons/themify-icons.css" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <!-- aos -->
    <link rel="stylesheet" href="../assets/library/aos-master/dist/aos.css" />


    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/normalize.css" />
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/news.css" />

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
                            <h2 class="breadcrumb__title">Tin tức </h2>
                            <nav class="mt-3">
                                <ol class="breadcrumb__list d-flex justify-content-center align-items-center">
                                    <li class="breadcrumb__item">
                                        <a href="../index.php">Trang chủ</a>
                                    </li>
                                    <span class="breadcrumb__icon">
                                        <i class="ti-angle-right"></i></span>
                                    <li class="breadcrumb__item">
                                        <a href="/PHP/ASM/pages/news.php">Tin tức</a>
                                    </li>

                                    <span class="breadcrumb__icon">
                                        <i class="ti-angle-right"></i></span>
                                    <li style="width: 250px;" class="breadcrumb__item active text-truncate"><?php echo $row_new_title['news_title']; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <main>
            <!-- newss -->
            <section class="news" data-aos="fade-up" data-aos-duration="1500">
                <div class="container">
                    <div class="row mt-4 gx-5">
                        <?php include_once '../modules/news/news_detail_left.php'; ?>
                        <!--  -->
                        <?php include_once '../modules/news/news_detail_right.php'; ?>
                    </div>
                </div>
            </section>
        </main>

        <!-- footer -->
        <?php include_once '../includes/footer.php'; ?>
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