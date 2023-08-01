<section class="choose">
    <div class="choose__main">
        <div class="container">
            <div class="row">
                <?php
                $sql_choose = $conn->prepare("SELECT choose_title FROM about_choose WHERE choose_id = 1");
                $sql_choose->execute();
                $row_choose = $sql_choose->fetch(PDO::FETCH_ASSOC);
                ?>
                <h2 class="choose__title text-capitalize" class="col-lg-6">
                    <?php echo $row_choose['choose_title'] ?>
                </h2>
            </div>
            <div class="row g-5">
                <?php
                $sql_choose_bot = $conn->query("SELECT * FROM about_choose");
                foreach ($sql_choose_bot as $row_choose_bot) {
                ?>

                    <div class="col-lg-6">
                        <div class="choose__item">
                            <div class="choose__icon">
                                <i class="<?php echo $row_choose_bot['choose_icon'] ?>"></i>
                            </div>
                            <div class="choose__text">
                                <h5 class="text-capitalize mb-4">
                                    <?php echo $row_choose_bot['choose_text_h5'] ?>
                                </h5>
                                <p>
                                    <?php echo $row_choose_bot['choose_text_p'] ?>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php } ?>


            </div>
        </div>
    </div>

</section>