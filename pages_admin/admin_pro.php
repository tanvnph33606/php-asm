<section class="content">
    <div class="content-main">
        <div class="content__navi d-flex align-items-center justify-content-between">
            <h4>Danh sách sản phẩm</h4>
            <!-- <div id="content__time" class="content__time">
            </div> -->
        </div>

        <div class="content__func">
            <a href="./admin_pro_add.php?act=product&perform=add_product" class="btn btn-primary content__func-btn">
                <i class="fa-solid fa-plus"></i><span class="content__func-lable"> Thêm sản phẩm mới</span></a>
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
                        <th>ID Sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Tồn kho</th>
                        <th>Loại</th>
                        <th>Giảm giá</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá cũ</th>
                        <th>Giá mới</th>
                        <th>Hiệu</th>
                        <th>Mô tả</th>
                        <th>Mô tả chi tiết</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_ad_pro = $conn->query("SELECT * FROM product");
                    foreach ($sql_ad_pro as $row_ad_pro) {
                    ?>
                        <tr>
                            <td><?php echo $row_ad_pro['product_id']; ?></td>

                            <?php
                            $sql_ad_cate = $conn->query("SELECT * FROM category WHERE category_id = '$row_ad_pro[category_id]'");
                            foreach ($sql_ad_cate as $row_ad_cate) {
                            ?>
                                <td><?php echo $row_ad_cate['category_name']; ?></td>
                            <?php } ?>

                            <td><?php echo $row_ad_pro['product_quantity']; ?></td>

                            <td><?php echo $row_ad_pro['product_type']; ?></td>
                            <td><?php echo $row_ad_pro['product_off'] . '%'; ?></td>
                            <td>
                                <img loading="lazy" class="content__tbl-img" src="../assets/img/<?php echo $row_ad_pro['product_img']; ?>" alt="product_img" />
                            </td>
                            <td><?php echo $row_ad_pro['product_name']; ?></td>
                            <td><?php echo number_format($row_ad_pro['product_price_old']) . 'đ'; ?></td>
                            <td><?php echo number_format($row_ad_pro['product_price_new']) . 'đ'; ?></td>
                            <td><?php echo $row_ad_pro['product_brand']; ?></td>
                            <td class="text-truncate" style="max-width: 100px">
                                <div class="text-truncate" style="max-height: 12rem">
                                    <?php echo $row_ad_pro['product_desc']; ?>
                                </div>
                            </td>

                            <?php
                            $sql_ad_detail = $conn->query("SELECT * FROM product_detail WHERE product_id = '$row_ad_pro[product_id]'");
                            foreach ($sql_ad_detail as $row_ad_detail) {
                            ?>
                                <td class="text-truncate" style="max-width: 100px">
                                    <div class="text-truncate" style="max-height: 12rem">
                                        <?php echo $row_ad_detail['product_detail']; ?>
                                    </div>
                                </td>
                            <?php } ?>

                            <td>
                                <a href="./admin_pro_edit.php?act=product&perform=update_product&id=<?php echo $row_ad_pro['product_id']; ?>" class="btn content__func-btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn content__func-btn btn-danger delete_btn" data-product-id="<?php echo $row_ad_pro['product_id']; ?>">
                                    <i class="fa-solid fa-delete-left"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID Sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Tồn kho</th>
                        <th>Loại</th>
                        <th>Giảm giá</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá cũ</th>
                        <th>Giá mới</th>
                        <th>Hiệu</th>
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
            const productId = this.dataset.productId;

            // Hiển thị popup xác nhận xóa
            Swal.fire({
                icon: 'warning',
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
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
                    xhttp.open('GET', `admin_pro_del.php?act=product&perform=delete_product&id=${productId}`, true);
                    xhttp.send();
                }
            });
        });
    });
</script>