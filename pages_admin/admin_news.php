<section class="content">
    <div class="content-main">
        <div class="content__navi d-flex align-items-center justify-content-between">
            <h4>Danh sách tin tức</h4>
            <!-- <div id="content__time" class="content__time"></div> -->
        </div>

        <div class="content__func">
            <a href="./admin_news_add.php?act=news&perform=add_news" class="btn btn-primary content__func-btn">
                <i class="fa-solid fa-plus"></i><span class="content__func-lable"> Thêm dữ tin tức mới</span></a>
            <a href="" class="btn content__func-btn btn-info disabled">
                <i class="fa-solid fa-print"></i><span class="content__func-lable"> In dữ liệu</span></a>
            <a href="" class="btn content__func-btn btn-secondary disabled">
                <i class="fa-solid fa-copy"></i><span class="content__func-lable"> Sao chép</span></a>
            <a href="" class="btn content__func-btn btn-warning disabled">
                <i class="fa-solid fa-file-pdf"></i><span class="content__func-lable"> Xuất PDF</span></a>
            <a href="" class="btn content__func-btn btn-success disabled">
                <i class="fa-solid fa-file-excel"></i><span class="content__func-lable"> Xuất EXCEL</span></a>
        </div>
        <!-- table -->
        <div class="content__tbl">
            <table id="content_tbl_main" class="hover row-border content_tbl_main" style="width: 100%">
                <thead>
                    <tr>
                        <th>ID tin tức</th>
                        <th>Tên người đăng</th>
                        <th>Ngày</th>
                        <th>Tiêu đề</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Mô tả chi tiết</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_ad_news = $conn->query("SELECT * FROM news");
                    foreach ($sql_ad_news as $row_ad_news) {
                    ?>
                        <tr>
                            <td><?php echo $row_ad_news['news_id']; ?></td>
                            <td><?php echo $row_ad_news['news_user']; ?></td>
                            <td><?php echo $row_ad_news['news_date']; ?></td>
                            <td class="text-truncate" style="max-width: 10rem">
                                <?php echo $row_ad_news['news_title']; ?>
                            </td>
                            <td>
                                <img loading="lazy" class="content__tbl-img" src="../assets/img/<?php echo $row_ad_news['news_img']; ?>" alt="news__img" />
                            </td>

                            <td class="text-truncate" style="max-width: 10rem">
                                <div class="text-truncate" style="max-height: 12rem">
                                    <?php echo $row_ad_news['news_desc']; ?>
                                </div>
                            </td>
                            <?php
                            $sql_news_detail = $conn->query("SELECT * FROM news_detail WHERE news_id = '$row_ad_news[news_id]' ");
                            foreach ($sql_news_detail as $row_news_detail) {
                            ?>
                                <td class="text-truncate" style="max-width: 10rem">
                                    <div class="text-truncate" style="max-height: 12rem">
                                        <?php echo $row_news_detail['news_detail']; ?>
                                    </div>
                                </td>
                            <?php } ?>
                            <td>
                                <a href="./admin_news_edit.php?act=news&perform=update_news&id=<?php echo $row_ad_news['news_id']; ?>" type="button" class="btn content__func-btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn content__func-btn btn-danger delete_btn" data-news-id="<?php echo $row_ad_news['news_id']; ?>">
                                    <i class="fa-solid fa-delete-left"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID tin tức</th>
                        <th>Tên</th>
                        <th>Ngày</th>
                        <th>Tiêu đề</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Mô tả chi tiết</th>
                        <th>Thực thi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>



<script>
    // Xử lý xóa khi nhấn nút "Xóa"
    document.querySelectorAll('.delete_btn').forEach(function(deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const newsId = this.dataset.newsId;

            // Hiển thị popup xác nhận xóa
            Swal.fire({
                icon: 'warning',
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa tin tức này?',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Sử dụng AJAX để gửi yêu cầu xóa đến PHP
                    const xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            // Nếu xóa thành công, hiển thị thông báo
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1400,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Xóa thành công!'
                            }).then(() => {
                                // Tải lại trang để cập nhật
                                window.location.reload();
                            });
                        }
                    };
                    xhttp.open('GET', `admin_news_del.php?act=news&perform=delete_news&id=${newsId}`, true);
                    xhttp.send();
                }
            });
        });
    });
</script>