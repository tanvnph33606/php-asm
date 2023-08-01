<!-- blog -->

<section class="blog" data-aos="fade-up" data-aos-duration="1500">
    <div class="container">

        <div class="row">
            <div class="category__content">
                <div class="category__title text-center mb-5">
                    <div class="category__sub-title">
                        <i class="ti-control-record"></i>
                        <i class="ti-control-record"></i>
                        <i class="ti-control-record"></i>
                        <span>CÁC SẢN PHẨM NÔNG SẢN TƯƠI - SẠCH</span>
                    </div>
                    <div class="category__bot-title featured__bot-title text-uppercases">
                        <h2>Tin tức hôm nay mới nhất </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="blog__list">
                <?php
                $sql_blog = $conn->query("SELECT DATE_FORMAT(news_date, '%d/%m/%Y') AS news_date, news_id,news_img, news_title, news_desc  FROM news ORDER BY news_id DESC LIMIT 5");
                foreach ($sql_blog as $row_blog) {
                ?>
                    <div data-aos="fade-up" data-aos-duration="1000" class="blog__item">
                        <div class="col">
                            <a class="blog__link" href="/PHP/ASM/pages/detail-news.php?act=news_detail&id=<?php echo $row_blog['news_id']; ?>">
                                <div class="blog__img">
                                    <img src="../assets/img/<?php echo $row_blog['news_img']; ?>" alt="img_blog" />
                                </div>
                                <div class="blog__content">
                                    <div class="blog__date">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span>Ngày <?php echo $row_blog['news_date']; ?></span>
                                    </div>

                                    <div class="blog__title">
                                        <?php echo $row_blog['news_title']; ?>
                                    </div>

                                    <div class="blog__desc">
                                        <?php echo $row_blog['news_desc']; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
    <div class="row">
        <a class="text-black" href="/PHP/ASM/pages/news.php">
            <div class="banner__btn d-flex align-items-center justify-content-center">
                <a href="/PHP/ASM/pages/news.php" class="btn custom_btn rounded-5 text-center d-flex align-items-center justify-content-between">
                    <span class="me-2">Xem thêm</span>
                    <i class="ti-arrow-right mt-1"></i>
                </a>
            </div>
        </a>
    </div>
    </div>
</section>