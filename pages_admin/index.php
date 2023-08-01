<?php
// Kết nối đến cơ sở dữ liệu
require_once '../admin/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>

  <!-- font themify -->
  <link rel="stylesheet" href="../assets/font/themify-icons/themify-icons.css" />

  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

  <!-- sweet alert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

  <!-- data-table -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
  <!-- CSS -->
  <link rel="stylesheet" href="../assets/css/normalize.css" />
  <link rel="stylesheet" href="../assets/css/base.css" />
  <link rel="stylesheet" href="../assets/css/ad-index.css" />

  <!-- favicon -->
  <link rel="shortcut icon" href="../assets/img/admin_icon_131692.png" type="image/x-icon" />
</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
  <div class="main">
    <!-- header -->
    <header>
      <?php include_once 'admin_header.php'; ?>
    </header>



    <!-- ========== Start content_main ========== -->
    <main>
      <?php
      if (isset($_GET['act'])) {
        $act = $_GET['act'];
        switch ($act) {
          case 'dashboard':
            include_once './dashboard.php';
            break;
          case 'category':
            include_once './admin_cate.php';
            break;
          case 'product':
            include_once './admin_pro.php';

            break;
          case 'order':
            include_once './admin_order.php';

            break;
          case 'news':
            include_once './admin_news.php';

            break;
          default:
            include_once './dashboard.php';
            break;
        }
      } else {
        include_once './dashboard.php';
      }
      ?>
    </main>

    <!-- ========== End content_main ========== -->
  </div>


  <!-- boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


  <!-- jquery -->

  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

  <!-- data-table -->
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <!-- moment js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <!-- ckeditor -->
  <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/ckeditor.js"></script>

  <!-- main js -->
  <!-- <script src="../assets/js/main.js"></script> -->
  <script>
    //datatable
    $(document).ready(function() {
      $('#content_tbl_main').DataTable({
        "order": [
          [0, "desc"]
        ]
      });
    });



    //Time
    if ($('#content__time').length) {

      (function(global, factory) {
        typeof exports === "object" &&
          typeof module !== "undefined" &&
          typeof require === "function" ?
          factory(require("../moment")) :
          typeof define === "function" && define.amd ?
          define(["../moment"], factory) :
          factory(global.moment);
      })(this, function(moment) {
        "use strict";

        //! moment.js locale configuration

        var vi = moment.defineLocale("vi", {
          months: "tháng 1_tháng 2_tháng 3_tháng 4_tháng 5_tháng 6_tháng 7_tháng 8_tháng 9_tháng 10_tháng 11_tháng 12".split(
            "_"
          ),
          monthsShort: "Thg 01_Thg 02_Thg 03_Thg 04_Thg 05_Thg 06_Thg 07_Thg 08_Thg 09_Thg 10_Thg 11_Thg 12".split(
            "_"
          ),
          monthsParseExact: true,
          weekdays: "Chủ nhật_Thứ hai_Thứ ba_Thứ tư_Thứ năm_Thứ sáu_Thứ bảy".split("_"),
          weekdaysShort: "CN_T2_T3_T4_T5_T6_T7".split("_"),
          weekdaysMin: "CN_T2_T3_T4_T5_T6_T7".split("_"),
          weekdaysParseExact: true,
          meridiemParse: /sa|ch/i,
          isPM: function(input) {
            return /^ch$/i.test(input);
          },
          meridiem: function(hours, minutes, isLower) {
            if (hours < 12) {
              return isLower ? "sa" : "SA";
            } else {
              return isLower ? "ch" : "CH";
            }
          },
          longDateFormat: {
            LT: "HH:mm",
            LTS: "HH:mm:ss",
            L: "DD/MM/YYYY",
            LL: "D MMMM [năm] YYYY",
            LLL: "D MMMM [năm] YYYY HH:mm",
            LLLL: "dddd, D MMMM [năm] YYYY HH:mm",
            l: "DD/M/YYYY",
            ll: "D MMM YYYY",
            lll: "D MMM YYYY HH:mm",
            llll: "ddd, D MMM YYYY HH:mm",
          },
          calendar: {
            sameDay: "[Hôm nay lúc] LT",
            nextDay: "[Ngày mai lúc] LT",
            nextWeek: "dddd [tuần tới lúc] LT",
            lastDay: "[Hôm qua lúc] LT",
            lastWeek: "dddd [tuần trước lúc] LT",
            sameElse: "L",
          },
          relativeTime: {
            future: "%s tới",
            past: "%s trước",
            s: "vài giây",
            ss: "%d giây",
            m: "một phút",
            mm: "%d phút",
            h: "một giờ",
            hh: "%d giờ",
            d: "một ngày",
            dd: "%d ngày",
            w: "một tuần",
            ww: "%d tuần",
            M: "một tháng",
            MM: "%d tháng",
            y: "một năm",
            yy: "%d năm",
          },
          dayOfMonthOrdinalParse: /\d{1,2}/,
          ordinal: function(number) {
            return number;
          },
          week: {
            dow: 1,
            doy: 4,
          },
        });

        return vi;
      });

      moment.locale("vi");

      setInterval(() => {
        const now = moment().format(
          "dddd, DD/MM/YYYY - HH [giờ] mm [phút] ss [giây]"
        );
        $("#content__time").text(now);
      }, 1000);
    }
  </script>
</body>

</html>