<section class="content">
    <div class="content-main">
        <div class="content__navi d-flex align-items-center justify-content-between">
            <h4>Danh sách danh mục</h4>
            <!-- <div id="content__time" class="content__time"></div> -->
        </div>

        <div class="content__func">
            <a href="./admin_cate_add.php?act=category&perform=add_cate" class="btn btn-primary content__func-btn">
                <i class="fa-solid fa-plus"></i><span class="content__func-lable"> Thêm danh mục mới</span></a>
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
                        <th>ID Danh mục</th>
                        <th>Tên Danh mục</th>
                        <th>Ảnh danh mục</th>
                        <th>Thực thi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_ad_cate = $conn->query("SELECT * FROM category");
                    $cate_id;
                    foreach ($sql_ad_cate as $row_ad_cate) {
                        $cate_id = $row_ad_cate['category_id']
                    ?>
                        <tr>
                            <td><?php echo $row_ad_cate['category_id']; ?></td>
                            <td><?php echo $row_ad_cate['category_name']; ?></td>
                            <td>
                                <img loading="lazy" class="content__tbl-img" src="../assets/img/<?php echo $row_ad_cate['category_img']; ?>" alt="category__img" />
                            </td>
                            <td>
                                <a href="./admin_cate_edit.php?act=category&perform=update_cate&id=<?php echo $row_ad_cate['category_id']; ?>" class="btn content__func-btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn content__func-btn btn-danger delete_btn" data-category-id="<?php echo $row_ad_cate['category_id']; ?>">
                                    <i class="fa-solid fa-delete-left"></i>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID Danh mục</th>
                        <th>Tên Danh mục</th>
                        <th>Ảnh danh mục</th>
                        <th>Thực thi</th>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>




<script>
    // Xử lý xóa danh mục khi nhấn nút "Xóa danh mục"
    document.querySelectorAll('.delete_btn').forEach(function(deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const categoryId = this.dataset.categoryId;

            Swal.fire({
                icon: 'warning',
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa danh mục?',
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
                                // Tải lại trang để cập nhật danh sách danh mục
                                window.location.reload();
                            });
                        }
                    };
                    xhttp.open('GET', `admin_cate_del.php?act=category&perform=delete_cate&id=${categoryId}`, true);
                    xhttp.send();
                }
            });
        });
    });
</script>