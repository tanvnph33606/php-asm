<!-- company -->

<section class="about" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6" class="col-lg-6" class="about" data-aos="fade-right" data-aos-duration="1000">
                <div class="row g-3">
                    <!-- ảnh left -->
                    <?php
                    $sql_company = $conn->query("SELECT company_id, company_img FROM about_company ORDER BY company_id DESC LIMIT 4");
                    foreach ($sql_company as $row_company) {
                    ?>
                        <div class="col-6">
                            <img class="about__img" src="../assets/img/<?php echo $row_company['company_img']; ?>" alt="about__img" />
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-6" class="about" data-aos="fade-left" data-aos-duration="1000">
                <div class="about__content ps-5 text-lg-end">
                    <!-- text-right -->
                    <?php
                    $sql_company = $conn->prepare("SELECT company_title, company_desc FROM about_company WHERE company_id = 1 LIMIT 1");
                    $sql_company->execute();
                    $row_company = $sql_company->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <h2 class="about__title">
                        <?php echo $row_company['company_title']; ?>
                    </h2>
                    <p class="about__desc">
                        <?php echo $row_company['company_desc']; ?>
                    </p>

                    <div class="about__list">
                        <div class="row gx-5">
                            <!-- bottom -->
                            <?php
                            $sql_company_num = $conn->query("SELECT  company_num, company_text FROM about_company LIMIT 3");
                            foreach ($sql_company_num as $row_company_num) {
                            ?>
                                <div class="col about__item">
                                    <h5 class="about__list-num"><?php echo $row_company_num['company_num']; ?></h5>
                                    <div class="about__list-text text-capitalize">
                                        <?php echo $row_company_num['company_text']; ?>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>