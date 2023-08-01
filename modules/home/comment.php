<!-- comment -->
<section class="comment" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <!-- comment-title -->
            <div class="category__content">
                <?php $sql_comment = $conn->query("SELECT * FROM home_comment WHERE comment_id = 1  ");
                foreach ($sql_comment as $row_comment) {
                ?>
                    <div class="category__title text-center mb-5">
                        <div class="category__sub-title">
                            <i class="ti-control-record"></i>
                            <i class="ti-control-record"></i>
                            <i class="ti-control-record"></i>
                            <span><?php echo $row_comment['comment_sub_top'] ?></span>
                            <i class="ti-control-record"></i>
                            <i class="ti-control-record"></i>
                            <i class="ti-control-record"></i>
                        </div>
                        <div class="category__bot-title text-uppercases">
                            <h2><?php echo $row_comment['comment_sub_bot'] ?></h2>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="comment__list">
                <?php $sql_comment = $conn->query("SELECT * FROM home_comment ORDER BY comment_id DESC");
                foreach ($sql_comment as $row_comment) {
                ?>
                    <div class="comment__item">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center">
                            <div class="comment__img position-relative">
                                <div>
                                    <img class="comment__img-avt" src="../assets/img/<?php echo $row_comment['comment_img'] ?>" alt="comment__img" />
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
                                    <?php echo $row_comment['comment_desc'] ?>
                                </div>
                                <div class="comment__name text-capitalize d-flex align-items-center">
                                    <span><?php echo $row_comment['comment_name'] ?> </span>
                                    <span><?php echo $row_comment['comment_major'] ?></span>
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