<div class="col-lg-6">

    <div data-aos="fade-right" data-aos-duration="1000" class="detail__gallery">
        <div class="detail__priview">
            <div class="detail__priview-list">
                <?php
                $sql_thumb_top = $conn->query("SELECT * FROM product_thumb WHERE product_id = $id_pro LIMIT 5");;
                foreach ($sql_thumb_top as $row_thumb_top) {
                ?>
                    <div class="detail__priview-item">
                        <img src=" ../assets/img/thumb/<?php echo $row_thumb_top['img']; ?>" alt="detail__thumb-item" />
                    </div>
                    <!-- class="img_moving_anim1 position-relative" -->
                <?php } ?>



            </div>
        </div>
        <div class="detail__thumb">
            <div class="detail__thumb-list d-flex">
                <?php
                $sql_thumb_bot = $conn->query("SELECT * FROM product_thumb WHERE product_id = $id_pro LIMIT 5");
                $first_image = true; // Biến kiểm tra ảnh đầu tiên
                foreach ($sql_thumb_bot as $row_thumb_bot) {
                    $active_class = $first_image ? 'active' : '';
                    $first_image = false; // Đánh dấu đã có ảnh đầu tiên
                ?>
                    <div class="detail__thumb-item <?php echo $active_class; ?>">
                        <img src="../assets/img/thumb/<?php echo $row_thumb_bot['img']; ?>" alt="detail__thumb-item" />
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>