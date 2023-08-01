<?php
session_start();
// Kết nối đến cơ sở dữ liệu
require_once '../admin/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>

    <!-- font themify -->
    <link rel="stylesheet" href="../assets/font/themify-icons/themify-icons.css" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/normalize.css" />
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/user-form.css" />

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/shape32.png" type="image/x-icon" />
</head>

<body>
    <div class="main">
        <section class="user__form">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                        <div class="user__form-logo">
                            <a href="../pages/home.php"><img src="../assets/img/logo .png" alt="logo" /></a>
                        </div>
                        <div class="user__form-card">
                            <div class="user__form-title">
                                <h2>Welcome!</h2>
                                <p>Sử dụng thông tin xác thực của bạn để truy cập</p>
                            </div>
                            <div class="user__form-group">
                                <ul class="user__form-social">
                                    <li>
                                        <a href="#" class="facebook"><i class="ti-facebook"></i>Tham gia với
                                            facebook</a>
                                    </li>
                                    <li>
                                        <a href="#" class="twitter"><i class="ti-twitter"></i>Tham gia với twitter</a>
                                    </li>
                                    <li>
                                        <a href="#" class="google"><i class="ti-google"></i>Tham gia với google</a>
                                    </li>
                                    <li>
                                        <a href="#" class="instagram"><i class="ti-instagram"></i>Tham gia với
                                            instagram</a>
                                    </li>
                                </ul>

                                <div class="user__form-divider">
                                    <p>or</p>
                                </div>

                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];

                                    $sql = $conn->prepare("SELECT * FROM users WHERE email = :email");
                                    $sql->execute([':email' => $email]);
                                    $row = $sql->fetch(PDO::FETCH_ASSOC);

                                    if ($row && password_verify($password, $row['password'])) {

                                        $_SESSION['account'] = $row;

                                        $redirectUrl = ($row['role_id'] == 1) ? "../pages_admin/index.php" : "../pages/home.php";
                                        echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "Thành công!",
                                            text: "Đăng nhập thành công!",
                                        }).then(() => {
                                            window.location.href = "' . $redirectUrl . '";
                                        });
                                        </script>';
                                    } else {
                                        echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Chú ý!",
                                            text: "Tài khoản hoặc mật khẩu không chính xác!",
                                        });
                                        </script>';
                                    }
                                }
                                ?>




                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="user__form needs-validation" novalidate>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form__input" placeholder="Nhập email của bạn" required />
                                        <div class="invalid-feedback">
                                            Vui lòng nhập đúng định dạng email.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form__input" placeholder="Nhập mật khẩu của bạn" required />
                                        <div class="invalid-feedback">
                                            Vui lòng nhập mật khẩu.
                                        </div>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input form__check" type="checkbox" value="" id="check" /><label class="form-check-label" for="check">Ghi nhớ</label>
                                    </div>
                                    <div class="form-button">
                                        <button type="submit">Đăng nhập</button>
                                        <p>
                                            Quên mật khẩu?<a href="reset-password.html">reset here</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="user__form-remind">
                            <p class="m-0">
                                Bạn chưa có tài khoản?<a href="../pages/register.php">register here</a>
                            </p>
                        </div>
                        <div class="user__form-footer">
                            <p>© All Copyrights Reserved by <a href="#">Vũ Ngọc Tân</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- jquery -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- main js -->
    <!-- <script src="../assets/js/main.js"></script> -->
    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>