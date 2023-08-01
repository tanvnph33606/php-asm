<?php
// Kết nối đến cơ sở dữ liệu
// require_once 'connect.php';





//product top
function product_top_data()
{
    global $conn;
    $result = mysqli_query($conn, 'SELECT * FROM product_top');
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

?>



<?php
$product_data = product_top_data();

foreach ($product_data as $row) {

?>


    <!-- code -->
<?php
}
?>