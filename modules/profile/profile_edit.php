<section class="profile">
    <!-- cá nhân -->
    <div class="container">
        <div class="profile__item">
            <div class="profile__heading">
                <h3>Hồ sơ của bạn</h3>
            </div>



            <!--  -->
            <?php
            if (isset($_SESSION['profile_message']) && isset($_SESSION['profile_type'])) {
                echo '<script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    }
                });

                Toast.fire({
                    icon: "' . $_SESSION['profile_type'] . '",
                    title: "' . $_SESSION['profile_message'] . '"
                });
                </script>';

                unset($_SESSION['profile_message']);
                unset($_SESSION['profile_type']);
            }



            $sql_profile = $conn->prepare("SELECT * FROM users WHERE user_id = :id");
            $sql_profile->execute([':id' => $row['user_id']]);
            $row_profile = $sql_profile->fetch(PDO::FETCH_ASSOC);

            ?>
            <div class="profile__content">
                <form action="../functions/edit_profile.php?id=<?php echo $row_profile['user_id'] ?>" class="profile__form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="profile__img col-lg-2 mt-5">
                            <?php
                            if (empty($row_profile['img'])) {
                            ?>
                                <a href="#">
                                    <img id="img-upload" src="../assets/img/not-acc.png" alt="profile__img" />
                                </a>
                            <?php } else { ?>
                                <a href="#">
                                    <img id="img-upload" src="../assets/img/<?php echo $row_profile['img'] ?>" alt="profile__img" />
                                </a>
                            <?php } ?>
                            <div class="profile__content-title">
                                <div>
                                    <input class="form-control d-none" type="file" name="img" id="formFile" />

                                    <div class="d-grid gap-2">
                                        <button type="button" name="" id="btn-upload" class="btn btn-success form__btn-btn ">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <span class="ms-1">Chọn ảnh đại diện</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-10">

                            <div class="row">
                                <div class="col-lg-4 mb-4">
                                    <label for="fullname" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Vui lòng cập nhập tên.." value="<?php echo $row_profile['fullname'] ?>" />
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Vui lòng cập nhập email.." value="<?php echo $row_profile['email'] ?>" />
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Vui lòng cập nhập số điện thoại.." value="<?php echo $row_profile['phone'] ?>" />
                                </div>
                                <!-- hiển thị dateTime -->
                                <?php
                                $dateTime = new DateTime($row_profile['created_at']);
                                $formattedDate = $dateTime->format('d/m/Y');
                                ?>

                                <div class="col-lg-4 mb-4">
                                    <label for="create_at" class="form-label">Ngày tạo (auto)</label>
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
                                    <textarea class="form-control" name="address" placeholder="Vui lòng cập nhập địa chỉ.." id="address" style="height: 10rem; padding-top: 1.1rem"><?php echo $row_profile['address'] ?></textarea>
                                </div>

                                <!-- hoàn thành -->
                                <div class="row d-flex justify-content-end">
                                    <div class="col-lg-2 d-flex justify-content-end">
                                        <div class="profile__content-btn mt-4">
                                            <a name="" id="" class="bg-dangerr" href="../pages/profile.php?act=profile" role="button"><i class="fa-solid fa-ban"></i> Hủy bỏ</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex justify-content-start">
                                        <div class="profile__content-btn mt-4">
                                            <button type="submit" name="" id="" class="btn__submit" role="button"><i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>