<section data-aos="fade-up" data-aos-duration="1300">
    <div class="container">
        <div class="inner__main">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <!-- mô tả -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                                Thông tin sản phẩm
                            </button>
                        </li>

                        <!-- đnahs giá -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review" aria-selected="false">
                                Đánh giá (3)
                            </button>
                        </li>
                    </ul>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- tab-pane -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                                    <?php
                                    $sql_tabs_desc = $conn->prepare("SELECT * FROM product_detail WHERE product_id = :id");
                                    $sql_tabs_desc->execute([
                                        'id' => $id_pro
                                    ]);
                                    $row_tabs_desc = $sql_tabs_desc->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <section class="tab__desc">
                                        <?php echo $row_tabs_desc['product_detail']; ?>
                                    </section>
                                </div>

                                <!-- đánh giá -->

                                <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab" tabindex="0">
                                    <section class="tab__review">
                                        <div class="tab__review-main">
                                            <div class="review__heading">
                                                <h3 class="review__name text-capitalize">
                                                    Sơn tùng MTP
                                                </h3>
                                                <span class="review__date">
                                                    <i class="far fa-calendar-alt"></i>
                                                    Tháng Sáu 02, 2023
                                                </span>
                                            </div>
                                            <div class="review__rating">
                                                <div class="details__rating">
                                                    <i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>

                                            <div class="review__cmt">
                                                Lorem ipsum dolor sit amet consectetur
                                                adipisicing elit. Perspiciatis corrupti quae
                                                quisquam in dolorum soluta dolorem quibusdam
                                                nostrum iste doloribus ad, aliquam voluptas
                                                consectetur minus fuga quaerat libero
                                                accusantium quas!
                                            </div>
                                            <div class="review__reply">
                                                <form action="">
                                                    <div class="mb-3 review__reply-box">
                                                        <input type="text" name="" id="" class="form-control review__reply-input" placeholder="Trả lời suy nghĩ của bạn" aria-describedby="helpId" />
                                                    </div>
                                                    <button type="button" class="btn review__reply-btn">
                                                        Gửi đi
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!--  -->

                                        <div class="tab__review-main">
                                            <div class="review__heading">
                                                <h3 class="review__name text-capitalize">
                                                    Sơn tùng MTP
                                                </h3>
                                                <span class="review__date">
                                                    <i class="far fa-calendar-alt"></i>
                                                    Tháng Sáu 02, 2023
                                                </span>
                                            </div>
                                            <div class="review__rating">
                                                <div class="details__rating">
                                                    <i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>

                                            <div class="review__cmt">
                                                Lorem ipsum dolor sit amet consectetur
                                                adipisicing elit. Perspiciatis corrupti quae
                                                quisquam in dolorum soluta dolorem quibusdam
                                                nostrum iste doloribus ad, aliquam voluptas
                                                consectetur minus fuga quaerat libero
                                                accusantium quas!
                                            </div>
                                            <div class="review__reply">
                                                <form action="">
                                                    <div class="mb-3 review__reply-box">
                                                        <input type="text" name="" id="" class="form-control review__reply-input" placeholder="Trả lời suy nghĩ của bạn" aria-describedby="helpId" />
                                                    </div>
                                                    <button type="button" class="btn review__reply-btn">
                                                        Gửi đi
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!--  -->
                                        <div class="tab__review-main">
                                            <div class="review__heading">
                                                <h3 class="review__name text-capitalize">
                                                    Sơn tùng MTP
                                                </h3>
                                                <span class="review__date">
                                                    <i class="far fa-calendar-alt"></i>
                                                    Tháng Sáu 02, 2023
                                                </span>
                                            </div>
                                            <div class="review__rating">
                                                <div class="details__rating">
                                                    <i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="active fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>

                                            <div class="review__cmt">
                                                Lorem ipsum dolor sit amet consectetur
                                                adipisicing elit. Perspiciatis corrupti quae
                                                quisquam in dolorum soluta dolorem quibusdam
                                                nostrum iste doloribus ad, aliquam voluptas
                                                consectetur minus fuga quaerat libero
                                                accusantium quas!
                                            </div>
                                            <div class="review__reply">
                                                <form action="">
                                                    <div class="mb-3 review__reply-box">
                                                        <input type="text" name="" id="" class="form-control review__reply-input" placeholder="Trả lời suy nghĩ của bạn" aria-describedby="helpId" />
                                                    </div>
                                                    <button type="button" class="btn review__reply-btn">
                                                        Gửi đi
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- thêm đánh giá của bạn -->
                                        <div class="comment__form">
                                            <div class="container">
                                                <form action="" method="">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h3 class="comment__form-title">
                                                                Đánh giá của bạn
                                                            </h3>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="comment__form-rating text-center">
                                                                <div class="rating">
                                                                    <input value="star-1" name="star-radio" id="star-1" type="radio" />
                                                                    <label for="star-1">
                                                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
                                                                        </svg>
                                                                    </label>
                                                                    <input value="star-1" name="star-radio" id="star-2" type="radio" />
                                                                    <label for="star-2">
                                                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
                                                                        </svg>
                                                                    </label>
                                                                    <input value="star-1" name="star-radio" id="star-3" type="radio" />
                                                                    <label for="star-3">
                                                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
                                                                        </svg>
                                                                    </label>
                                                                    <input value="star-1" name="star-radio" id="star-4" type="radio" />
                                                                    <label for="star-4">
                                                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
                                                                        </svg>
                                                                    </label>
                                                                    <input value="star-1" name="star-radio" id="star-5" type="radio" />
                                                                    <label for="star-5">
                                                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
                                                                        </svg>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="comment__form-desc">
                                                                <div class="form-group">
                                                                    <textarea class="form-control comment__form-desc-textarea" placeholder="Nhập vào đánh giá của bạn"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="comment__form-name">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control comment__form-name-input" placeholder="Họ và tên" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="comment__form-email">
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control comment__form-email-input" placeholder="Email" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="comment__form-submit">
                                                                <button class="btn comment__form-btn">
                                                                    <span>Gửi đánh giá của bạn</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>