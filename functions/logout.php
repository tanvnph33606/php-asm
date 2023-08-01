<?php
session_start();
session_unset(); // xóa hết session
session_destroy(); // hủy session


header("Location: /PHP/ASM/pages/home.php");
exit();
