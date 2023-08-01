<section class="content">
  <div class="content-main">
    <div class="content__navi d-flex align-items-center justify-content-between">
      <h4>Bảng điều khiển</h4>
      <div id="content__time" class="content__time"></div>
    </div>

    <!-- content -->
    <div class="content__body">
      <!-- Quản lý  -->
      <div class="row gx-4">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-md-6">

              <div class="item__info">
                <i class="item__info-icon fa-solid fa-users-rectangle item__info-icon--green"></i>
                <?php
                $sql_user = $conn->query("SELECT * FROM users WHERE role_id = 2");
                $length_user = $sql_user->rowcount();
                ?>
                <div class="item__info-info">
                  <h4>Tổng khách hàng</h4>
                  <p><?php echo "$length_user khách hàng"  ?></p>
                  <span class="info-sum">Tổng số khách hàng được quản lý.</span>
                </div>
              </div>
            </div>
            <!--  -->
            <div class="col-md-6">
              <div class="item__info">
                <i class="item__info-icon fa-solid fa-cart-flatbed item__info-icon--blue"></i>
                <?php
                $sql_pro = $conn->query("SELECT * FROM product");
                $length_pro = $sql_pro->rowcount();
                ?>
                <div class="item__info-info">
                  <h4>Tổng sản phẩm</h4>
                  <p><?php echo "$length_pro sản phẩm" ?></p>
                  <span class="info-sum">Tổng số sản phẩm được quản lý.</span>
                </div>
              </div>
            </div>

            <!--  -->

            <div class="col-md-6">
              <div class="item__info">
                <i class="fa-solid fa-box item__info-icon item__info-icon--orange"></i>
                <div class="item__info-info">
                  <h4>Tổng đơn hàng</h4>
                  <p>457 đơn hàng</p>
                  <span class="info-sum">Tổng số hóa đơn bán hàng trong tháng.</span>
                </div>
              </div>
            </div>

            <!--  -->

            <div class="col-md-6">
              <div class="item__info">
                <i class="fa-solid fa-triangle-exclamation item__info-icon item__info-icon--red"></i>
                <div class="item__info-info">
                  <h4>Sắp hết hàng</h4>
                  <p>4 sản phẩm</p>
                  <span class="info-sum">Số sản phẩm cảnh báo hết cần nhập thêm.</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Bảng -->
          <!-- đơn hàng -->
          <div class="row">
            <div class="col-lg-12">
              <div class="content__tbl mt-2">
                <h2 class="content__tbl-title">
                  Tình trạng đơn hàng
                </h2>

                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Mã đơn</th>
                      <th scope="col">Tên khách hàng</th>
                      <th scope="col">Tổng tiền</th>
                      <th scope="col">Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>
                        <span class="item__info-td bg-infoo">Chờ xử lý</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>
                        <span class="item__info-td bg-warningg">Đang vận chuyển</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry the Bird</td>
                      <td>Larry the Bird</td>
                      <td>
                        <span class="item__info-td bg-successs">Đã hoàn thành</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Larry the Bird</td>
                      <td>Larry the Bird</td>
                      <td>
                        <span class="item__info-td bg-dangerr">Đã hủy</span>
                      </td>
                    </tr>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th scope="col">Mã đơn</th>
                      <th scope="col">Tên khách hàng</th>
                      <th scope="col">Tổng tiền</th>
                      <th scope="col">Trạng thái</th>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>

          </div>

          <!-- Bảng -->
          <!-- Người dùng align-items-center-->

          <div class="row mt-5">
            <div class="col-lg-12">
              <div class="content__tbl mt-2">
                <h2 class="content__tbl-title">
                  Người dùng mới
                </h2>

                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Tên khách hàng</th>
                      <th scope="col">Ngày tạo</th>
                      <th scope="col">Số điện thoại</th>
                      <th scope="col">Email</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    $sql_user_new = $conn->query("SELECT DATE_FORMAT(created_at, '%d-%m-%Y') as created_at, user_id, fullname, phone, email FROM users WHERE role_id = 2 ORDER BY user_id DESC LIMIT 10");
                    foreach ($sql_user_new as $row_user_new) {
                    ?>
                      <tr>
                        <th scope="row"><?php echo $row_user_new['user_id'] ?></th>
                        <td class="text-capitalize"><?php echo $row_user_new['fullname'] ?></td>
                        <td><?php echo $row_user_new['created_at'] ?></td>
                        <td><?php echo $row_user_new['phone'] ?></td>
                        <td><?php echo $row_user_new['email'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Tên khách hàng</th>
                      <th scope="col">Ngày tạo</th>
                      <th scope="col">Số điện thoại</th>
                      <th scope="col">Email</th>

                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>

          </div>

        </div>

        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="content__tbl mt-0">
                <h2 class="content__tbl-title">
                  Dữ liệu đầu vào
                </h2>

                <!-- chart -->
                <div class="embed-responsive embed-responsive-16by9">
                  <canvas id="chartDashboard"></canvas>
                </div>
              </div>

            </div>

            <div class="col-lg-12 ">
              <div class="content__tbl mt-5">
                <h2 class="content__tbl-title">
                  Thống kê doanh thu 12 tháng
                </h2>

                <!-- chart -->
                <div class="embed-responsive embed-responsive-16by9">
                  <canvas id="chartDashboard2"></canvas>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>


  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('chartDashboard');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],

      datasets: [{
        label: '%',
        data: [210, 75, 132, 53, 52, 83],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    },
    options: {
      animations: {
        tension: {
          duration: 1000,
          easing: 'linear',
          from: 1,
          to: 0,
          loop: true
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  //Doanh thu
  const ctx2 = document.getElementById('chartDashboard2');

  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
      datasets: [{
        label: 'Triệu',
        data: [654, 559, 806, 871, 568, 595, 400, 275, 588, 232, 356, 425],

        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>