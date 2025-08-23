<!-- Các địa điểm thu hút khách du lịch -->
<div class="max-w-7xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4 font-bold">Các địa điểm được yêu thích</h1>
    <div class="flex overflow-x-scroll p-4 gap-4">
        <?php for ($i = 0; $i < 10; $i++): ?>
            <div class="flex-none md:w-64 w-48 bg-white rounded-lg shadow-md overflow-hidden  hover:transform hover:scale-105 transition duration-300">
                <img src="assets/images/bg.webp" alt="Mô tả ảnh" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2 text-red-600 text-center">Hà Nội</h3>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>