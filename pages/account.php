<div class="grid grid-cols-1 md:grid-cols-4 max-w-6xl mx-auto  px-4 py-12 pt-32 sm:pt-20 gap-4">
    <div class=" sm:sticky top-20 z-0 grid grid-rows-7 mb-4 md:col-span-1 space-y-6 rounded-lg gap-2 self-start">
        <!-- Quay lại -->
        <div>
            <button id=""
                class="md:col-span-1 text-center hover:bg-gray-200 rounded-lg p-4 font-bold flex items-center justify-start w-full"
                onclick="window.location='index.php'">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </button>
        </div>
        <!-- Tài khoản của bạn -->
        <div>
            <button id="button-account-1"
                class="md:col-span-1 text-center hover:bg-gray-200 rounded-lg p-4 font-bold flex items-center justify-start  w-full"
                onclick="selectKind(1);window.scrollTo({top: 0, behavior: 'smooth'})">
                <i class="fas fa-user mr-2"></i> Tài khoản của bạn
            </button>
        </div>
        <!-- Xem gần đây -->
        <div>
            <button id="button-account-2"
                class="md:col-span-1 text-center hover:bg-gray-200 rounded-lg p-4 font-bold flex items-center justify-start  w-full"
                onclick="selectKind(2);window.scrollTo({top: 0, behavior: 'smooth'})">
                <i class="fas fa-clock mr-2"></i> Lich sử đặt phòng
            </button>
        </div>
        <!-- Yêu thích -->
        <div>
            <button id="button-account-3"
                class="md:col-span-1 text-center hover:bg-gray-200 rounded-lg p-4 font-bold flex items-center justify-start  w-full"
                onclick="selectKind(3); window.scrollTo({top: 0, behavior: 'smooth'})">
                <i class="fas fa-heart mr-2"></i> Yêu thích
            </button>
        </div>
        <!-- Thông báo -->
        <div>
            <button id="button-account-4"
                class="md:col-span text-center hover:bg-gray-200 rounded-lg p-4 font-bold flex items-center justify-start  w-full"
                onclick="selectKind(4);window.scrollTo({top: 0, behavior: 'smooth'})">
                <i class="fas fa-bell mr-2"></i> Thông báo
            </button>
        </div>
        <!-- Hỗ trợ & trợ giúp -->
        <div>
            <button id="button-account-5"
                class="md:col-span-1 text-center hover:bg-gray-200 rounded-lg p-4 font-bold flex items-center justify-start  w-full"
                onclick="selectKind(5);window.scrollTo({top: 0, behavior: 'smooth'})">
                <i class="fas fa-question-circle mr-2"></i> Hỗ trợ & trợ giúp
            </button>
        </div>
        <!-- Đăng xuất -->
        <div>
            <button id="button-account-6"
                class="md:col-span-1 text-center hover:bg-gray-200 rounded-lg p-4 font-bold flex items-center justify-start  w-full"
                onclick="selectKind(6);window.scrollTo({top: 0, behavior: 'smooth'})">
                <i class="fas fa-right-from-bracket mr-2"></i> Đăng xuất
            </button>
        </div>
    </div>

    <div id="output-kind" class="gap-4 md:col-span-3">

    </div>
</div>
<script>
    const outputkind = document.getElementById("output-kind");

    document.addEventListener('DOMContentLoaded', function () {
        selectKind(1); // mặc định mở profile
    });

    function selectKind(index) {
        let file = "";
        switch (index) {
            case 1:
                file = "includes/profile.php";
                break;
            case 2:
                file = "includes/recently.php";
                break;
            case 3:
                file = "includes/like.php";
                break;
            case 4:
                file = "includes/notifcation.php";
                break;
            case 5:
                file = "includes/contact.php";
                break;
            case 6:
                window.location.href = "../DOAN/controllers/logout.php";
                break;
            default:
                file = "pages/profile.php";
        }

        // Load nội dung bằng fetch
        fetch(file)
            .then(res => res.text())
            .then(data => {
                outputkind.innerHTML = data;
                changeBorder(index);
                myImage(<?php echo $userModel->avatar ?>); // Mặc định hiển thị avatar hiện tại
            })
            .catch(err => console.error(err));
    }

    function changeBorder(index) {
        // reset tất cả button
        for (let i = 1; i <= 6; i++) {
            document.getElementById(`button-account-${i}`).classList.remove('bg-gray-300');
        }
        // set cho nút đang chọn
        document.getElementById(`button-account-${index}`).classList.add('bg-gray-300');
    }
    window.myImage = function (index) {
        // // Xóa viền cũ
        for (let i = 0; i <= 11; i++) {
            document.getElementById('avatar-' + i).classList.remove('border-2', 'border-gray-700');
        }

        // Thêm viền cho avatar được chọn
        document.getElementById('avatar-' + index).classList.add('border-2', 'border-gray-700');

        // Đổi ảnh chính
        document.getElementById('image').src = 'assets/images/avatar-' + index + '.png';

        // Cập nhật giá trị ẩn
        document.getElementById('avatar').value = index;

    }


</script>