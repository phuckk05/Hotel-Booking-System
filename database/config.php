<?php
// Kết nối database
$conn = new mysqli("localhost", "root", "", "hotel");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>