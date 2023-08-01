<!-- ogranic -->

<section class="ogranic position-relative" data-aos="fade-up" data-aos-duration="1000">
    <div class="ogranic__main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col">
                            <div class="category__content">
                                <div class="category__title text-start mb-5">
                                    <div class="category__sub-title">
                                        <i class="ti-control-record"></i>
                                        <i class="ti-control-record"></i>
                                        <i class="ti-control-record"></i>
                                        <span>CÁC SẢN PHẨM NÔNG SẢN TƯƠI - SẠCH</span>
                                    </div>
                                    <div class="category__bot-title featured__bot-title text-uppercases">
                                        <h2>các sản phẩm hữu cơ tốt</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <button class="btn custom_btn featured__btn rounded-5 te d-flex align-items-center justify-content-between">
                                <span class="me-2">Xem thêm</span>
                                <i class="ti-arrow-right mt-1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row g-4 mt-3">

                        <?php
                        $sql_ogranic = $conn->query("SELECT * FROM product ORDER BY product_id DESC LIMIT 6");
                        foreach ($sql_ogranic as $row_ogranic) {
                        ?>
                            <div data-aos="fade-up" data-aos-duration="1000" class="col-lg-6">
                                <a class="ogranic__item-link" href="/PHP/ASM/pages/detail-product.php?act=product_detail&id=<?php echo $row_ogranic['product_id']; ?>">
                                    <div class="ogranic__item d-flex flex-row align-items-center bg-white">
                                        <div class="ogranic__img">
                                            <img src="../assets/img/<?php echo $row_ogranic['product_img']; ?>" alt="ogranic_img" />
                                        </div>
                                        <div class="ogranic__content ">
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
                                                <span class="product-top__text">(4.3)</span>
                                            </div>
                                            <div class="product-top__content ms-4">
                                                <div class="product-top__title mb-3"><?php echo $row_ogranic['product_name']; ?></div>
                                                <div class="product-top__price">
                                                    <span class="product-top__price-new"><?php echo number_format($row_ogranic['product_price_new']) . 'đ'; ?></span>
                                                    <span class="product-top__price-old"><?php echo number_format($row_ogranic['product_price_old']) . 'đ'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php } ?>

                    </div>

                    <div class="ogranic__thumb-left position-absolute" data-aos="fade-up-right" data-aos-duration="1000">
                        <img src="../assets/img/product47.png" alt="img_ogranic" />
                    </div>
                    <div class="ogranic__thumb-top position-absolute">
                        <img src="../assets/img/product46.png" alt="img_ogranic" />
                    </div>
                    <div class="ogranic__thumb-right position-absolute">
                        <img src="../assets/img/shape31.png" alt="img_ogranic" />
                    </div>

</section>