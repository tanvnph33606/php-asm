<!-- new-detail_left -->
<?php
try {
    $sql_news_top = $conn->prepare("SELECT news_id, news_title, news_user, DATE_FORMAT(news_date, '%d/%m/%Y') AS news_date FROM news WHERE news_id = :news_id");
    $sql_news_top->execute(['news_id' => $id_news]);
    $row_news_top = $sql_news_top->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
<div class="col-lg-8">
    <div class="news__title-left text-capitalize">
        <h2>
            <?php echo $row_news_top['news_title']; ?>
        </h2>
    </div>
    <div class="row gx-5">
        <div class="col-lg-12">
            <div class="news__container">
                <div class="news__content">
                    <div class="news__date d-flex justify-content-start align-items-center mt-0 mb-5">
                        <div>
                            <i class="fa-solid fa-user"></i>
                            <span class="pe-3 border-end"><?php echo $row_news_top['news_user']; ?></span>
                        </div>
                        <div>
                            <i class="ps-3 fa-solid fa-calendar-days"></i>
                            <span> <?php echo $row_news_top['news_date']; ?></span>
                        </div>
                    </div>

                    <?php
                    $sql_news_bot = $conn->prepare('SELECT * FROM news_detail WHERE news_id = :news_id');
                    $sql_news_bot->execute(['news_id' => $row_news_top['news_id']]);
                    $row_news_bot = $sql_news_bot->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="news__desc news__desc--detail mb-4">
                        <?php echo $row_news_bot['news_detail']; ?>
                    </div>

                </div>
                <!--  -->
                <div class="news__aticle">
                    <div class="news__list-group">
                        <div class="news__list-title">từ khóa:</div>
                        <ul class="news__tag-list">
                            <?php
                            $sql_news_tags = $conn->query("SELECT * FROM news ORDER BY news_id DESC LIMIT 5");
                            foreach ($sql_news_tags as $row_news_tags) {
                            ?>
                                <li><a href="#"><?php echo $row_news_tags['news_tags']; ?></a></li>
                            <?php } ?>

                        </ul>
                    </div>
                    <div class="news__list-group">
                        <div class="news__list-title">Chia sẻ:</div>

                        <ul class="news__share-list">
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
                </div>
                <!--  -->
                <div class="comment__form">
                    <div class="container">
                        <form action="" method="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="comment__form-title">
                                        Viết bình luận của bạn:
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
            </div>
        </div>
    </div>
</div>