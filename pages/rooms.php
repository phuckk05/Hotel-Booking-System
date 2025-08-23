<?php
if (isset($_GET['location']) && isset($_GET['checkin']) && isset($_GET['checkout']) && isset($_GET['member']) && isset($_GET['roomNumber'])) {
    $location = htmlspecialchars($_GET['location']);
    $checkIn = htmlspecialchars($_GET['checkin']);
    $checkOut = htmlspecialchars($_GET['checkout']);
    $checkMember = htmlspecialchars($_GET['member']);
    $checkRoomNumber = htmlspecialchars($_GET['roomNumber']);
} else {
    $location = '';
    $checkIn = '';
    $checkOut = '';
    $checkMember = '';
    $checkRoomNumber = '';
}
?>
<div>
    <!-- Thanh tìm kiếm -->
    <div id="searchId" class="pt-32 md:pt-20 z-40 flex justify-center w-full mx-auto items-center">
        <?php
        include 'includes/search.php';
        ?>
    </div>
    <?php
    include 'includes/result.php';
    ?>
    <!-- Các địa điểm được đề xuất -->
    <h1 class="text-2xl mb-4 font-bold text-center">Đề xuất cho bạn</h1>
    <div class="grid grid-cols-2 sm:grid-cols-4 g p-4 gap-16 max-w-7xl mx-auto">
        <?php for ($i = 0; $i < 8; $i++): ?>
            <div
                class="flex-none md:w-64 w-48 overflow-hidden  hover:transform hover:scale-105 transition duration-300 hover:border-b-2 border-blue-600">
                <img src="assets/images/bg.webp" alt="Mô tả ảnh" class="w-full h-48 object-cover rounded-lg">
                <!--  whitespace-nowrap  -->
                <div class="py-2">
                    <h3 id="demo" class="text-sm font-bold mb-2 text-gray-800overflow">Vì hai thuộc tính này cùng hoạt động,
                        văn bản của bạn bị ép ở trên một dòng và phần bị thừa ra sẽ bị ẩn đi, dẫn đến kết quả là văn bản
                        không xuống dòng.</h3>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt text-blue-600"></i>
                    <p class="pl-1 text-blue-600 text-sm font-bold"> 123 Đường ABC, TP.HCM</p>
                </div>
                <div class="w-full overflow-hidden pb-4">
                    <h1 class="text-red-700 text-xl font-bold whitespace-nowrap truncate ">VND 1,000,000,0000000000000</h1>
                </div>

            </div>
        <?php endfor; ?>
    </div>

    <!-- Khám phá -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-center mb-8">
            Cảm giác như ở nhà dù bạn đi đến đâu
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <?php if ($i % 2 == 0): ?>
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition mt-0 md:mt-20">
                        <img src="assets/images/bg.webp" class="w-full h-40 object-cover rounded-t-lg" alt="Tây Ban Nha">
                        <div class="p-4">
                            <h3 class="font-bold text-lg">Tây Ban Nha</h3>
                            <p class="text-gray-600 text-sm mb-4">166.514 nhà nghỉ dưỡng</p>
                            <div class="flex justify-center items-center ma-auto">
                                <button class="px-4 py-2 border border-blue-500 text-blue-500 rounded hover:bg-blue-50">Khám
                                    phá</button>
                            </div>
                        </div>
                    </div>
                    
                <?php endif; ?>
                <?php if ($i % 2 == 1): ?>
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition mb-0 md:mb-20">
                        <img src="assets/images/bg.webp" class="w-full h-40 object-cover rounded-t-lg" alt="Tây Ban Nha">
                        <div class="p-4">
                            <h3 class="font-bold text-lg">Tây Ban Nha</h3>
                            <p class="text-gray-600 text-sm mb-4">166.514 nhà nghỉ dưỡng</p>
                            <div class="flex justify-center items-center ma-auto">
                                <button class="px-4 py-2 border border-blue-500 text-blue-500 rounded hover:bg-blue-50">Khám
                                    phá</button>
                            </div>
                        </div>
                    </div>
                
                <?php endif; ?>
            <?php endfor; ?>

        </div>
    </div>
</div>

<script>
    // Hàm để thay đổi ảnh đại diện
    function myFormInSearch() {
        //Lấy giá trị từ các trường tìm kiếm
        const location = document.getElementById('location').value;
        const checkIn = document.getElementById('checkin').value;
        const checkOut = document.getElementById('checkout').value;
        const member = document.getElementById('member').value;
        const roomNumber = document.getElementById('roomNumber').value;

        // // Kiểm tra nếu có trường nào rỗng
        if (!location || !checkIn || !checkOut || !member || !roomNumber) {
            alert('Vui lòng điền đầy đủ thông tin tìm kiếm.');
            return false; // Ngăn không cho gửi form
        }
        // Nếu tất cả các trường đều có giá trị, chuyển hướng đến trang kết quả tìm kiếm
        window.location.href = `index.php?page=1&location=${location}&checkin=${checkIn}&checkout=${checkOut}&member=${member}&roomNumber=${roomNumber}`;
    }
</script>