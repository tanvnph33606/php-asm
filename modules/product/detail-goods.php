<!-- detail-goods -->
<?php

$sql_info = $conn->prepare("SELECT * FROM product WHERE product_id = :id");
$sql_info->execute(
    [
        ':id' => $id_pro,
    ]
);
$row_info = $sql_info->fetch(PDO::FETCH_ASSOC);

// kiểm tra và hiển thị thông báo
if (isset($_SESSION['cart_message'])) {
    echo '<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
    });

    Toast.fire({
        icon: "success",
        title: "' . $_SESSION['cart_message'] . '"
    });
    </script>';

    unset($_SESSION['cart_message']);
}
?>




<div class="col-lg-6">
    <div data-aos="fade-left" data-aos-duration="1000" class="details__content">
        <h3 class="details__name">
            <a href="#"><?php echo $row_info['product_name']; ?></a>
        </h3>

        <div class="details__meta">
            <p>Mã SP:<span><?php echo $row_info['product_brand'] . $row_info['product_id']  ?></span></p>
            <p>Kho:<span><?php echo $row_info['product_quantity'] ?></span></p>
            <p>Thương hiệu:<a href="#pills-description-tab"><?php echo $row_info['product_brand'] ?></a></p>

        </div>
        <div class="details__rating">
            <i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="fa-solid fa-star"></i><a href="#pills-review-tab">(3 Đánh giá)</a>
        </div>
        <h3 class="details__price">
            <del><?php echo number_format($row_info['product_price_old']) . 'đ'; ?></del><span><?php echo number_format($row_info['product_price_new']) . 'đ'; ?><small>/kilogram</small></span>
        </h3>
        <div class="details__desc mb-0">
            <?php echo $row_info['product_desc']; ?>
        </div>
        <div class="details__list-group mt-5">
            <div class="details__list-title">từ khóa:</div>
            <ul class="details__tag-list">
                <li><a href="#"><?php echo $row_info['product_tag']; ?></a></li>

                <?php $sql_pro_tags = $conn->query("SELECT product_tag FROM product ORDER BY product_id DESC LIMIT 2");
                foreach ($sql_pro_tags as $row_pro_tags) {
                ?>
                    <li><a href="#"><?php echo $row_pro_tags['product_tag']; ?></a></li>
                <?php } ?>

            </ul>
        </div>
        <div class="details__list-group">
            <div class="details__list-title">chia sẻ:</div>

            <ul class="details__share-list">
                <li>
                    <a href="#" class="ti-facebook"></a>
                </li>
                <li>
                    <a href="#" class="ti-twitter-alt"></a>
                </li>
                <li>
                    <a href="#" class="ti-linkedin"></a>
                </li>
                <li>
                    <a href="#" class="ti-instagram"></a>
                </li>
            </ul>
        </div>

        <div class="details__add-group">
            <?php if ($row_info['product_quantity'] > 0) { ?>
                <a href="../functions/add_cart.php?id=<?php echo $row_info['product_id']; ?>" class="product-add">
                    <i class="fas fa-shopping-basket me-2"></i><span>thêm vào giỏ hàng</span>
                </a>
            <?php } else { ?>
                <a href="#" class="product-add opacity-50 disabled-link">
                    <i class="fas fa-shopping-basket me-2"></i><span>thêm vào giỏ hàng (hết hàng)</span>
                </a>
            <?php } ?>
        </div>


        <div class="details__action-group">
            <a class="details__wish wish" href="#"><i class="fa-solid fa-heart me-2"></i><span>Thêm vào yêu thích</span></a><a class="details__compare" href="#"><i class="fas fa-random me-2"></i><span>So sánh sản phẩm</span></a>
        </div>
    </div>
</div>