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

        if (window.scrollY > 80) {
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
                'md:duration-500',
                'md:ease-in-out',
                'md:transform',
                'md:translate-y-0',
                'md:opacity-100'
            );

            findId.classList.add('sm:mt-2', 'md:border-2', 'md:border-gray-700', 'md:transition-all', 'md:duration-500');
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


