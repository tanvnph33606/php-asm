<!-- featured -->



<section class="featured mt-5">
    <div class="featured__main position-relative">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col">
                    <div class="category__content" data-aos="fade-up-right" data-aos-duration="1000">
                        <div class="category__title text-start mb-5">
                            <div class="category__sub-title">
                                <i class="ti-control-record"></i>
                                <i class="ti-control-record"></i>
                                <i class="ti-control-record"></i>
                                <span>CÁC SẢN PHẨM NÔNG SẢN TƯƠI - SẠCH</span>
                            </div>
                            <div class="category__bot-title featured__bot-title text-uppercases">
                                <h2>các sản phẩm nổi bật</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex align-items-start justify-content-end" data-aos="fade-up-left" data-aos-duration="1000">
                    <a href="/PHP/ASM/pages/product.php?act=product&id=1" class="btn custom_btn featured__btn rounded-5 te d-flex align-items-center justify-content-between">
                        <span class="me-2">Xem thêm</span>
                        <i class="ti-arrow-right mt-1"></i>
                    </a>
                </div>
            </div>

            <div class="row justify-content-center align-items-center g-4 pt-5">
                <!-- featured-item -->
                <?php
                $sql_featured = $conn->query("SELECT * FROM product ORDER BY product_id DESC LIMIT 3");
                foreach ($sql_featured as $row_featured) {
                ?>
                    <div class="col-lg-4">

                        <div class="featured__item" data-aos="fade-up" data-aos-duration="1000">
                            <a class="featured__item-link" href="/PHP/ASM/pages/detail-product.php?act=product_detail&id=<?php echo $row_featured['product_id']; ?>">
                                <div class="featured__img d-flex justify-content-center align-items-center">
                                    <img src="../assets/img/<?php echo $row_featured['product_img']; ?>" alt="featured__img" />
                                </div>
                            </a>
                            <div class="rating d-flex align-items-center ms-4">
                                <ul class="rating__ul d-flex align-items-center">
                                    <li class="rating__li active">
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                    <li class="rating__li active">
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                    <li class="rating__li active">
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                    <li class="rating__li active">
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                    <li class="rating__li">
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </ul>
                                <span class="product-top__text">(4.2)</span>
                            </div>
                            <div class="product-top__content ms-4">
                                <div class="product-top__title"><?php echo $row_featured['product_name'] ?></div>
                                <div class="product-top__price">
                                    <span class="product-top__price-new"><?php echo number_format($row_featured['product_price_new']) . 'đ' ?></span>
                                    <span class="product-top__price-old"><?php echo number_format($row_featured['product_price_old']) . 'đ' ?></span>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
        <div class="featured__thumb position-absolute" data-aos="fade-left" data-aos-duration="800">
            <img src="../assets/img/shape30.png" alt="featured__thumb" />
        </div>
    </div>
</section>