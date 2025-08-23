<!-- HEADER -->
<?php
require 'database/config.php';
require 'models/user.php';
require 'models/hotel.php';
require 'models/room.php';
$userModel = new User($conn);
$userModel->getByEmail($_SESSION['email']);
?>
<header id="headerId"
    class="fixed top-0 left-0 md:fixed md:top-0 md:left-0 w-full bg-white shadow-md z-40 overflow-visible">
    <div class="max-w-7xl mx-auto px-4 sm:px-0 lg:px-1">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="index.php" class="flex items-center space-x-2">
                <span class="text-2xl font-bold text-indigo-700">FastRoom</span>
            </a>

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex space-x-8 p-6 gap-12">
                <a href="index.php" class="text-gray-700 hover:text-indigo-600 transition" onclick="Nav(0)">Trang
                    chủ</a>
                <a href="index.php?page=1" class="text-gray-700 hover:text-indigo-600 transition"
                    onclick="Nav(1)">Phòng</a>
                <a href="index.php?page=2" class="text-gray-700 hover:text-indigo-600 transition" onclick="Nav(2)">Ưu
                    đãi</a>
                <!-- <a href="index.php?page=3" class="text-gray-700 hover:text-indigo-600 transition" onclick="Nav(3)">Thông tin</a> -->
            </nav>

            <div class="flex items-center space-x-4 gap-4">
                <!-- Avatar -->
                <div id="btnAvatar" class="avatar-Box hidden" onclick="window.location.href='index.php?page=3'">
                    <div id="avatar-btn"
                        class="bg-black rounded-full w-9 h-9 overflow-hidden cursor-pointer flex items-center justify-center  hover:transform hover:scale-105 transition duration-300">
                        <img src="assets/images/avatar-<?php echo $userModel->avatar?>.png" alt="avatar"
                            class="w-full h-full object-cover hover:opacity-80 transition duration-300">
                    </div>
                    <div id="border-in-avatar" class="hidden border-b-2 border-indigo-600 pt-2"></div>
                </div>

                <!-- Buttons Desktop -->
                <div id="btnLoginSginUp" class="flex space-x-4 gap-2">
                    <a href="pages/register.php"
                        class="px-4 py-2 text-sm text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition font-bold">Đăng
                        nhập - Đăng kí</a>

                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="icon-menu" class="fas fa-bars fa-2x transition-transform duration-300 ease-in-out"
                        onclick="menuClick()"></button>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/nav.php'; ?>

    <!-- <div id="avatar-menu" class="absolute bg-white shadow-lg rounded-lg right-4 top-20 w-56 max-h-0 opacity-0 overflow-hidden
           z-50 transition-all duration-300 ease-in-out transform scale-95">
        <ul class="py-2">
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex items-center gap-2">👤 Tài khoản của bạn</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex items-center gap-2">🕑 Xem gần đây</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex items-center gap-2">🔔 Thông báo</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex items-center gap-2">🔍 Tùy chọn tìm</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex items-center gap-2">💬 Hỗ trợ & Trợ giúp</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex items-center gap-2 border-t">🚪 Đăng xuất</li>
        </ul>
    </div> -->
</header>
<!-- END HEADER -->
<!-- <script>

    let avatarBtn = document.getElementById('avatar-btn');
    let avatarMenu = document.getElementById('avatar-menu');
    let isOpen = false;

    avatarBtn.addEventListener('click', function () {
        if (!isOpen) {
            avatarMenu.classList.remove('opacity-0', 'scale-95', 'max-h-0');
            avatarMenu.classList.add('opacity-100', 'scale-100', 'max-h-96');
        } else {
            avatarMenu.classList.remove('opacity-100', 'scale-100', 'max-h-96');
            avatarMenu.classList.add('opacity-0', 'scale-95', 'max-h-0');
        }
        isOpen = !isOpen;
    });
</script> -->