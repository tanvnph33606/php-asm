<?php

// Thông tin kết nối
const _HOST = 'localhost';
const _USER = 'root';
const _PASS = '';
const _DB = 'tan_php1';

// Hàm kết nối
function connect()
{
    $conn = new mysqli(_HOST, _USER, _PASS, _DB);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}

// Hàm thực hiện câu lệnh SELECT
// Hàm thực hiện câu lệnh SELECT
function selectData()
{
    $conn = connect();
    $sql = "SELECT * FROM table_name";
    $result = $conn->query($sql);

    // Kiểm tra kết quả truy vấn
    if ($result) {
        // Kiểm tra số hàng trả về
        if ($result->num_rows > 0) {
            // Khởi tạo một mảng để lưu trữ dữ liệu
            $data = array();

            // Lặp qua từng hàng kết quả
            while ($row = $result->fetch_assoc()) {
                // Xử lý từng hàng và thêm vào mảng dữ liệu
                // Ví dụ: lấy giá trị từ các cột trong hàng
                $name = $row['name'];
                $email = $row['email'];

                // Thêm vào mảng dữ liệu
                $data[] = array(
                    'name' => $name,
                    'email' => $email
                );
            }

            // Trả về dữ liệu
            return $data;
        } else {
            // Không có hàng trả về
            return array();
        }
    } else {
        // Lỗi truy vấn
        return false;
    }

    // Đóng kết nối
    $conn->close();
}


// Hàm thực hiện câu lệnh INSERT
function insertData($name, $email)
{
    $conn = connect();
    $sql = "INSERT INTO table_name (name, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    // Xử lý kết quả (nếu cần)
    // ...
    $stmt->close();
    $conn->close();
}

// Hàm thực hiện câu lệnh DELETE
function deleteData($id)
{
    $conn = connect();
    $sql = "DELETE FROM table_name WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    // Xử lý kết quả (nếu cần)
    // ...
    $stmt->close();
    $conn->close();
}

// Hàm thực hiện câu lệnh UPDATE
function updateData($id, $name, $email)
{
    $conn = connect();
    $sql = "UPDATE table_name SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
    // Xử lý kết quả (nếu cần)
    // ...
    $stmt->close();
    $conn->close();
}

// Sử dụng các hàm thực hiện truy vấn
selectData();
insertData("John Doe", "john@example.com");
deleteData(1);
updateData(2, "Jane Doe", "jane@example.com");
