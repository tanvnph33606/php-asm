<div class="filter">
    <div data-aos="fade-up" data-aos-duration="1000" class="filter__banner">
        <?php
        $sql_filter = $conn->query("SELECT filter_banner FROM product_filter WHERE filter_id = 1");
        foreach ($sql_filter as $row_filter) {
        ?>
            <a href="#" target="_blank" rel="noopener noreferrer">
                <img src="../assets/img/<?php echo $row_filter['filter_banner']; ?>" alt="filter__banner" />
            </a>
        <?php } ?>
    </div>

    <div data-aos="fade-up" data-aos-duration="1000" class="filter__category">
        <div class="filter__title">
            <h2>Loại sản phẩm</h2>
        </div>

        <div class="filter__list">
            <div class="filter__item">
                <?php
                $sql_filter = $conn->query("SELECT * FROM product_filter");
                foreach ($sql_filter as $row_filter) {
                ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?php echo $row_filter['filter_id']; ?>" id="<?php echo $row_filter['filter_id']; ?>" />
                        <label class="form-check-label" for="<?php echo $row_filter['filter_id']; ?>">
                            <?php echo $row_filter['filter_title']; ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div data-aos="fade-up" data-aos-duration="1000" class="filter__price">
        <div class="filter__title">
            <h2>Lọc theo giá</h2>
        </div>

        <div class="filter__range">
            <div class="filter__text">
                <div class="filter__text-min"></div>
                <div class="filter__text-max"></div>
            </div>

            <div id="filter__range-price" class="filter__range-price border-0"></div>
        </div>
    </div>
    <div data-aos="fade-up" data-aos-duration="1000" class="banner__btn d-flex align-items-center justify-content-center mt-4">
        <button class="btn custom_btn rounded-5 text-center d-flex align-items-center justify-content-between">
            <span class="me-2">Lọc giá</span>
            <i class="ti-arrow-right mt-1"></i>
        </button>
    </div>
</div>