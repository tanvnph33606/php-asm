<div class="col-lg-4">
    <div class="news__title-right">
        <h2>Tin nổi bật</h2>
    </div>
    <div class="row gy-4">
        <?php
        $sql_news_main = $conn->query("SELECT * FROM news ORDER BY news_id DESC ");
        foreach ($sql_news_main as $row_news_main) {
        ?>
            <div class="col-lg-12">
                <a data-aos="fade-up" data-aos-duration="1200" href="/PHP/ASM/pages/detail-news.php?act=news_detail&id=<?php echo $row_news_main['news_id']; ?>" class="news__side d-flex">
                    <div class="news__side-img">
                        <img src="../assets/img/<?php echo $row_news_main['news_img']; ?>" alt="detail-news-img" />
                    </div>
                    <p class="news__side-content">
                        <?php echo $row_news_main['news_title']; ?>
                    </p>
                </a>
            </div>
        <?php } ?>
    </div>
</div>