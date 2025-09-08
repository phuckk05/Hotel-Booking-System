<?php
session_start();
//check inter net

require '../utils/check_internet.php';

include '../includes/head.php';
require '../database/config.php';
require '../models/room.php';
if (isset($_GET['success']) == 'login') {
    echo '<script>alert("Vui lòng đăng nhập rồi sử dựng chức năng!");</script>';
}
//lấy kết quả check

$check_internet = checkInternet();


if (isset($_GET['hotel_id']) && isset($_GET['address']) && isset($_GET['city']) && isset($_GET['name']) && isset($_GET['member']) && isset($_GET['roomNumber']) && isset($_GET['dayIn']) && isset($_GET['dayOut'])) {

    $hotel_id = $_GET['hotel_id'];
    $rooms = new Room($conn);
    $roomsList = $rooms->getByHotel($hotel_id);

    $address = $_GET['address'] ?? '';
    $city = $_GET['city'] ?? '';
    $name = $_GET['name'] ?? '';
    $member = $_GET['member'] ?? 0;
    $roomNumber = $_GET['roomNumber'] ?? 0;

    $checkIn1 = $_GET['dayIn'] ?? '';
    $checkOut1 = $_GET['dayOut'] ?? '';

    // Kiểm tra nếu có giá trị ngày
    if (!empty($checkIn1) && !empty($checkOut1)) {
        // Chuyển đổi sang timestamp để lấy thứ
        $timestampCheckIn = strtotime($checkIn1);
        $timestampCheckOut = strtotime($checkOut1);

        $dayNameIn = date('l', $timestampCheckIn);
        $dayNameOut = date('l', $timestampCheckOut);

        $daysVietnamese = [
            'Monday' => 'Thứ Hai',
            'Tuesday' => 'Thứ Ba',
            'Wednesday' => 'Thứ Tư',
            'Thursday' => 'Thứ Năm',
            'Friday' => 'Thứ Sáu',
            'Saturday' => 'Thứ Bảy',
            'Sunday' => 'Chủ Nhật'
        ];

        $dayInVietnamese = $daysVietnamese[date('l', $timestampCheckIn)] ?? 'Ngày không hợp lệ';
        $dayOutVietnamese = $daysVietnamese[date('l', $timestampCheckOut)] ?? 'Ngày không hợp lệ';


        //số đêm
        $totalNights = (int) (($timestampCheckOut - $timestampCheckIn) / (60 * 60 * 24));

    }
} else {
    header("Location: ../index.php");
    exit;
}
$select = 0;
$array = [];
$counter = 1;
?>

<div class="w-full">
    <div class="bg-gray-700 h-10 w-full flex items-center justify-start">
        <h1 class="text-white text-center font-bold py-4 px-4 text-sm"><?php echo $address, ', ', $city ?></h1>
    </div>
    <div class="flex mx-auto px-4 pt-4 pb-1">
        <h1 class="text-4xl font-bold text-gray-500 text-center"><?php echo $name ?></h1>
    </div>

    <div class="mx-auto border-b-2 border-gray-600 ml-4 mr-4"></div>
