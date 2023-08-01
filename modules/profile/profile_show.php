<section class="profile">
    <!-- cá nhân -->
    <div class="container">
        <div class="profile__item">
            <div class="profile__heading">
                <h3>Hồ sơ của bạn</h3>
                <a href="../pages/profile.php?act=profile-edit" class="btn profile__heading-btn">
                    Chỉnh sửa
                </a>
            </div>

            <!--  -->
            <?php
            $sql_profile = $conn->prepare("SELECT * FROM users WHERE user_id = :id");
            $sql_profile->execute([':id' => $row['user_id']]);
            $row_profile = $sql_profile->fetch(PDO::FETCH_ASSOC);

            ?>

            <div class="profile__content">
                <div class="row">
                    <div class="profile__img col-lg-2 mt-5">
                        <?php
                        if (empty($row_profile['img'])) {
                        ?>
                            <a href="#">
                                <img src="../assets/img/not-acc.png" alt="profile__img" />
                            </a>
                        <?php } else { ?>
                            <a href="#">
                                <img src="../assets/img/<?php echo $row_profile['img'] ?>" alt="profile__img" />
                            </a>
                        <?php } ?>
                        <div class="profile__content-title">
                            <h4><?php echo $row_profile['fullname'] ?></h4>
                            <p>Chào mừng bạn quay chở lại.</p>
                        </div>

                    </div>

                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <label for="fullname" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" readonly placeholder="Vui lòng cập nhập tên.." value="<?php echo $row_profile['fullname'] ?>" />
                            </div>
                            <div class="col-lg-4 mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Vui lòng cập nhập email.." readonly value="<?php echo $row_profile['email'] ?>" />
                            </div>
                            <div class="col-lg-4 mb-4">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Vui lòng cập nhập số điện thoại.." readonly value="<?php echo $row_profile['phone'] ?>" />
                            </div>
                            <!-- hiển thị dateTime -->
                            <?php
                            $dateTime = new DateTime($row_profile['created_at']);
                            $formattedDate = $dateTime->format('d/m/Y');
                            ?>

                            <div class="col-lg-4 mb-4">
                                <label for="create_at" class="form-label">Ngày tạo</label>
                                <input type="text" class="form-control" name="create_at" id="create_at" placeholder="Bạn chưa có tài khoản.." readonly value="<?php echo  $formattedDate ?>" />
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Bạn chưa có tài khoản.." value="<?php echo $row_profile['password'] ?>" readonly />
                            </div>

                            <div class="col-lg-2">
                                <div class="profile__content-btn">
                                    <a name="" id="" class="" href="#" role="button">Đổi mật khẩu</a>
                                </div>
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <textarea class="form-control" name="address" placeholder="Vui lòng cập nhập địa chỉ.." id="address" style="height: 10rem; padding-top: 1.1rem" readonly><?php echo $row_profile['address'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>