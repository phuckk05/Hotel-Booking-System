<!-- Các địa điểm được đề xuất -->
<div class="p-4 rounded-lg max-w-7xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4 font-bold">Những chỗ nghỉ được đánh giá cao</h1>
    <div class="flex justify-between mx-auto">
        <div class="flex flex-rol gap-4 pl-4 pt-4 text-gray-600 font-bold">
            <button
                class="tab-button text-gray-600 px-1 block hover:text-indigo-600 transition duration-150 border-b-2 border-transparent hover:border-indigo-600 active-tab-class"
                data-tab="hanoi">Hà Nội</button>
            <button
                class="tab-button text-gray-600 px-1 block hover:text-indigo-600 transition duration-150 border-b-2 border-transparent hover:border-indigo-600"
                data-tab="hochiminh">Hồ Chí Minh</button>
            <button
                class="tab-button text-gray-600 px-1 block hover:text-indigo-600 transition duration-150 border-b-2 border-transparent hover:border-indigo-600"
                data-tab="danang">Đà Nẵng</button>
            <button
                class="tab-button text-gray-600 px-1 block hover:text-indigo-600 transition duration-150 border-b-2 border-transparent hover:border-indigo-600"
                data-tab="nhatrang">Nha Trang</button>
            <button
                class="tab-button text-gray-600 px-1 block hover:text-indigo-600 transition duration-150 border-b-2 border-transparent hover:border-indigo-600"
                data-tab="vungtau">Bà Rịa Vũng Tàu</button>


        </div>
        <div class="flex pt-4 font-bold text-blue-600">
            <button
                class="tab-button text-blue-600 px-1 block hover:text-indigo-600 transition duration-150 border-b-2 border-transparent "
                data-tab="vungtau">Xem tất cả</button>
        </div>
    </div>
    <div class="flex overflow-x-scroll p-4 gap-4">
        <?php for ($i = 0; $i < 10; $i++): ?>
            <div class="flex-none md:w-64 w-48 overflow-hidden  hover:transform hover:scale-105 transition duration-300 hover:border-b-2 border-blue-600">
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
                    <h1 class=" text-green-700 text-xl font-bold whitespace-nowrap truncate ">VND 1,000₫</h1>
                </div>

            </div>
        <?php endfor; ?>
    </div>
</div>