</div>
<div id="div-1" class="w-full">
    <div class="flex mx-auto ml-4">
        <h2 class="text-xl font-bold text-gray-800 text-center mt-8">Lựa chọn của bạn</h2>
    </div>
    <!-- Các lựa chọn -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-4 mr-4 ml-4">
        <!-- Cột trái: Danh sách phòng -->
        <div class="md:col-span-2 space-y-6">
            <!-- Phòng -->
            <?php $count = 1;
            foreach ($roomsList as $room): ?>
                <!-- kiểm tra phóng nếu số lượng phòng đã hết thì kiểm tra giao của check in - check out -->
                <?php ?>
                <input type="text" id="id-<?php echo $count; ?>" value="<?php echo $room['id'] ?>" class="hidden">
                <div class="bg-white border rounded-lg shadow overflow-hidden mb-2">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
                        <!-- Hình ảnh -->
                        <div>
                            <img src="../<?php echo $room ? $room['image'] : 'uploads/no-image.jpg'; ?>" alt="Room"
                                class="w-full h-auto rounded">
                            <p class="text-sm mt-2">Phòng <?php echo $room['capacity'] ?></php> 👤</p>
                        </div>

                        <!-- Thông tin -->
                        <div class="space-y-4">
                            <!-- Gói 1 -->
                            <div>
                                <p id="roomName-<?php echo $count ?>" class="font-semibold"><?php echo $room['room_type'] ?>
                                </p>
                                <div class="bg-green-500 text-white text-sm px-3 py-1 rounded inline-block mb-2">
                                    Giá thấp nhất có sẵn!
                                </div>
                                <ul class="text-sm text-gray-700 space-y-1">
                                    <li>✔ Không bao gồm ăn sáng</li>
                                    <li>✔ Hủy: Non-refundable</li>
                                </ul>
                            </div>
                            <!-- Gói 2 -->
                            <div>
                                <p class="font-semibold">Room Only Free Cancellation</p>
                                <ul class="text-sm text-gray-700 space-y-1">
                                    <li>✔ Không bao gồm ăn sáng</li>
                                    <li>✔ Hủy: Được hoàn tiền 1 ngày trước khi nhận phòng</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Giá -->
                        <div id="divPrice-<?php echo $count; ?>"
                            class="flex flex-col justify-center items-center  p-4 rounded-lg">
                            <div class="text-orange-600 font-semibold bg-orange-100 px-3 py-1 rounded mb-2">Giảm giá 51%
                            </div>
                            <p class="line-through text-gray-500 text-sm">
                                <?php echo $room ? number_format($room['price'], 0, ',', '.') . '₫' : 'Liên hệ'; ?>
                            </p>
                            <div class="flex flex-row items-center gap-1">
                                <p id="price-<?php echo $count ?>" class="text-2xl font-bold">
                                    <?php echo $room ? number_format($room['price'], 0, ',', '.') : '0'; ?> ₫
                                </p>
                            </div>
                            <p class="text-xs text-gray-500 mb-1">mỗi đêm</p>
                            <p id="outPutprice-<?php echo $count ?>" class="text-xs text-blue-500 mb-1 font-bold"></p>
                            <select id="select<?php echo $count ?>" class="border rounded px-2 py-1 mb-3">
                                <?php for ($i = 0; $i <= $room['available_rooms']; $i++): ?>
                                    <option><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                            <button id="btnSelect-<?php echo $count; ?>"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Chọn</button>
                        </div>

                    </div>
                    <div id="state-<?php echo $count; ?>" data-value="<?php echo $room['available_rooms']; ?>"
                        class="hidden mx-auto  h-10 mr-4 mb-4 ml-4 bg-red-200 items-center flex justify-center font-bold rounded-lg">
                        <p>Hết phòng</p>
                    </div>
                </div>

                <?php $count++; endforeach; ?>
        </div>


        <div class="md:col-span-1 ">
            <!-- Cột phải: Đừng bỏ lỡ -->
            <div class="bg-white border rounded-lg shadow p-4">
                <h3 class="text-orange-600 font-bold mb-2">Đừng bỏ lỡ!</h3>
                <p class="mb-3">Chọn phòng ngay bây giờ</p>
                <ul class="text-sm space-y-1">
                    <li>✔ Xác nhận đặt phòng ngay lập tức</li>
                    <li>✔ Không cần đăng ký</li>
                    <li>✔ Miễn phí đặt phòng và giao dịch thẻ</li>
                </ul>
            </div>
            <!-- Tổng quan đăt phòng -->
            <div id="divOrder" class="sticky top-0 z-50 mx-auto border rounded-lg shadow-md p-4 text-sm mt-2 mb-2">

                <!-- Tiêu đề -->
                <h2 class="font-bold text-lg mb-4">TỔNG QUAN ĐẶT PHÒNG</h2>

                <!-- Ngày -->
                <div class="flex justify-between mb-4">
                    <div>
                        <p class="font-bold"><?php echo $dayInVietnamese ?></p>
                        <p><?php echo $checkIn1 ?></p>
                    </div>
                    <div class="flex items-center text-gray-400">➤</div>
                    <div>
                        <p class="font-bold"><?php echo $dayOutVietnamese ?></p>
                        <p><?php echo $checkOut1 ?></p>
                    </div>
                    <div class="text-gray-600">đêm<br><?php echo $totalNights ?></div>
                </div>

                <!-- Thông tin phòng -->
                <div id="roomInfo"></div>


                <!-- Thuế -->
                <p class="text-xs text-gray-500 mb-1">Không bao gồm 15.5% thuế</p>

                <!-- Tổng -->
                <div class="flex justify-between items-center mb-4">
                    <p id="countRoom" class="text-xs text-orange-500"></p>
                    <p id="countPrice" class="font-bold text-lg"></p>
                </div>

                <!-- Chú thích -->
                <p class="text-xs text-gray-500 mb-4">
                    *Bạn sẽ thanh toán cho <?php echo $name ?> bằng đơn vị tiền tệ tương ứng.
                    Số tiền chính xác bằng đơn vị tiền tệ của bạn phụ thuộc vào thời điểm bạn thanh toán.
                </p>

                <!-- Nút đặt phòng -->
                <button id="booking" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                    Đặt phòng
                </button>
            </div>
        </div>
    </div>


    <!-- footer-->
    <div class=" mx-auto p-4 space-y-6">

        <!-- 3 lý do -->
        <div class="bg-gray-50 rounded-lg p-4 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div>
                <div class="text-orange-500 text-4xl mb-2">➡</div>
                <h3 class="text-orange-500 font-bold">Mức giá thấp nhất</h3>
                <p class="text-gray-600 text-sm">Đặt phòng trực tiếp và nhận mức giá thấp nhất độc quyền</p>
            </div>
            <div>
                <div class="text-orange-500 text-4xl mb-2">☑</div>
                <h3 class="text-orange-500 font-bold">Xác nhận ngay lập tức</h3>
                <p class="text-gray-600 text-sm">Sau khi bạn đặt phòng với chúng tôi, bạn sẽ nhận được xác nhận ngay lập
                    tức</p>
            </div>
            <div>
                <div class="text-orange-500 text-4xl mb-2">🛡</div>
                <h3 class="text-orange-500 font-bold">Quy trình an toàn</h3>
                <p class="text-gray-600 text-sm">Tất cả các chi tiết đặt phòng của bạn được bảo mật khi đặt phòng với
                    chúng tôi</p>
            </div>
        </div>

        <!-- Về khách sạn -->
        <div class="bg-gray-50 rounded-lg p-4 space-y-4 mt-2">
            <h3 class="font-bold text-lg">Về khách sạn</h3>
            <p class="text-gray-700 text-sm">
                Tọa lạc tại thành phố Đà Lạt, trong bán kính 2,1 km từ Vườn hoa Đà Lạt và 2,5 km từ Hồ Xuân Hương,
                Thanh Tin Hotel cung cấp chỗ nghỉ có khu vườn và Wi-Fi miễn phí trong toàn bộ khuôn viên cũng như chỗ đỗ
                xe riêng miễn phí cho những khách lái xe.
                Nơi nghỉ này cách Công viên Yersin Đà Lạt 2,5 km, cách Quảng trường Lâm Viên 2,6 km và cách Thiền viện
                Trúc Lâm 8 km.
                Khách sạn có tiện nghi BBQ và lễ tân 24 giờ.
            </p>
            <p class="text-gray-700 text-sm">
                Các phòng nghỉ tại khách sạn có khu vực tiếp khách, truyền hình cáp và phòng tắm riêng với dép cùng bồn
                rửa vệ sinh.
                Tại Khách sạn Thành Tín tất cả các phòng đều được trang bị khăn trải giường và khăn tắm.
            </p>
            <p class="text-gray-700 text-sm">
                Khu vực này nổi tiếng với hoạt động đi xe đạp và dịch vụ cho thuê xe hơi được cung cấp tại chỗ nghỉ.
            </p>
            <div class="space-y-1 text-sm">
                <p><span class="font-bold">Địa chỉ</span>: 31 Hung Vuong Street, Ward 10, Da Lat City, Lam Dong
                    Province, 670000</p>
                <p><span class="font-bold">Thời gian nhận phòng</span>: 14:00</p>
                <p><span class="font-bold">Thời gian trả phòng</span>: 12:00</p>
                <p><span class="font-bold">Các hình thức thanh toán được chấp nhận tại chỗ nghỉ</span>:
                    Tiền mặt, Chuyển khoản, Thẻ tín dụng, Auto CC, Auto VCC, E Wallet, Other
                </p>
            </div>
        </div>
    </div>
