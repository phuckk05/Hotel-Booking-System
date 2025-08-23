<?php
session_start();
require_once("../database/config.php");
require_once("../models/user.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //new User
    $userModel = new User($conn);
    //Lấy data từ form
    $userModel->email = $_POST['email'];
    $userModel->password = $_POST['password'];
    $userModel->name = "";
    $userModel->phone = "";
    $userModel->role = "customer";
    
    //check email 
    if ($userModel->isEmailExists($userModel->email)) {
        header("Location: ../pages/register.php?msg=email_exists");
        exit;
    } else if (empty($userModel->email) || empty($userModel->password)) {
        header("Location: ../pages/register.php?msg=missing_info");
        exit;
    } else {
        if ($userModel->create()) {
            $_SESSION['email'] = $userModel->email;
            header("Location: ../index.php?msg=register_success");
            exit;
        } else {
            header("Location: ../pages/register.php?msg=register_failed");
            exit;
        }
    }

}
?>