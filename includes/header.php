    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

    <?php
    session_start();
    // Kết nối đến cơ sở dữ liệu
    require_once '../admin/connect.php';


    ?>
    <!-- logo -->


    <div class="row justify-content-center align-items-center g-2 py-4">
        <div class="col-xl-2">
            <div class="header__logo">
                <a href="/PHP/ASM/index.php">
                    <img src="/PHP/ASM/assets/img/logo .png" alt="" />
                </a>
            </div>
        </div>

        <!-- navbar -->



        <div class="col-lg-6">
            <nav class="header__nav">
                <ul class="nav_ul d-flex justify-content-center p-0 align-content-center m-0">
                    <li class="nav__li">
                        <a href="./home.php" class="nav__link">Trang chủ</a>
                    </li>
                    <li class="nav__li">
                        <a href="./about.php" class="nav__link">Giới thiệu</a>
                    </li>
                    <li class="nav__li">
                        <div class="dropdown">
                            <a class="nav__link dropdown-toggle text-capitalize" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sản phẩm
                            </a>

                            <ul class="dropdown-menu">
                                <?php
                                $sql_cate = $conn->query("SELECT * FROM category");
                                foreach ($sql_cate as $row_cate) {
                                ?>
                                    <li>
                                        <a class="dropdown-item" href="../pages/product.php?act=product&id=<?php echo $row_cate['category_id'] ?>"><?php echo $row_cate['category_name'] ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>
                    <li class="nav__li">
                        <a href="./news.php" class="nav__link">Tin tức</a>
                    </li>
                    <li class="nav__li">
                        <a href="./contact.php" class="nav__link">Liên hệ</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="col-lg-4">
            <div class="header__user d-flex justify-content-end align-items-center">
                <form action="" method="" class="d-flex" style="margin-right: 30px">
                    <div class="position-relative">
                        <input type="email" class="header__user-search-input" placeholder="Tìm sản phẩm" />
                    </div>
                    <button type="submit" class="position-absolute" style="right: 33%">
                        <a class="header__user-link" style="background-color: transparent">
                            <i class="ti-search user__icon-search" style="color: var(--text-desc)"></i>
                        </a>
                    </button>
                </form>

                <!-- collapse user -->

                <a class="position-relative header__user-link" role="button" aria-expanded="false" aria-controls="collapseExample" data-bs-toggle="collapse" href="#header__user">
                    <i class="ti-user user__icon"></i>
                </a>

                <?php

                if (isset($_SESSION['account']) && !empty($_SESSION['account']) && $_SESSION['account']['role_id'] == 2) {
                    $row = $_SESSION['account'];

                    //lấy ra user
                    $sql_user = $conn->prepare("SELECT * FROM users WHERE user_id = :id");
                    $sql_user->execute(['id' => $row['user_id']]);
                    $row_user = $sql_user->fetch(PDO::FETCH_ASSOC);

                    $ad_name = $row_user['fullname'] ?? 'Đăng nhập';
                    $ad_img = $row_user['img'] ?? 'not-acc.png';
                }
                ?>

                <!-- Trường hợp đã đăng nhập -->
                <?php if (isset($row) && !empty($row) && $row['role_id'] == 2) { ?>
                    <div class="collapse header__has-profile" id="header__user">
                        <div class="header__profile-content">
                            <div class="header__profile-info">
                                <div class="header__profile-thumb">
                                    <img class="border" src="/PHP/ASM/assets/img/<?php echo empty($ad_img) ? 'not-acc.png' : $ad_img; ?>" alt="header__profile" />
                                </div>
                                <div class="header__profile-name">
                                    <h4 class="text-capitalize mb-0"><?php echo $ad_name; ?></h4>
                                </div>
                            </div>

                            <ul class="header__profile-option">
                                <li>
                                    <a href="../pages/profile.php?act=profile"><i class="fas fa-user-circle"></i> Thông tin</a>
                                </li>
                                <li>
                                    <a href="#!"><i class="fas fa-user-cog"></i> Cài đặt</a>
                                </li>
                                <li>
                                    <a href="../functions/logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>

                <!-- Trường hợp chưa đăng nhập -->
                <?php if (!isset($row) || empty($row) || $row['role_id'] != 2) { ?>
                    <div class="collapse header__not-profile" id="header__user">
                        <div class="header__profile-content">
                            <div style="opacity: 0.85" class="header__profile-info">
                                <div class="header__profile-thumb">
                                    <img class="border" src="/PHP/ASM/assets/img/not-acc.png" alt="header__profile" />
                                </div>
                                <div class="header__profile-name">
                                    <a href="/PHP/ASM/pages/login.php" class="text-capitalize">Đăng nhập</a>
                                </div>
                            </div>

                            <ul class="header__profile-option">
                                <li class="opacity-50 disabled-link">
                                    <a href="#!"><i class="fas fa-user-circle"></i> Thông tin</a>
                                </li>
                                <li class="opacity-50 disabled-link">
                                    <a href="#!"><i class="fas fa-user-cog"></i> Cài đặt</a>
                                </li>
                                <li class="opacity-50 disabled-link">
                                    <a href="#!"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>


                <!-- cart -->

                <a class="header__user-link user__icon-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ti-shopping-cart user__icon"></i>

                    <!-- hiển thị số lượng trong giỏ hàng -->
                    <?php
                    if (isset($_SESSION['account']) && !empty($_SESSION['account']) && $_SESSION['account']['role_id'] == 2) {
                        $row = $_SESSION['account'];
                        $sql_quantity = $conn->query("SELECT * FROM cart WHERE user_id = $row[user_id]");
                        $length_quantity = $sql_quantity->rowcount();
                    ?>
                        <span class="position-absolute user__icon-link-aleart">
                            <?php echo $length_quantity ?>
                        </span>
                    <?php } ?>

                </a>

                <!-- cart-canvas -->
                <section class="cart">
                    <div class="offcanvas offcanvas-end cart__main" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header cart__heading">
                            <h5 class="offcanvas-title cart__title" id="offcanvasRightLabel">
                                Giỏ hàng
                            </h5>
                            <button type="button" class="btn-close cart__btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="cart__body">

                                <!-- showcart -->
                                <?php
                                if (isset($_SESSION['account']) && !empty($_SESSION['account']) && $_SESSION['account']['role_id'] == 2) {
                                    $row = $_SESSION['account'];
                                    $sql_cart = $conn->query("SELECT * FROM cart WHERE user_id = $row[user_id]");
                                    $totalMoney = 0;

                                    foreach ($sql_cart as $row_cart) {
                                        $totalMoney += $row_cart['cart_price'] * $row_cart['quantity'];
                                ?>
                                        <div class="cart__item">
                                            <div class="cart__item-thumb">
                                                <img src="../assets/img/<?php echo $row_cart['cart_img'] ?>" alt="cart__item-thumb" />
                                            </div>
                                            <div class="cart__item-text">
                                                <div class="cart__item-heading">
                                                    <a href="/PHP/ASM/pages/detail-product.php?act=product_detail&id=<?php echo $row_cart['product_id']; ?>" class="cart__item-name"><?php echo $row_cart['cart_name'] ?></a>
                                                    <!-- xóa sản phẩm khỏi giỏ hàng -->
                                                    <button type="button" class="cart__item-remove" data-product-id="<?php echo $row_cart['product_id']; ?>">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>

                                                <div class="cart__item-price">
                                                    <div class="cart__item-price-new">
                                                        <?php echo number_format($row_cart['cart_price']) . 'đ'; ?>
                                                    </div>
                                                    <div class="cart__item-count">
                                                        <button type="button" class="price-minus" data-product-id="<?php echo $row_cart['product_id']; ?>" data-quantity="<?php echo $row_cart['quantity']; ?>">
                                                            <i class="fa-solid fa-minus"></i>
                                                        </button>
                                                        <span class="cart__item-amount"><?php echo $row_cart['quantity']; ?></span>
                                                        <button type="button" class="price-plus" data-product-id="<?php echo $row_cart['product_id']; ?>" data-quantity="<?php echo $row_cart['quantity']; ?>">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                } else { ?>
                                    <div class="cart__empty">
                                        <img class="cart__empty-img" src="../assets/img/cart-empty.png" alt="cart__item-empty">
                                        <div class="cart__empty-text text-capitalize text-center">
                                            Chưa có sản phẩm.
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                        <!-- bot -->
                        <div class="cart-footer">
                            <div class="cart__total">
                                <span class="cart__total-title">Tổng tiền</span>
                                <?php
                                if (isset($_SESSION['account']) && !empty($_SESSION['account']) && $_SESSION['account']['role_id'] == 2) {
                                ?>
                                    <span class="cart__total-price"><?php echo number_format($totalMoney) . 'đ' ?></span>
                                <?php } else { ?>
                                    <span class="cart__total-price">0đ</span>
                                <?php } ?>
                            </div>
                            <ul class="cart__ul">
                                <li class="cart__li"><a href="#">Xem giỏ hàng</a></li>
                                <li class="cart__li"><a href="#">Thanh toán</a></li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>