</div>
<div id="div-2" class="hidden grid grid-cols-1 md:grid-cols-3 w-full mx-auto py-6 px-4">
    <div class="md:col-span-1 mx-auto rounded-xl pl-6 pr-6 pb-6">
        <div id="divOrder2" class="sticky top-0 z-50 mx-auto border rounded-lg shadow-md p-4 text-sm mt-2 mb-2">
            <!-- Tiêu đề -->
            <h2 class="font-bold text-lg mb-4">TỔNG QUAN ĐẶT PHÒNG</h2>
            <!-- Ngày -->
            <div class="flex justify-between mb-4">
                <div>
                    <p class="font-bold"><?php echo $dayInVietnamese ?></p>
                    <p><?php echo $checkIn1 ?></p>
                </div>
                <div class="flex items-center text-gray-400">➤</div>
                <div>
                    <p class="font-bold"><?php echo $dayOutVietnamese ?></p>
                    <p><?php echo $checkOut1 ?></p>
                </div>
                <div class="text-gray-600">đêm<br><?php echo $totalNights ?></div>
            </div>
            <!-- Thông tin phòng -->
            <div id="roomInfor"></div>
            <!-- Thuế -->
            <p class="text-xs text-gray-500 mb-1">Không bao gồm 15.5% thuế</p>

            <!-- Tổng -->
            <div class="flex justify-between items-center mb-4">
                <p id="countRoom2" class="text-xs text-orange-500"></p>
                <p id="countPrice2" class="font-bold text-lg"></p>
            </div>
            <!-- Change selection -->
            <a id="change" class="text-blue-600 text-sm font-medium hover:underline cursor-pointer">Thay đổi lựa chọn
                phòng</a>
            <!-- Fees -->
            <div class="text-xs text-gray-500 space-y-1 pt-4 pb-2">
                <div class="flex justify-between">
                    <span>Phí dịch vụ</span>
                    <span>0 ₫ </span>
                </div>
                <div class="flex justify-between">
                    <span>VAT</span>
                    <span>0 ₫ </span>
                </div>
            </div>

            <!-- Pay at hotel -->
            <div class="flex justify-between font-mediumtext-xs text-gray-500">
                <span>Tổng tiền cần thanh toán tại khách sạn</span>
                <span>0 ₫ </span>
            </div>

            <!-- Guests -->
            <p class="text-sm mb-2">
                Cho <span class="font-medium text-black"><?php echo $member ?></span> khách, <span
                    class="font-medium text-black"> <?php echo $roomNumber ?></span>
                phòng và
                <span class="text-orange-600 font-medium">
                    <?php echo $totalNights ?></span> đêm
            </p>

            <!-- Discount code -->
            <a href="#" class="flex items-center gap-1 text-green-600 text-sm hover:underline">
                ✅ Sử dụng mã giảm giá
            </a>

            <!-- Total -->
            <div class="bg-gray-100 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">Tổng cộng</span>
                    <div id="total" class="text-right">

                    </div>
                </div>
            </div>

            <!-- Total due today -->


            <!-- Note -->
            <p class="text-xs text-gray-500 leading-relaxed mb-2">
                *Bạn sẽ thanh toán bằng đơn vị tiền tệ VND.
                Số tiền chính xác bằng đơn vị tiền tệ của bạn phụ thuộc vào thời điểm bạn thanh toán.
            </p>
            <!-- Chú thích -->
            <p class="text-xs text-gray-500 mb-4">
                *Bạn sẽ thanh toán cho <?php echo $name ?> bằng đơn vị tiền tệ tương ứng.
                Số tiền chính xác bằng đơn vị tiền tệ của bạn phụ thuộc vào thời điểm bạn thanh toán.
            </p>

        </div>
    </div>

    <!-- RIGHT - Customer Form -->
    <div class="md:col-span-2  rounded-xl pl-6 pr-6 pb-6">
        <h2 class="text-xl font-bold mb-4">Nhập thông tin chi tiết của bạn</h2>

        <form id="bookingForm"
            action="<?php echo $check_internet == true ? '../controllers/booking.php' : '../utils/internet.php'; ?>"
            method="post">
            <!-- các giá trị ẩn -->
            <input id="hotel_id" type="text" name="hotel_id" value="<?php echo $hotel_id ?>" placeholder="000000"
                class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="member_last" type="text" name="member_last" value="<?php echo $member ?>" placeholder="000000"
                class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="nameHotel_last" type="text" name="nameHotel_last" value="<?php echo $name ?>"
                placeholder="000000" class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="roomNumber_last" type="text" name="roomNumber_last" value="<?php echo $roomNumber ?>"
                placeholder="000000" class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="check_in_last" type="text" name="check_in_last" value="<?php echo $checkIn1 ?>"
                placeholder="000000" class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="check_out_last" type="text" name="check_out_last" value="<?php echo $checkOut1 ?>"
                placeholder="000000" class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="counter" type="text" name="counter" placeholder="000000"
                class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="total_rooms" type="text" name="total_rooms" placeholder="000000"
                class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="total_price" type="text" name="total_price" placeholder="000000"
                class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="address" type="text" name="address" value="<?php echo $address ?>" placeholder="000000"
                class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <input id="city" type="text" name="city" value="<?php echo $city ?>" placeholder="000000"
                class="hidden flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
            <!-- Contact Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="text-sm font-medium">Email của bạn*</label>
                    <input type="email" name="email" required
                        oninvalid="this.setCustomValidity('Vui lòng nhập email !')" oninput="this.setCustomValidity('')"
                        placeholder="example@mail.com"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label class="text-sm font-medium">Số điện thoại*</label>
                    <div class="flex mt-1">

                        <input type="text" required oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại !')"
                            oninput="this.setCustomValidity('')" pattern="[0-9]{10}" maxlength="10" name="telephone"
                            required placeholder="9999999999" class="flex-1 border rounded-r-lg px-3 py-2 rounded-lg" />
                    </div>
                </div>
            </div>

            <!-- Room Info -->
            <div id="roomBooking" class="space-y-4">

            </div>

            <!-- Payment -->
            <h3 class="text-lg font-semibold mb-3">Thanh toán</h3>
            <div class="border rounded-lg p-4">
                <p class="font-medium mb-2">Credit or debit card</p>
                <input type="text" placeholder="Card number" class="w-full border rounded-lg px-3 py-2 mb-3" />
                <div class="grid grid-cols-3 gap-3">
                    <input type="text" placeholder="MM/YY" class="border rounded-lg px-3 py-2" />
                    <input type="text" placeholder="CVV" class="border rounded-lg px-3 py-2" />
                    <input type="text" placeholder="Name on card" class="border rounded-lg px-3 py-2" />
                </div>
            </div>

            <!-- Confirm Button -->
            <button id="btnBookingNow" onclick="bookingNow()"
                class="mt-6 w-full bg-blue-600 text-white font-medium py-3 rounded-lg hover:bg-blue-700">
                Đặt phòng
            </button>
        </form>
        <!-- Bullet list -->
        <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm p-6">
            <li>Xác nhận đặt phòng ngay lập tức</li>
            <li>Không cần đăng ký</li>
            <li>Miễn phí đặt phòng và giao dịch thẻ!</li>
        </ul>

        <!-- Property info -->
        <div class="bg-gray-100 rounded-lg pr-6 pl-6 pt-2 pb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Thông tin tài sản</h2>

            <div class="space-y-3 text-sm text-gray-700">
                <div class="flex justify-start gap-2">
                    <span class="font-medium">Thời gian nhận phòng:</span>
                    <span>16:00</span>
                </div>
                <div class="flex justify-start gap-2">
                    <span class="font-medium">Thời gian trả phòng:</span>
                    <span>12:00</span>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Khai báo mảng lưu thông tin phòng đã chọn ở phía client
        let array = [];
        let roomInfo = document.getElementById('roomInfo');
        let roomInfor = document.getElementById('roomInfor');
        const total = document.getElementById('total');
        const roomBooking = document.getElementById('roomBooking');
        const btnBooking = document.getElementById('booking');
        const div1 = document.getElementById('div-1');
        const div2 = document.getElementById('div-2');
        const change = document.getElementById('change');
        const totalTypeRoom = document.getElementById("roomNumber_last");
        // Hàm cập nhật thông tin phòng đã chọn
        btnBooking.addEventListener('click', function () {
            if (array.length === 0) {
                alert('Vui lòng chọn ít nhất một phòng trước khi đặt!');
                return;
            }
            else {
                div1.classList.add('hidden');
                div2.classList.remove('hidden');
            }


        });
        change.addEventListener('click', function () {
            div1.classList.remove('hidden');
            div2.classList.add('hidden');
        });
        // Cập nhật số lượng phòng và tổng giá


        // Lặp qua từng phòng để thêm sự kiện click
        for (let i = 1; i <= <?php echo count($roomsList); ?>; i++) {
            // Lấy các phần tử cần thiết
            const nameRoom = document.getElementById('roomName-' + i);
            const roomId = document.getElementById('id-' + i);
            const stateDiv = document.getElementById('state-' + i);
            const dataValue = stateDiv.getAttribute('data-value');
            const priceDiv = document.getElementById('divPrice-' + i);
            const button = document.getElementById('btnSelect-' + i);
            const select = document.getElementById('select' + i);
            const outPutPrice = document.getElementById('outPutprice-' + i);
            // Lấy giá trị price dạng text, loại bỏ ký tự không phải số, chuyển về số
            const priceText = document.getElementById('price-' + i).textContent;
            const price = Number(priceText.replace(/[^\d]/g, ''));
            if (dataValue == 0) {
                stateDiv.classList.remove('hidden');
            } else {
                stateDiv.classList.add('hidden');
            }
            document.getElementById('btnSelect-' + i).addEventListener('click', function () {

                // Kiểm tra nếu giá đã được chọn
                if (dataValue == 0) {
                    alert('Phòng đã hết, vui lòng chọn phòng khác!');
                }
                else {
                    if (priceDiv.classList.contains('bg-gray-300') && button.textContent === 'Đã Chọn') {
                        priceDiv.classList.remove('bg-gray-300');
                        button.textContent = 'chọn';
                        button.classList.remove('bg-green-500', 'text-white');
                        button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                        if (select.value > 0) {
                            select.value = 0;
                            outPutPrice.textContent = '';
                        }
                        array = array.filter(item => item.room_id !== roomId.id.split('-')[1]); // Lấy ID phòng từ id của div
                        myClickRoonInfor();
                    } else {
                        priceDiv.classList.add('bg-gray-300');
                        button.textContent = 'Đã Chọn';
                        button.classList.add('bg-green-500', 'text-white');
                        button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                        if (select.value == 0) {
                            select.value = 1;
                        }
                        // Update output price
                        const selectedValue = select.value;
                        if (selectedValue > 0) {
                            const totalPrice = price * selectedValue;
                            outPutPrice.textContent = 'Tổng giá: ' + totalPrice.toLocaleString('vi-VN') + '₫ ' + selectedValue + 'phòng ' + <?php echo $roomNumber ?> + 'Khách';
                            array.push({
                                'room_id': roomId.value, // Lấy ID phòng từ id của div
                                'name': nameRoom.textContent, // Lấy tên phòng từ phần tử
                                'selected_rooms': selectedValue,
                                'price': totalPrice
                            });
                            //load lại trang 
                            myClickRoonInfor();
                        } else {
                            outPutPrice.textContent = ''; // Clear output if no rooms selected
                            array = array.filter(item => item.room_id !== i); // Remove from array if no rooms selected
                            myClickRoonInfor();
                        }
                    }
                }
            });

            document.getElementById('select' + i).addEventListener('change', function () {
                const selectedValue = this.value;
                if (selectedValue == 0) {
                    priceDiv.classList.remove('bg-gray-300');
                    button.textContent = 'Chọn';
                    button.classList.remove('bg-green-500', 'text-white');
                    button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    outPutPrice.textContent = ''; // Clear output if no rooms selected
                    array = array.filter(item => item.room_id !== roomId.id.split('-')[1]); // Lấy ID phòng từ id của div
                    myClickRoonInfor();
                } else {
                    priceDiv.classList.add('bg-gray-300');
                    button.textContent = 'Đã Chọn';
                    button.classList.add('bg-green-500', 'text-white');
                    button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    if (selectedValue > 0) {
                        const totalPrice = price * selectedValue;
                        outPutPrice.textContent = 'Tổng giá: ' + totalPrice.toLocaleString('vi-VN') + '₫ ' + selectedValue + 'phòng ' + <?php echo $roomNumber ?> + 'Khách';
                        // Cập nhật thông tin phòng đã chọn
                        if (array.length === 0) {
                            array.push({
                                'room_id': roomId.value, // Lấy ID phòng từ id của div
                                'name': nameRoom.textContent, // Lấy tên phòng từ phần tử
                                'selected_rooms': selectedValue,
                                'price': totalPrice
                            });
                            //load lại trang
                            myClickRoonInfor();
                        }
                        else {
                            const roomIdStr = roomId.value;
                            const found = array.find(item => item.room_id === roomIdStr);
                            if (found) {
                                found.selected_rooms = selectedValue;
                                found.price = totalPrice;
                            } else {
                                array.push({
                                    'room_id': roomIdStr,
                                    'name': nameRoom.textContent,
                                    'selected_rooms': selectedValue,
                                    'price': totalPrice
                                });
                                //load lại trang
                            }
                            myClickRoonInfor();
                        }
                    } else {
                        outPutPrice.textContent = ''; // Clear output if no rooms selected
                        array = array.filter(item => item.room_id !== roomId.id.split('-')[1]);; // Remove from array if no rooms selected
                        myClickRoonInfor();
                    }
                }
            });

        }
        function bookingNow() {
            const totalItems = array.length;
            document.getElementById("counter").value = totalItems;
            // Tính tổng giá và chuyển sang định dạng tiền Việt Nam
            const totalPrice = array.reduce((sum, item) => sum + Number(item.price), 0);
            document.getElementById("total_price").value = totalPrice.toLocaleString('vi-VN');
        }

        function myClickRoonInfor() {
            // Lấy thông tin phòng đã chọn
            let roomInfoHTML = '';
            let roomInforHTML = '';
            let totalHTML = '';
            let totalPrice = 0;
            let roomBookingHTML = '';
            let count = 1;
            array.forEach(item => {
                let total = item['price'];
                totalPrice += item['price'];
                let formart = total.toLocaleString('vi-VN');
                let formartPrice = totalPrice.toLocaleString('vi-VN');
                roomInfoHTML += `<div class="border rounded-lg p-3 mb-2">
                        <div class="flex justify-between items-center mb-1">
                            <div class="flex gap-2">
                             <p class="font-bold flex items-center gap-2">
                                <span>🏨</span>${item['name']}
                            </p>
                             
                              <p class="font-bold flex items-center gap-2">
                                x ${item['selected_rooms']}
                            </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-orange-500 text-white text-xs px-2 py-1 rounded">Giảm giá 51%</span>
                                <i class="fas fa-times fa-xl cursor-pointer" onclick="deleteRoom(${item['room_id']})"></i>
                            </div>
                        </div>
                        <p class="text-gray-500 text-xs mb-2">Room Only Free Cancellation</p>
                        <ul class="text-gray-600 text-xs list-disc list-inside mb-2">
                            <li>Không bao gồm ăn sáng</li>
                            <li>Hủy: Được hoàn tiền lên đến 1 ngày trước khi nhận phòng</li>
                        </ul>
                        <p class="text-blue-600 underline text-xs cursor-pointer mb-2"><?php echo $totalNights ?> đêm</p>
                        <p class="text-right font-bold">${formart} ₫  </p>
                    </div>`;
                roomInforHTML += `<div class="border rounded-lg p-3 mb-2">
                        <div class="flex justify-between items-center mb-1">
                            <div class="flex gap-2">
                             <p class="font-bold flex items-center gap-2">
                                <span>🏨</span>${item['name']}
                            </p>
                             
                              <p class="font-bold flex items-center gap-2">
                                x ${item['selected_rooms']}
                            </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-orange-500 text-white text-xs px-2 py-1 rounded">Giảm giá 51%</span>
                               </div>
                        </div>
                        <p class="text-gray-500 text-xs mb-2">Room Only Free Cancellation</p>
                        <ul class="text-gray-600 text-xs list-disc list-inside mb-2">
                            <li>Không bao gồm ăn sáng</li>
                            <li>Hủy: Được hoàn tiền lên đến 1 ngày trước khi nhận phòng</li>
                        </ul>
                        <p class="text-blue-600 underline text-xs cursor-pointer mb-2"><?php echo $totalNights ?> đêm</p>
                        <p class="text-right font-bold">${formart} ₫  </p>
                    </div>`;
                totalHTML = ` <p class="text-2xl font-bold text-gray-800">${formartPrice} ₫</p>`;
                roomBookingHTML += ` <div class="border rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center">
                    <p class="font-semibold">${item['name']}</p>
                    <span class="bg-orange-500 text-white text-xs font-semibold px-2 py-1 rounded">
                        Giảm giá 54%
                    </span>
                </div>
                <p class="text-sm text-gray-500">Room Only Non-Refundable</p>

                <div class="mt-3 flex items-center gap-2">
                    <label class="text-sm">Người lớn:</label>
                    <select name="selected-${count}" class="border rounded px-2 py-1">
                        <?php for ($i = 1; $i <= $member; $i++): ?>
                            <option><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            
            
            <!-- Guest Name -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="text-sm font-medium">Tên đầu tiên*</label>
                    <input type="text" required 
  oninvalid="this.setCustomValidity('Vui lòng nhập tên đầu !')" 
  oninput="this.setCustomValidity('')" name="firstName-${count}" placeholder="A" class="mt-1 w-full border rounded-lg px-3 py-2" />
                </div>
           <!-- input ẩn -->
                  <input type="text" name="id-${count}" value="${item['room_id']}" class="hidden mt-1 w-full border rounded-lg px-3 py-2" />
                  <input type="text"  name="totalPrice-${count}" value="${formart}" class="hidden mt-1 w-full border rounded-lg px-3 py-2" />
                 <input type="text" name="totalRooms-${count}" value="${item['selected_rooms']}" class="hidden mt-1 w-full border rounded-lg px-3 py-2" />
                <div>
                    <label class="text-sm font-medium">Họ*</label>
                    <input type="text" required 
            oninvalid="this.setCustomValidity('Vui lòng nhập tên cuối !')" 
               oninput="this.setCustomValidity('')" name="lastName-${count}" placeholder="Nguyễn Văn" class="mt-1 w-full border rounded-lg px-3 py-2" />
                </div>
            </div>`;
                count++;
            });
            totalTypeRoom.value = array.length;
            const totalRooms = array.reduce((sum, item) => sum + Number(item.selected_rooms), 0);
            document.getElementById('countRoom').textContent = 'Tổng ' + totalRooms + ' phòng';
            document.getElementById('total_rooms').value = totalRooms;
            // document.getElementById("total_price").value = formartPrice;
            document.getElementById('countPrice').textContent = array.reduce((total, item) => total + item.price, 0).toLocaleString('vi-VN') + '₫';
            // Cập nhật nội dung của phần tử roomInfo
            roomInfo.innerHTML = roomInfoHTML;
            roomInfor.innerHTML = roomInforHTML;
            total.innerHTML = totalHTML;
            roomBooking.innerHTML = roomBookingHTML;
            count++;

        }


        function deleteRoom(roomId) {
            if (confirm('Bạn có chắc chắn muốn xóa phòng này không? ' + roomId)) {
                const index = array.findIndex(item => item.room_id == roomId);
                if (index >= 0 && index < array.length) {
                    array.splice(index, 1);
                    // Reset select về 0
                    const selectEl = document.getElementById('select' + roomId);
                    if (selectEl) selectEl.value = 0;
                    // Reset trạng thái nút và màu
                    const priceDiv = document.getElementById('divPrice-' + roomId);
                    const button = document.getElementById('btnSelect-' + roomId);
                    const outPutPrice = document.getElementById('outPutprice-' + roomId);
                    if (priceDiv && button) {
                        priceDiv.classList.remove('bg-gray-300');
                        button.textContent = 'Chọn';
                        button.classList.remove('bg-green-500', 'text-white');
                        button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    }
                    if (outPutPrice) outPutPrice.textContent = '';
                    console.log("Array sau khi xóa:", array);
                } else {
                    console.log("Vị trí không hợp lệ:", index);
                }
                myClickRoonInfor();
            }
        }

    </script>