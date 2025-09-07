<?php
session_start();
require_once("../database/config.php");
require_once("../models/user.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //new User
    $userModel = new User($conn);
    //Lấy data từ form
    $email = $_POST['email'];
    $password = $_POST['password'];

    //check email 
    if ($userModel->login($email, $password)) {
        $userId = $userModel->getIdUser($email);
        if ($_SESSION['user_id'] != $userId) {
            $_SESSION['user_id'] = $userId;
        }
        header("Location: ../index.php");
        exit;
    } else {
        header("Location: ../pages/register.php?msg=login_failed");
        exit;
    }

}
?>