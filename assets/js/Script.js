// Mobile function
function menuClick() {

    const mobileMenu = document.getElementById('mobileMenu');
    const iconMenu = document.getElementById('icon-menu');

    // Toggle menu với hiệu ứng trượt
    if (mobileMenu.classList.contains('max-h-0')) {
        mobileMenu.classList.remove('max-h-0');
        mobileMenu.classList.add('max-h-96');

    } else {
        mobileMenu.classList.remove('max-h-96');
        mobileMenu.classList.add('max-h-0');

    }
}
if (window.location.pathname.endsWith("index.php") && window.location.search.includes("page=1")) {
    console.log("Path:", window.location.pathname);
    window.addEventListener("scroll", function () {
        let headerId = document.getElementById('headerId');
        let searchId = document.getElementById('searchId');
        let findId = document.getElementById('serachInId');

        if (window.scrollY > 100) {
            headerId.classList.remove('md:fixed', 'md:top-0', 'md:left-0');

            searchId.classList.remove('md:pt-20');
            searchId.classList.add(
                'md:pt-0',
                'md:fixed',
                'md:top-0',
                'md:pb-2',
                'md:bg-white',
                'md:shadow-lg',
                'md:transition-all',
                'md:duration-1000',
                'md:ease-in-out',
                'md:transform',
                'md:translate-y-0',
                'md:opacity-100'
            );

            findId.classList.add('sm:mt-2', 'md:border-2', 'md:border-gray-700', 'md:transition-all', 'md:duration-1000');
        } else {
            headerId.classList.add('md:fixed', 'md:top-0', 'md:left-0');

            searchId.classList.add('md:pt-20');
            searchId.classList.remove(
                'md:fixed',
                'md:top-0',
                'md:bg-white',
                'md:pb-2',
                'md:shadow-lg',
                'md:translate-y-0',
                'md:opacity-100'
            );
            searchId.classList.add('opacity-100', '-translate-y-5', 'transition-all', 'duration-500');

            findId.classList.remove('sm:mt-2', 'md:border-2', 'md:border-gray-700', 'md:transition-all', 'md:duration-500');
        }
    });
}



// Bất sự kiện tắt menu khi click ra ngoài
document.addEventListener('click', function (event) {
    const menu = document.getElementById('mobileMenu');
    const icon = document.getElementById('icon-menu');

    // Nếu click không nằm trong menu và không phải icon menu
    if (!menu.contains(event.target) && !icon.contains(event.target)) {
        mobileMenu.classList.remove('max-h-96');
        mobileMenu.classList.add('max-h-0');
    }
});

function borderClick() {
    const select = document.getElementById('border-in-avatar');
    if (select.classList.contains('hidden')) {
        select.classList.remove('hidden');
    } else {
        select.classList.add('hidden');
    }
}


function myFormInSearch() {
    console.log("Button Tìm clicked");
    const location = document.getElementById('location').value;
    const checkIn = document.getElementById('checkin').value;
    const checkOut = document.getElementById('checkout').value;
    const member = document.getElementById('member').value;
    const roomNumber = document.getElementById('roomNumber').value;
    if (!location || !checkIn || !checkOut || !member || !roomNumber) {
        console.log("Địa chỉ : ", location);
        console.log("Button Tìm clicked");
        alert('Vui lòng điền đầy đủ thông tin tìm kiếm.');
        return false;
    }
    // Hiện overlay nếu có
    var loading = document.getElementById('loadingOverlay');
    if (loading) loading.classList.remove('hidden');

    // Chuyển hướng qua index.php?page=1&...
    setTimeout(function () {
        window.location.href = 'index.php?page=1&location=' + encodeURIComponent(location) + '&checkin=' + encodeURIComponent(checkIn) + '&checkout=' + encodeURIComponent(checkOut) + '&member=' + encodeURIComponent(member) + '&roomNumber=' + encodeURIComponent(roomNumber);
    }, 1000);
    return true;
}
function todayDate() {
    const d = new Date();
    d.setHours(0, 0, 0, 0); // reset giờ để so sánh chính xác
    return d;
}

// Hàm format ngày đẹp (DD/MM)
function formatDate(dateStr) {
    if (!dateStr) return "";
    const d = new Date(dateStr);
    d.setHours(0, 0, 0, 0); // reset giờ

    const today = todayDate();

    if (d < today) {
        alert('Lỗi: Ngày chọn nhỏ hơn hôm nay');
        return "";
    }

    return d.toLocaleDateString("vi-VN", { day: "2-digit", month: "2-digit" });
}