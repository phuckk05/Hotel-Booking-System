<?php
session_start();
require_once("../database/config.php");
require_once("../models/favorites.php");

if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập!";
    exit;
}

if (isset($_POST['favorites'])) {
    $favorite = $_POST['favorites'];
    $favorites = new Favorites($conn);
    if ($favorites->deleteById($favorite)) {
        echo 'done';
    } else {
        echo 'Lỗi';
    }
} else {
    echo 'Lỗi';
}
?>