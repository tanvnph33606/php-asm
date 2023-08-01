<!-- store -->
<?php
$sql_store = $conn->query("SELECT * FROM home_store LIMIT 1");
foreach ($sql_store as $row_store) {
?>
    <section class="store" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
        <div style="background-image: url(../assets/img/<?php echo $row_store['store_bg'] ?> )" class="store__main position-relative">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="store__thumb">
                            <img class="img_moving_anim1 position-relative" src="../assets/img/<?php echo $row_store['store_img'] ?>" alt="img_store" />
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="store__text">
                            <div class="category__title text-start mb-5">
                                <div class="category__sub-title">
                                    <i class="ti-control-record"></i>
                                    <i class="ti-control-record"></i>
                                    <i class="ti-control-record"></i>
                                    <span>Các sản phẩm tươi sạch</span>
                                    <i class="ti-control-record"></i>
                                    <i class="ti-control-record"></i>
                                    <i class="ti-control-record"></i>
                                </div>
                                <div class="store__content-title text-uppercases">
                                    <h2>
                                        <?php echo $row_store['store_title'] ?>
                                        <font class="text-effect me-3">
                                            <span>T</span>
                                            <span>h</span>
                                            <span>ự</span>
                                            <span>c</span>
                                        </font>
                                        <font class="text-effect">
                                            <span>P</span>
                                            <span>h</span>
                                            <span>ẩ</span>
                                            <span>m</span>
                                        </font>
                                        <?php echo $row_store['store_title2'] ?>
                                    </h2>
                                </div>
                                <div class="store__content-desc">
                                    <h4>
                                        <?php echo $row_store['store_desc'] ?>
                                    </h4>
                                </div>
                            </div>

                            <div class="store__item py-2">
                                <a href="#" class="store__item-link" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="store__img">
                                        <img src="../assets/img/<?php echo $row_store['store_icon_img'] ?>" alt="img_store" />
                                    </div>
                                    <div class="store-item__text">
                                        <p data-aos="fade-up" data-aos-duration="4000">
                                            <?php echo $row_store['store_icon_text'] ?>
                                        </p>
                                    </div>
                                </a>

                                <a href="#" class="store__item-link" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="store__img">
                                        <img src="../assets/img/<?php echo $row_store['store_icon_img2'] ?>" alt="img_store" />
                                    </div>
                                    <div class="store-item__text">
                                        <p data-aos="fade-up" data-aos-duration="2000">
                                            <?php echo $row_store['store_icon_text2'] ?>
                                        </p>
                                    </div>
                                </a>
                                <a href="#" class="store__item-link"> </a>
                            </div>

                            <div class="banner__btn d-flex align-items-center">
                                <button class="btn custom_btn rounded-5 te d-flex align-items-center justify-content-between">
                                    <span class="me-2">Đăng ký ngay</span>
                                    <i class="ti-arrow-right mt-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="position-absolute" style="top: 0; right: 0" src="../assets/img/<?php echo $row_store['store_thumb'] ?>" alt="img_store" />
        </div>
    </section>

<?php } ?>