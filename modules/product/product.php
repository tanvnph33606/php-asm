<!-- product -->

<section class="product__main active ">
    <div class="row gy-3">
        <?php
        if (isset($_GET['act']) && $_GET['act'] == 'product' && isset($_GET['id'])) {
            $id_url_cate = $_GET['id'] ?? '';
        }
        $sql_product = $conn->query("SELECT * FROM product WHERE category_id = $id_url_cate ORDER BY product_id DESC");
        foreach ($sql_product as $row_product) {
        ?>
            <div class="col-lg-4">
                <div data-aos="fade-up" data-aos-duration="1000" class="product__item mt-4">
                    <a href="/PHP/ASM/pages/detail-product.php?act=product_detail&id=<?php echo $row_product['product_id']; ?>" class="product__link">
                        <div class="product__top d-flex align-items-center justify-content-between mb-5">
                            <div class="product__top-type"><?php echo $row_product['product_type']; ?></div>
                            <div class="product__top-off"><?php echo $row_product['product_off'] . '%'; ?></div>
                        </div>

                        <div class="product__mid">
                            <img src="../assets/img/<?php echo $row_product['product_img']; ?>" alt="img_product" />
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
                            <span class="product__text">(4.8)</span>
                        </div>
                        <div class="product__content">
                            <div class="product__title"><?php echo $row_product['product_name']; ?></div>
                            <div class="product__price">
                                <span class="product__price-new"><?php echo number_format($row_product['product_price_new']) . 'đ'; ?></span>
                                <span class="product__price-old"><?php echo number_format($row_product['product_price_old']) . 'đ'; ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>


    </div>
</section>