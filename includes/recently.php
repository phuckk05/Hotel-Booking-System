<?php
session_start();
require("../database/config.php");
require("../models/user.php");
require("../models/booking.php");
require("../models/booking_rooms.php");
require("../models/hotel.php");

// Lấy danh sách bookings của user
$bookingModel = new Booking($conn);
$hotelModel = new Hotel($conn);

$bookings = $bookingModel->getBookingByUserIdASSOC($_SESSION["user_id"]);
?>

<div class="mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Khách sạn đã đặt</h1>

    <?php if (is_array($bookings) && count($bookings) > 0): ?>
        <?php foreach ($bookings as $row): ?>
            <?php
            $hotel = $hotelModel->getById($row['hotel_id']);
            ?>
            <div class="space-y-16">
                <div
                    class="bg-white rounded-xl shadow-md p-4 flex flex-col md:flex-row items-center gap-4 border border-gray-200 mb-4">

                    <!-- Hình ảnh khách sạn -->
                    <div class="relative w-full md:w-auto md:flex-shrink-0">
                        <img src="assets/images/bg.webp" alt="<?php echo $hotel['name'] ?? 'Khách sạn'; ?>"
                            class="rounded-lg w-full md:w-56 h-48 object-cover" />
                    </div>

                    <!-- Thông tin chi tiết -->
                    <div class="flex-1 space-y-2 w-full">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                <?php echo $hotel['name'] ?? 'Không rõ tên'; ?>
                            </h3>
                            <p class="text-gray-500 text-sm">Khách sạn</p>
                        </div>

                        <p class="text-gray-600 text-sm">
                            <?php echo $hotel['address'] ?? 'Chưa cập nhật địa chỉ'; ?>
                        </p>

                        <div class="flex items-center space-x-2 gap-2">
                            <span class="bg-green-500 text-white font-bold text-sm px-2 py-1 rounded-full">
                                7.3
                            </span>
                            <span class="font-semibold text-sm">Ổn</span>
                            <span class="text-gray-500 text-sm">(18)</span>
                        </div>

                        <div class="flex items-center text-gray-500 text-sm space-x-4">
                            <div class="flex items-center space-x-1">
                                <span class="mr-4">
                                    <?php echo $row['check_in'] ?> – <?php echo $row['check_out'] ?>
                                </span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <span>
                                    <?php echo $row['member'] ?> khách, <?php echo $row['quantity'] ?> phòng
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Nút xem chi tiết -->
                    <div class="flex flex-col items-center md:items-end w-full md:w-auto mt-4 md:mt-0">
                        <p class="text-sm text-gray-500 mb-2">Chọn ngày để xem giá chính xác</p>
                        <button
                            class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition w-full md:w-auto flex items-center justify-center space-x-2">
                            <span>Xem chi tiết</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 15.707a1 1 0 010-1.414L13.586 10l-3.293-3.293a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="flex justify-center items-center">
            <p class="text-gray-500">Chưa có phòng đặt !</p>
        </div>
    <?php endif; ?>
</div>