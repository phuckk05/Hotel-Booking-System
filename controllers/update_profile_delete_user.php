<?php
require '../database/config.php';
require '../models/user.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'save') {

        $email = $_SESSION['email']; // email lấy từ session
        $name = $_POST['name'];
        $avatar = $_POST['avatar'];

        $userModel = new User($conn);
        $userModel->update($email, $name, $avatar);

        // Quay lại profile
        header("Location: /DOAN/index.php?page=3");
        exit;
    }
    if ($_POST['action'] === 'delete') {

        exit;
    }
}