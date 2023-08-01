<!-- comment -->
<section style="background-image: url(../assets/img/testimonial-shape.png)" class="comment" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="comment__list">
                <?php $sql_comment_bot = $conn->query("SELECT * FROM home_comment ORDER BY comment_id DESC");
                foreach ($sql_comment_bot as $row_comment_bot) {
                ?>
                    <div class="comment__item">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center">
                            <div class="comment__img position-relative">
                                <div>
                                    <img class="comment__img-avt" src="../assets/img/<?php echo $row_comment_bot['comment_img'] ?>" alt="comment__img" />
                                </div>

                                <div class="comment__thumb-left position-absolute">
                                    <img src="../assets/img/shape32.png " alt="comment__img" />
                                </div>
                                <div class="comment__thumb-right position-absolute">
                                    <img src="../assets/img/shape24.png" alt="comment__img" />
                                </div>
                            </div>
                            <div class="comment__content mt-3">
                                <div class="comment__icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <div class="comment__desc">
                                    <?php echo $row_comment_bot['comment_desc'] ?>
                                </div>
                                <div class="comment__name text-capitalize d-flex align-items-center">
                                    <span><?php echo $row_comment_bot['comment_name'] ?> </span>
                                    <span><?php echo $row_comment_bot['comment_major'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
    </div>
</section>