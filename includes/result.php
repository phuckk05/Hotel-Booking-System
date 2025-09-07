<?php
$hotelModel = new Hotel($conn);
$roomModel = new Room($conn);

$hotel = $hotelModel->getAll();
$get_hotel_by_address = $hotelModel->getByCity($location);



$memberNumber = $checkMember;
$roomNumber = $checkRoomNumber;
$dayIn = $checkIn;
$dayOut = $checkOut;
?>
<div id="result" class="max-w-7xl mx-auto pt-4 pb-4 space-y-4">

    <!-- Thanh filter -->
    <div class="flex flex-wrap gap-2 pb-4">
        <select class="px-4 py-2 border rounded-full text-sm">
            <option>Sắp xếp theo: Nơi lưu trú nổi bật</option>
        </select>
        <select class="px-4 py-2 border rounded-full text-sm">
            <option>Giá</option>
        </select>
        <select class="px-4 py-2 border rounded-full text-sm">
            <option>Bộ lọc</option>
        </select>
        <select class="px-4 py-2 border rounded-full text-sm">
            <option>Đánh giá</option>
        </select>
        <select class="px-4 py-2 border rounded-full text-sm">
            <option>Loại nơi lưu trú</option>
        </select>
        <select class="px-4 py-2 border rounded-full text-sm">
            <option>Vị trí</option>
        </select>

    </div>

    <!-- Thông báo kết quả -->
    <p class="text-sm text-gray-600 py-2">Chúng tôi đã tìm thấy <b><?php echo count($get_hotel_by_address) ?></b> khách
        sạn từ <b><?php echo count($hotel) ?></b> trang</p>

    <!-- Hotel Card -->
    <?php foreach ($get_hotel_by_address as $row): ?>
        <?php
        // Lấy danh sách phòng theo hotel_id
        $rooms = $roomModel->getByHotel($row['id']);
        // Lấy 1 phòng đầu tiên
        $room = $rooms[0] ?? null;
        ?>
        <?php if ($room != null): ?>
            <div
                class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden border border-gray-200 mb-4 hover:shadow-lg transition">
                <!-- Ảnh -->
                <div class="relative w-full md:w-1/3">
                    <img src="<?php echo $room ? $room['image'] : 'uploads/no-image.jpg'; ?>" alt="Hotel"
                        class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 bg-white p-1 rounded-full shadow">❤️</button>
                </div>
                <!-- Nội dung -->
                <div class="flex-1 p-4 flex flex-col justify-between">
                    <div>
                        <h2 class="text-lg font-semibold"><?php echo $row['name']; ?></h2>
                        <div class="text-sm text-gray-600 mb-2">★★★ Khách sạn</div>
                        <div class="text-sm text-gray-600"><?php echo $row['address'] . ', ' . $row['city']; ?></div>
                        <div class="mt-1 text-green-700 font-semibold flex items-center">
                            <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded mr-2">8.3</span>
                            Rất tốt (17 đánh giá)
                        </div>
                    </div>
                    <div
                        class="bg-green-50 border border-green-200 rounded-lg p-3 mt-4 flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <div class="text-xs text-red-600 font-bold mb-1">Giá phù hợp của chúng tôi</div>
                            <div class="text-xs text-gray-600">Trang web của khách sạn</div>
                            <div class="text-sm text-gray-600">✔ Miễn phí Đổi/Hủy & Thanh toán tại nơi lưu trú</div>
                            <div class="text-lg font-bold text-green-700">
                                <?php echo $room ? number_format($room['price'], 0, ',', '.') . '₫' : 'Liên hệ'; ?>
                            </div>
                        </div>
                        <a href="pages/booking.php?hotel_id=<?php echo $row['id']; ?>&room_id=<?php echo $room['id']; ?>&address=<?php echo urlencode($row['address']); ?>&dayIn=<?php echo $dayIn ?>&dayOut=<?php echo $dayOut ?>&name=<?php echo urlencode($row['name']); ?> &city=<?php echo urlencode($row['city']); ?>&member=<?php echo $memberNumber; ?>&roomNumber=<?php echo $roomNumber; ?>"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg font-semibold text-center hover:bg-green-700 transition mt-2 md:mt-0">
                            Xem Giá Tốt
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>



    <?php endforeach; ?>
    <?php if ($get_hotel_by_address == null): ?>
        <div
            class="bg-white rounded-xl shadow-md flex justify-center h-20 items-center flex-col md:flex-row overflow-hidden border border-gray-200 mb-4 hover:shadow-lg transition">
            <h1 class="text-xl text-gray-700 font-bold">Không tìm thấy!</h1>
        </div>
    <?php endif; ?>

</div>