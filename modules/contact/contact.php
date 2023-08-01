<section class="contact-top">
    <div class="container">
        <div class="row">
            <?php
            $sql_contact = $conn->query("SELECT * FROM contact");
            foreach ($sql_contact as $row_contact) {
            ?>
                <div class="col-lg-4">
                    <div data-aos="<?php echo $row_contact['contact_data_type'] ?>" data-aos-duration="1000" class="contact-top__item bg-white">
                        <div class="contact-top__icon">
                            <i class="<?php echo $row_contact['contact_icon'] ?>"></i>
                        </div>

                        <h3 class="contact-top__title text-uppercase"><?php echo $row_contact['contact_title'] ?></h3>
                        <div class="contact-top__content">
                            <p><?php echo $row_contact['contact_text'] ?></p>
                            <p><?php echo $row_contact['contact_text2'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div data-aos="fade-right" data-aos-duration="1000" class="contact-mid__item bg-white">
                    <div class="contact-mid__content text-center">
                        <h3 class="contact-mid__title text-capitalize">
                            Gửi thông tin liên hệ cho chúng tôi
                        </h3>
                        <p class="contact-mid__desc">
                            Bạn hãy điền nội dung tin nhắn vào form dưới đây. Chúng
                            tôi sẽ trả lời bạn ngay sau khi nhận được tin nhắn.
                        </p>
                    </div>
                    <form action="" method="post">
                        <div class="mb-4">
                            <input type="email" class="form-control contact-mid__input" placeholder="Họ và tên" />
                        </div>

                        <div class="mb-4">
                            <input type="email" class="form-control contact-mid__input" placeholder="Số điện thoại" />
                        </div>

                        <div class="mb-4">
                            <input type="email" class="form-control contact-mid__input" placeholder="Email của bạn" />
                        </div>

                        <div class="mb-4">
                            <textarea class="form-control contact-mid__textarea" rows="8" placeholder="Nhập tin nhắn"></textarea>
                        </div>

                        <div class="banner__btn d-flex align-items-center justify-content-center mt-4">
                            <button class="btn custom_btn rounded-5 text-center d-flex align-items-center justify-content-between">
                                <span class="me-2">Đăng ký ngay</span>
                                <i class="ti-arrow-right mt-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div data-aos="fade-left" data-aos-duration="1000" class="contact-mid__item bg-white">
                    <iframe loading="lazy" class="contact-mid__item-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8947408206723!2d105.83209177593979!3d21.0368972806145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aba15ec15d17%3A0x620e85c2cfe14d4c!2zTMSDbmcgQ2jhu6cgdOG7i2NoIEjhu5MgQ2jDrSBNaW5o!5e0!3m2!1svi!2s!4v1688307179842!5m2!1svi!2s" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>