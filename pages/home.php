<div id="home" class="relative w-full h-screen">
  <!-- Background -->
  <img src="assets/images/bg.webp" alt="background"
    class="absolute inset-0 w-full h-full object-cover brightness-75 rounded-xl shadow-lg" loading="lazy">

  <!-- Overlay mờ -->
  <div class="absolute inset-0 bg-black/40 rounded-xl"></div>

  <!-- Nội dung chính -->
  <div class="relative z-10 max-w-7xl mx-auto h-full flex flex-col justify-center items-center px-4">
    <!-- Logo hoặc tiêu đề -->
    <h1 class="text-4xl sm:text-5xl font-bold text-white drop-shadow-lg text-center">
      Hotels Booking System
    </h1>
    <p class="text-lg text-gray-200 mt-3 mb-8 text-center max-w-2xl">
      Đặt phòng khách sạn nhanh chóng, tiện lợi và an toàn khắp Việt Nam ✨
    </p>

    <!-- Thanh tìm kiếm -->
    <?php include 'includes/search.php'; ?>

  </div>
</div>
<!-- Overlay Loading -->
<?php include 'includes/loading.php'; ?>
<!-- View: Locations -->
<section class="max-w-7xl mx-auto px-4 py-12">
  <?php include 'includes/locations.php'; ?>
</section>

<!-- View: Suggested Locations -->
<section class="max-w-7xl mx-auto px-4 py-12">
  <?php include 'includes/suggested_locations.php'; ?>
</section>