<section class="category position-relative" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000">
    <div class="category__main">
        <div class="container">
            <div class="row">
                <div class="category__content">
                    <div class="category__title text-center mb-5">
                        <div class="category__sub-title">
                            <i class="ti-control-record"></i>
                            <i class="ti-control-record"></i>
                            <i class="ti-control-record"></i>
                            <span>CÁC SẢN PHẨM NÔNG SẢN TƯƠI - SẠCH</span>
                            <i class="ti-control-record"></i>
                            <i class="ti-control-record"></i>
                            <i class="ti-control-record"></i>
                        </div>
                        <div class="category__bot-title text-uppercases">
                            <h2>Mang thiên nhiên về với căn nhà của bạn</h2>
                        </div>
                    </div>
                </div>
                <!-- category list -->
                <div class="category__slick">
                    <div class="category__container overflow-hidden position-relative">
                        <div class="container">
                            <div class="row category__list">
                                <?php
                                $sql_home_cate = $conn->query("SELECT * FROM category ORDER BY category_id DESC ");
                                foreach ($sql_home_cate as $row_home_cate) {
                                    $home_cate_id = $row_home_cate['category_id'];
                                ?>
                                    <div class="col category__item position-relative" data-aos="fade-up" data-aos-duration="800">
                                        <a href="/PHP/ASM/pages/product.php?act=product&id=<?php echo $home_cate_id; ?>" class="category__link">
                                            <img loading="lazy" src="../assets/img/<?php echo $row_home_cate['category_img']; ?>" alt="img_category" />
                                        </a>
                                        <h6 class="position-absolute text-center">
                                            <?php echo $row_home_cate['category_name']; ?>
                                            <span>Mặt hàng ...</span>
                                        </h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img class="category__thumb-left position-absolute" data-aos="fade-up-right" data-aos-easing="linear" data-aos-duration="500" src="../assets/img/shape36.png" alt="img_category" />
    <img class="category__thumb-right position-absolute" data-aos="fade-up-left" data-aos-easing="linear" data-aos-duration="500" src="../assets/img/shape28.png" alt="img_category" />
</section>