<!-- banner -->
<?php
$sql_banner = $conn->query("SELECT * FROM home_banner");
foreach ($sql_banner as $row_banner) {

?>
    <section class="banner position-relative">
        <div style="background: url(../assets/img/<?php echo $row_banner['banner_bg']; ?>)" class="banner__main d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row text-center">
                    <div class="col banner__content">
                        <div class="banner__sub-title position-relative">
                            <h6 class="position-absolute"><?php echo $row_banner['banner_sub']; ?></h6>
                            <img src="../assets/img/shape2.png" alt="" />
                        </div>
                        <div class="banner__title text-capitalize">
                            <h1>
                                <?php echo $row_banner['banner_title']; ?>
                                <font class="text-first"><?php echo $row_banner['banner_title2']; ?>

                                    <font class="text-effect" style="margin-right: 9px">
                                        <span>L</span>
                                        <span>à</span>
                                        <span>n</span>
                                        <span>h</span>
                                    </font>
                                    <font class="text-effect">
                                        <span>M</span>
                                        <span>ạ</span>
                                        <span>n</span>
                                        <span>h</span>
                                    </font>
                                </font>
                            </h1>
                        </div>
                        <div class="banner__btn d-flex align-items-center justify-content-center">
                            <button class="btn custom_btn rounded-5 text-center d-flex align-items-center justify-content-between">
                                <span class="me-2">Đăng ký ngay</span>
                                <i class="ti-arrow-right mt-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <img class="banner__first position-absolute img_moving_anim1" src="../assets/img/<?php echo $row_banner['banner_thumb1']; ?> " alt="banner_thumb" />
        <img class="banner__second position-absolute img_moving_anim2" src="../assets/img/<?php echo $row_banner['banner_thumb2']; ?>" alt="banner_thumb" />
    </section>

<?php } ?>