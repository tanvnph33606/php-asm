<?php
session_start();
// Các tab và địa chỉ liên kết 
$tabs = array(
    'dashboard' => 'Bảng điều khiển',
    'category' => 'Quản lý danh mục',
    'product' => 'Quản lý sản phẩm',
    'news' => 'Quản lý tin tức',
    'order' => 'Quản lý đơn hàng',

);

// tab icons
$tabIcons = array(
    'dashboard' => 'ti-dashboard',
    'category' => 'ti-bookmark',
    'product' => 'ti-dropbox',
    'news' => 'ti-image',
    'order' => 'ti-notepad',
);

// Xác định tab hiện tại nếu có
$act = isset($_GET['act']) ? $_GET['act'] : 'dashboard';
?>


<header>
    <!-- ========== Start sidebar ========== -->
    <?php

    if (isset($_SESSION['account']) && !empty($_SESSION['account']) && $_SESSION['account']['role_id'] == 1) {
        $row = $_SESSION['account'];
        $ad_name = $row['fullname'] ?? 'Admin';
        $ad_img = $row['img'] ?? 'admin_ad.jpg';
    } else {
        $ad_name = 'Admin';
        $ad_img = 'admin_ad.jpg';
    }
    ?>

    <section class="sidebar">
        <div class="avt">
            <div class="avt__img">
                <img src="../assets/img/<?php echo $ad_img; ?>" alt="avt__img" />
            </div>
            <h3 class="avt_name">
                <?php echo $ad_name; ?>
            </h3>
            <div class="avt_descc mt-2">Chào mừng bạn quay chở lại</div>
        </div>


        <div class="menu">
            <ul class="menu__ul">
                <?php foreach ($tabs as $tab => $label) { ?>
                    <li class="menu__li text-capitalize <?php if ($act === $tab) echo 'active'; ?>">
                        <a href="./index.php?act=<?php echo $tab; ?>" class="menu__link">
                            <i class="<?php echo $tabIcons[$tab]; ?>"></i>
                            <span class="menu__link-lable"><?php echo $label; ?></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>
    <!-- ========== End sidebar ========== -->


    <!-- ========== Start content ========== -->
    <section class="nav__bar">
        <div class="nav_search col-3">
            <form action="">
                <div class="input-group position-relative">
                    <input type="text" class="form-control nav__input" placeholder="Tìm kiếm..." aria-label="Recipient's username" aria-describedby="button-addon2" />
                </div>
            </form>
        </div>

        <div class="nav__notify">
            <ul class="nav__notify-list">
                <li class="nav__notify-item">
                    <button type="button" class="btn btn-link">
                        <div class="position-relative">
                            <i class="fa-solid fa-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                            </span>
                        </div>
                    </button>
                </li>
                <li class="nav__notify-item">
                    <button type="button" class="btn btn-link">
                        <div class="position-relative">
                            <i class="fa-solid fa-envelope"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                            </span>
                        </div>
                    </button>
                </li>

                <li class="nav__notify-item">
                    <a href="../index.php" class="btn btn-link position-relative">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <!-- ========== End content ========== -->
</header>