<?php
require '../database/config.php';
require '../models/user.php';
session_start();

$userModel = new User($conn);
$userModel->getUserById($_SESSION['user_id']);
?>
<div class="mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Tài khoản của bạn</h1>

    <form method="POST" action="controllers/update_profile_delete_user.php">
        <div class="rounded-lg">
            <!-- Thông tin cá nhân -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="notification">Thông tin cá nhân</label>
                <input class="w-full p-2 border rounded mb-2" type="text" id="notification" placeholder="Thông báo"
                    disabled>
            </div>

            <!-- Tên -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="first-name">Tên của bạn</label>
                <input class="w-full p-2 border rounded mb-2" type="text" id="name" name="name"
                    value="<?php echo htmlspecialchars($userModel->name); ?>">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Địa chỉ email</label>
                <div class="flex items-center w-full p-2 border rounded mb-2">
                    <input class="w-full p-1 border-0 focus:ring-0" type="text" id="email"
                        value="<?php echo htmlspecialchars($userModel->email); ?>" disabled>
                    <span class="text-green-500 ml-2"><i class="fas fa-check-circle"></i></span>
                </div>
            </div>

            <!-- Chọn avatar -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Chọn ảnh đại diện</label>
                <div class="grid grid-cols-5 gap-2 mb-2">
                    <?php for ($i = 0; $i <= 11; $i++): ?>
                        <div class="flex items-center justify-center p-2 hover:bg-gray-500 cursor-pointer w-16 rounded-full"
                            onclick="myImage(<?php echo $i; ?>)">
                            <img id="avatar-<?php echo $i ?>" src="assets/images/avatar-<?php echo $i ?>.png"
                                alt="Avatar <?php echo $i ?>" class="w-12 h-12 rounded-full">
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="mt-2 flex gap-2 items-center">
                    <p class="text-gray-600 text-sm">Ảnh đại diện của bạn</p>
                    <img id="image" src="assets/images/avatar-<?php echo $userModel->avatar ?>.png" alt="Avatar"
                        class="w-12 h-12 rounded-full">
                    <input type="hidden" id="avatar" name="avatar" value="<?php echo $userModel->avatar; ?>">

                </div>
            </div>

            <!-- Nút hành động -->
            <div class="flex justify-between mt-6">
                <button id="save-changed" type="submit" name="action" value="save"
                    class="bg-blue-100 text-blue-500 px-4 py-2 rounded text-sm hover:bg-gray-500 hover:text-white">Lưu
                    thay đổi</button>
                <button id="delete-account" type="submit" name="action" value="delete" class="text-blue-500 text-sm">Xóa
                    tài khoản</button>
            </div>
        </div>
    </form>
</div>