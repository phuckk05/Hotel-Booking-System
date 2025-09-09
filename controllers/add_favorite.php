<?php
session_start();
require_once("../database/config.php");
require_once("../models/favorites.php");

if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập!";
    exit;
}

if (isset($_POST['hotel_id'])) {
    $user_id = $_SESSION['user_id'];
    $hotel_id = $_POST['hotel_id'];

    $favorites = new Favorites($conn);
    // Kiểm tra đã tồn tại chưa
    if (!$favorites->check($hotel_id)) {
        $favorites->user_id = $user_id;
        $favorites->hotel_id = $hotel_id;
        $favorites->create();

    } else {
        $favorites->delete($user_id, $hotel_id);
    }
} else {
}
?>