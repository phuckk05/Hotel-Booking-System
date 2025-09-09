<?php
session_start();
require_once('../models/favorites.php');
require_once('../database/config.php');
require_once('../models/hotel.php');
require_once('../models/room.php');
$favoritesModel = new Favorites($conn);
$hotelModel = new Hotel($conn);
$roomModel = new Room($conn);
if (!isset($_SESSION['user_id'])) {
    echo 'vui lòng đăng nhập';
    exit;
}
$user_id = $_SESSION['user_id'];

$favorites = $favoritesModel->getHotel($user_id);





?>
<div class="mx-auto p-4">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Nơi lưu trú bạn thích</h1>
        <p class="text-gray-500 mt-2"><?php echo count($favorites) . ' địa điểm' ?></p>

        <div class="flex flex-wrap gap-4">
            <?php foreach ($favorites as $key): ?>
                <?php
                $hotel = $hotelModel->getById($key['hotel_id']);
                $rooms = $roomModel->getByHotel($key['hotel_id']);
                $room = $rooms[0] ?? null;

                ?>
                <div class=" w-full sm:w-1/2 md:w-1/3 lg:w-1/4 mt-4 cursor-pointer relative">
                    <div class="relative bg-gray-200 rounded-lg overflow-hidden">
                        <img src="<?php echo $room ? $room['image'] : 'uploads/no-image.jpg'; ?>" alt="Hotel Placeholder"
                            class="w-full h-auto" />
                        <!-- Checkbox (ẩn mặc định) -->
                        <input id="checkbox" type="checkbox" value="<?php echo $key['id']; ?>"
                            class="favorite-checkbox hidden absolute top-2 left-2 w-4 h-4 cursor-pointer">
                    </div>
                    <div class="mt-4">
                        <h2 class="text-lg font-semibold text-gray-800 text-center whitespace-nowrap overflow-hidden">
                            <?php echo $hotel['name']; ?>
                        </h2>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if ($favorites != null): ?>
                <div class="w-full sm:w-1/3 md:w-1/3 lg:w-1/4 mt-4 ">
                    <button id="fix_button"
                        class="flex items-center justify-center w-full h-full border-2 border-dashed border-gray-300 rounded-lg text-blue-600 hover:border-blue-600 transition">
                        <span id="btnText" class="font-semibold">Chỉnh sửa</span>
                    </button>
                </div>
            <?php endif; ?>
            <!-- Nút fix/xóa -->

        </div>
    </div>
</div>