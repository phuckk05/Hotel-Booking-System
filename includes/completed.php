<?php
include("../includes/head.php");
session_start();

if ($_SESSION["user_id"] != null && $_SESSION["code"] != null && $_SESSION["hotel_name"] != null && $_SESSION["check_in"] != null && $_SESSION["check_out"] != null && $_SESSION["member"] != null) {
    $code = $_SESSION["code"];
    $name = $_SESSION["hotel_name"];
    $check_in = $_SESSION["check_in"];
    $check_out = $_SESSION["check_out"];
    $member = $_SESSION["member"];
    unset($_SESSION["code"]);
    unset($_SESSION["member"]);
    unset($_SESSION["check_in"]);
    unset($_SESSION["check_out"]);
    unset($_SESSION["hotel_name"]);
} else {
    $backUrl = $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') ? '&' : '?') . 'success=fail';
    header("Location: " . $backUrl);
    exit;
}

?>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-cyan-50 to-gray-100">

    <div class="bg-white p-10 rounded-2xl shadow-xl max-w-lg w-full text-center">
        <!-- Icon check -->
        <div class="flex items-center justify-center w-24 h-24 rounded-full bg-green-100 mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-green-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <!-- Tiêu đề -->
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Đặt phòng thành công</h1>
        <p class="text-gray-600 mb-6">Cảm ơn bạn đã lựa chọn dịch vụ của chúng tôi.</p>

        <!-- Thông tin booking -->
        <div class="bg-gray-50 border rounded-lg p-5 text-left mb-6">
            <p class="text-sm text-gray-500">Mã đặt phòng</p>
            <p class="text-lg font-semibold text-gray-800 mb-4"><?php echo $code ?></p>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Ngày nhận phòng</p>
                    <p class="font-medium text-gray-800"><?php echo $check_in ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Ngày trả phòng</p>
                    <p class="font-medium text-gray-800"><?php echo $check_out ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Số khách</p>
                    <p class="font-medium text-gray-800"><?php echo $member ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Khách sạn</p>
                    <p class="font-medium text-gray-800"><?php echo $name ?></p>
                </div>
            </div>
        </div>

        <!-- Hành động -->
        <div class="flex justify-center space-x-4 gap-4">
            <a href="../index.php"
                class="px-6 py-3 bg-cyan-600 text-white rounded-lg shadow hover:bg-cyan-700 transition">
                Về trang chủ
            </a>
            <a href="my-bookings.php"
                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300 transition">
                Xem đặt phòng
            </a>
        </div>
    </div>

</body>
<!-- sau 10 giây chuyển về trang chũ -->
<script>
    // Sau 3 giây sẽ chuyển sang completed.html
    setTimeout(() => {
        window.location.href = "../index.php";
    }, 10000);
</script>