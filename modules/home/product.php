<!-- product-top -->

<section class="pruduct-top position-relative">
    <div class="container">
        <div class="row">
            <div class="category__content" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000">
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
                        <h2>Các sản phẩm thiên nhiên mới</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- product_section -->
    <div class="product-top__section">
        <div class="container">
            <div class="row gy-3">

                <!-- product_item -->
                <?php
                $sql_product = $conn->query("SELECT * FROM product ORDER BY product_id DESC LIMIT 8");
                foreach ($sql_product as $row_product) {
                ?>
                    <div class="col-lg-3">

                        <div class="product-top__item mt-4" data-aos="fade-up" data-aos-duration="1000">
                            <a href="/PHP/ASM/pages/detail-product.php?act=product_detail&id=<?php echo $row_product['product_id']; ?>" class="product-top__link">
                                <div class="product-top__top d-flex align-items-center justify-content-between mb-5">
                                    <div class="product-top__top-type"><?php echo $row_product['product_type'] ?></div>
                                    <div class="product-top__top-off"><?php echo $row_product['product_off'] . '%' ?></div>
                                </div>

                                <div class="product-top__mid">
                                    <img src="/PHP/ASM/assets/img/<?php echo $row_product['product_img']; ?>" alt="img_product" />
                                </div>
                                <div class="rating d-flex align-items-center">
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
                                    <span class="product-top__text">(4.0)</span>
                                </div>
                                <div class="product-top__content">
                                    <div class="product-top__title"><?php echo $row_product['product_name'] ?></div>
                                    <div class="product-top__price">
                                        <span class="product-top__price-new"><?php echo number_format($row_product['product_price_new']) . 'đ' ?></span>
                                        <span class="product-top__price-old"><?php echo number_format($row_product['product_price_old']) . 'đ' ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php } ?>


            </div>
        </div>
    </div>
</section>