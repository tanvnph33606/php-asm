<!-- subscribe -->
<?php
$sql_subc = $conn->query("SELECT * FROM about_subscribe");
foreach ($sql_subc as $row_subc) {
?>
    <section style="background-image: url(../assets/img/<?php echo $row_subc['subscribe_bg'] ?>)" class="subsc">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 z-1">
                    <form action="" method="">
                        <div class="subsc__input position-relative">
                            <input type="email" name="" id="" placeholder="Nhập địa chỉ email của bạn" class="" />
                            <div class="subsc__input-btn">
                                <button class="subsc__btn custom_btn text-uppercase">
                                    Đăng ký
                                    <i class="ti-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 z-1 text-end ps-5">
                    <h2 class="subsc__title text-capitalize mb-2">
                        <?php echo $row_subc['subscribe_title'] ?>
                    </h2>
                    <p class="subsc__desc">
                        <?php echo $row_subc['subscribe_desc'] ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

<?php } ?>