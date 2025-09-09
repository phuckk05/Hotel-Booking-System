<?php
session_start();
include 'includes/head.php';
include 'includes/header.php';
// --- Thông báo ---
if (isset($_GET['msg'])) {
    echo "<script>";
    if ($_GET['msg'] == 'register_success') {
        echo "alert('Đăng kí thành công!');";
    }
    // Xóa ?msg khỏi URL sau khi alert
    echo "window.history.replaceState({}, document.title, window.location.pathname);";
    echo "</script>";
}

// --- Hiển thị avatar khi đã login ---
if (isset($_SESSION["user_id"])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            let btnLoginSginUp = document.getElementById('btnLoginSginUp');
            let btnAvatar = document.getElementById('btnAvatar');
            if (btnAvatar && btnLoginSginUp) {
                btnAvatar.classList.remove('hidden');
                btnLoginSginUp.classList.add('hidden');
            }
        });
    </script>";
}
?>

<body>
    <?php
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 0;

    switch ($page) {
        case 0:
            include 'pages/home.php';
            break;
        case 1:
            include 'pages/rooms.php';
            break;
        case 2:
            include 'pages/promotion.php';
            break;
        case 3:
            //tránh user nhập bậy bạ
            if (!isset($_SESSION['user_id'])) {
                include 'pages/home.php';
                include 'includes/footer.php';
                exit;
            }
            include 'pages/account.php';
            break;
        default:
            include 'pages/home.php';
            break;
    }
    ?>
</body>

<?php
include 'includes/footer.php';
?>