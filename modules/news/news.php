<!-- news -->

<section class="news" data-aos="fade-up" data-aos-duration="1500">
    <div class="container">
        <div class="row mt-4 gx-5">
            <div class="col-lg-8">
                <div class="news__title-left">
                    <h2>Tin tức</h2>
                </div>
                <div class="row g-5 mb-5">
                    <?php
                    $sql_news_main = $conn->query("SELECT DATE_FORMAT(news_date, '%d/%m/%Y') AS news_date, news_img, news_title, news_desc, news_user, news_id FROM news ORDER BY news_id DESC ");
                    foreach ($sql_news_main as $row_news_main) {
                    ?>
                        <div class="col-lg-6">
                            <div data-aos="fade-up" data-aos-duration="1200" class="news__item">
                                <a class="news__link" href="/PHP/ASM/pages/detail-news.php?act=news_detail&id=<?php echo $row_news_main['news_id']; ?>">
                                    <div class="news__img">
                                        <img src="../assets/img/<?php echo $row_news_main['news_img']; ?>" alt="img_news" />
                                    </div>
                                    <div class="news__content">
                                        <div class="news__date">
                                            <div>
                                                <i class="fa-solid fa-user"></i>
                                                <span class="text-capitalize ms-2"><?php echo $row_news_main['news_user']; ?></span>
                                            </div>
                                            <div>
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span class="ms-2"><?php echo $row_news_main['news_date']; ?></span>
                                            </div>
                                        </div>

                                        <div class="news__title text-capitalize">
                                            <?php echo $row_news_main['news_title']; ?>
                                        </div>

                                        <div class="news__desc">
                                            <?php echo $row_news_main['news_desc']; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="news__title-right">
                    <h2>Tin nổi bật</h2>
                </div>
                <div class="row gy-4">

                    <?php
                    $sql_news_sub = $conn->query("SELECT news_img, news_title FROM news ORDER BY news_id DESC ");
                    foreach ($sql_news_sub as $row_news_sub) {
                    ?>
                        <div class="col-lg-12">
                            <a data-aos="fade-up" data-aos-duration="1200" href="#" class="news__side d-flex">
                                <div class="news__side-img">
                                    <img src="../assets/img/<?php echo $row_news_sub['news_img']; ?>" alt="" />
                                </div>
                                <p class="news__side-content">
                                    <?php echo $row_news_sub['news_title']; ?>
                                </p>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="row mt-5">
            <a class="text-black" href="/PHP/ASM/pages/news.php">
                <div class="banner__btn d-flex align-items-center justify-content-center">
                    <button class="btn custom_btn rounded-5 text-center d-flex align-items-center justify-content-between">
                        <span class="me-2">Xem thêm</span>
                        <i class="ti-arrow-right mt-1"></i>
                    </button>
                </div>
            </a>
        </div>
    </div>
</section>