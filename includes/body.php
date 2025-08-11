<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="assets/tailwind/all-tailwind-classes-full-min.css">
  <title>Profile</title>
</head>
<body class="bg-gray-100">
  <main class="max-w-xl mx-auto mt-8 pt-8 pb-8">
    <!-- Card chính -->
    <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden">
      <!-- Cover image -->
      <div class="h-56 bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1544005313-94ddf0286df2');"></div>

      <!-- Avatar -->
      <div class="absolute left-6 top-40 transform -translate-y-1/2">
        <div class="w-28 h-28 rounded-full ring-4 ring-white overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="avatar" class="w-full h-full object-cover">
        </div>
      </div>

      <!-- Nội dung -->
      <div class="pt-16 pb-6 px-6">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-2xl font-semibold">Ngọc Trâm, <span class="text-gray-500 font-medium">23</span></h2>
            <p class="text-sm text-gray-500 mt-1 flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 11 7 11s7-5.75 7-11c0-3.87-3.13-7-7-7z"/></svg> Ho Chi Minh</p>
          </div>
          <div class="flex items-center space-x-3">
            <button class="bg-white border border-gray-200 rounded-lg px-3 py-2 hover:shadow">Message</button>
            <button class="bg-gradient-to-r from-pink-500 to-red-500 text-white rounded-lg px-4 py-2 shadow">Like</button>
          </div>
        </div>

        <!-- Bio -->
        <p class="mt-4 text-gray-700 leading-relaxed">
          📝 Loves travel, coffee and deep conversations. Photographer & UX designer. Looking for meaningful connection.
        </p>

        <!-- Info rows -->
        <div class="mt-4 grid grid-cols-2 gap-3">
          <div class="flex items-center space-x-3 bg-gray-50 p-3 rounded-lg">
            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zM6 20v-1c0-2.76 4.48-4 6-4s6 1.24 6 4v1H6z"/></svg>
            <div><div class="text-sm font-medium">Job</div><div class="text-xs text-gray-500">Flutter Dev</div></div>
          </div>
          <div class="flex items-center space-x-3 bg-gray-50 p-3 rounded-lg">
            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zM7 9h10v2H7z"/></svg>
            <div><div class="text-sm font-medium">Education</div><div class="text-xs text-gray-500">HCMC Univ</div></div>
          </div>
          <div class="flex items-center space-x-3 bg-gray-50 p-3 rounded-lg">
            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zM8 11h8v2H8z"/></svg>
            <div><div class="text-sm font-medium">Height</div><div class="text-xs text-gray-500">1.75m</div></div>
          </div>
          <div class="flex items-center space-x-3 bg-gray-50 p-3 rounded-lg">
            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zM7 9h10v2H7z"/></svg>
            <div><div class="text-sm font-medium">Relationship</div><div class="text-xs text-gray-500">Single</div></div>
          </div>
        </div>

        <!-- tags -->
        <div class="mt-4 flex flex-wrap gap-2">
          <span class="text-xs bg-pink-50 text-pink-600 px-3 py-1 rounded-full">Travel</span>
          <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full">Photography</span>
          <span class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full">Music</span>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
