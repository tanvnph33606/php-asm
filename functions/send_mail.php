<?php
session_start();
//kết nối tới file
require '../assets/library/PHPMailer/src/PHPMailer.php';
require '../assets/library/PHPMailer/src/SMTP.php';
require '../assets/library/PHPMailer/src/Exception.php';
require '../assets/library/PHPMailer/language/phpmailer.lang-vi.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Cấu hình thông tin email
$smtpHost = 'smtp.gmail.com';
$smtpUsername = 'vungoctan.vnt63@gmail.com';
$smtpPassword = 'zgwmfskhiwupqysl';
$smtpPort = 587; // Hoặc cổng 465 


// Hàm tạo mã xác nhận
function generateCode($length = 6)
{
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}


// Gửi mã xác nhận qua email
function sendCode($email, $code)
{
    global $smtpHost, $smtpUsername, $smtpPassword, $smtpPort;

    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->setLanguage('vi', '../assets/library/PHPMailer/language/');
        $mail->CharSet = 'UTF-8';
        $mail->Host       = $smtpHost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUsername;
        $mail->Password   = $smtpPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Hoặc PHPMailer::ENCRYPTION_SMTPS nếu sử dụng 465
        $mail->Port       = $smtpPort;


        //thông tin người gửi và email nhận
        $mail->setFrom($smtpUsername, 'Admin Organi');
        $mail->addAddress($email);

        // tiêu đề và nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Mã xác nhận đổi mật khẩu';
        $mail->Body = 'Mã xác nhận của bạn là: <b>' . $code . '</b>';
        $mail->AltBody = 'Mã xác nhận của bạn là: ' . $code; // Nội dung thay thế cho email không hỗ trợ HTML

        // Gửi email
        $mail->send();
        echo 'Gửi thành email công.';
        return true;
    } catch (Exception $e) {
        echo 'Gửi không thành công. Lỗi: ', $mail->ErrorInfo;
        return false;
    }
}
