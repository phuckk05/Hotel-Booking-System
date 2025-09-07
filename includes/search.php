<?php
//Lấy nội dung tìm kiếm 
?>
<div id="serachInId"
    class="z-9999 flex-cols-2 md:flex  bg-white rounded-2xl shadow-lg items-center overflow-hidden max-w-7xl mx-auto">
    <!-- Điểm đến -->
    <div class="flex items-center px-5 w-full md:w-1/3">
        <div class="flex-1">
            <label class="text-sm text-gray-500">Điểm đến</label>

            <?php $provinces = json_decode(file_get_contents(__DIR__ . '/../documents/province.json'), true); ?>
            <select id="location" class="w-full font-semibold text-gray-800 focus:outline-none bg-transparent">
                <option value="<?php echo isset($location) && $location ? $location : 'Chọn điểm đến'; ?>">
                    <?php echo isset($location) && $location ? $location : 'Chọn điểm đến'; ?>
                </option>
                <?php foreach ($provinces as $province): ?>
                    <option value="<?= htmlspecialchars($province['name_with_type']) ?>">
                        <?= htmlspecialchars($province['name_with_type']) ?>
                    </option> <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-4 w-full md:w-2/3">

        <!-- Ngày nhận -->
        <div class="flex items-center px-4 py-3 w-full md:w-1/2 relative rounded-lg cursor-pointer"
            onclick="document.getElementById('checkin').showPicker();">
            <svg class="w-5 h-5 text-gray-500 mr-2 pointer-events-none" fill="none" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <div class="flex-1">
                <label class="text-sm text-gray-500">Nhận phòng</label>
                <input id="checkinText" type="text" value="<?php echo isset($checkIn) && $checkIn ? $checkIn : ''; ?>"
                    placeholder="Chọn ngày"
                    class="w-full font-semibold text-gray-800 bg-transparent pointer-events-none" />
            </div>
            <!-- input ẩn nhưng trigger được -->
            <input id="checkin" value="<?php echo isset($checkIn) && $checkIn ? $checkIn : ''; ?>" type="date"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
        </div>

        <!-- Ngày trả -->
        <div class="flex items-center px-4 py-3 w-full md:w-1/2 relative rounded-lg cursor-pointer"
            onclick="document.getElementById('checkout').showPicker()">
            <svg class="w-5 h-5 text-gray-500 mr-2 pointer-events-none" fill="none" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <div class="flex-1">
                <label class="text-sm text-gray-500">Trả phòng</label>
                <input id="checkoutText" type="text"
                    value="<?php echo isset($checkOut) && $checkOut ? $checkOut : ''; ?>" placeholder="Chọn ngày"
                    class="w-full font-semibold text-gray-800 bg-transparent pointer-events-none" />
            </div>
            <!-- input ẩn nhưng trigger được -->
            <input id="checkout" value="<?php echo isset($checkOut) && $checkOut ? $checkOut : ''; ?>" type="date"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
        </div>

    </div>

    <!-- Khách & phòng -->
    <div class="flex items-center px-4uuu w-full md:w-1/3 gap-4">
        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 20h5v-2a3 3 0 00-3-3h-4v5zM9 20H4v-2a3 3 0 013-3h4v5zM12 12a5 5 0 100-10 5 5 0 000 10z" />
        </svg>

        <!-- Số khách -->
        <div class="flex-1">
            <label class="text-sm text-gray-500">Số khách</label>
            <input id="member" type="number" min="1"
                value="<?php echo isset($checkMember) && $checkMember ? $checkMember : '1'; ?>"
                class="w-full font-semibold text-gray-800 focus:outline-none bg-transparent cursor-pointer" />
        </div>

        <!-- Số phòng -->
        <div class="flex-1">
            <label class="text-sm text-gray-500">Số phòng</label>
            <input id="roomNumber" type="number" min="1"
                value="<?php echo isset($checkRoomNumber) && $checkRoomNumber ? $checkRoomNumber : '1'; ?>"
                class="w-full font-semibold text-gray-800 focus:outline-none bg-transparent cursor-pointer" />
        </div>
    </div>

    <!-- Nút tìm -->
    <div class="px-5 flex justify-center p-4">
        <button id="findButton" onclick="myFormInSearch()"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-10 py-3 rounded-lg shadow-md transition duration-300">
            Tìm
        </button>
    </div>
</div>
<script>
    //Lấy ngày today
    // Trả về đối tượng Date của hôm nay


    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");
    const checkinText = document.getElementById("checkinText");
    const checkoutText = document.getElementById("checkoutText");

    checkin.addEventListener("change", () => {
        checkinText.value = formatDate(checkin.value);
    });

    checkout.addEventListener("change", () => {
        checkoutText.value = formatDate(checkout.value);
    });



</script>