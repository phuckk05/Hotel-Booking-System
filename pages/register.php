<?php
include '../includes/head.php';
?>
<?php if (isset($_GET['msg'])): ?>
  <script>
    <?php if ($_GET['msg'] == 'email_exists')
      echo "alert('Email đã tồn tại!');"; ?>
    window.history.replaceState({}, document.title, window.location.pathname);
    <?php if ($_GET['msg'] == 'missing_info')
      echo "alert('Thiếu thông tin!');"; ?>
    window.history.replaceState({}, document.title, window.location.pathname);
    <?php if ($_GET['msg'] == 'register_failed')
      echo "alert('Đăng kí thất bại!');"; ?>
    window.history.replaceState({}, document.title, window.location.pathname);
    <?php if ($_GET['msg'] == 'login_failed')
      echo "alert('Đăng nhập thất bại!');"; ?>
    window.history.replaceState({}, document.title, window.location.pathname);
  </script>
<?php endif; ?>



<div class="flex items-center justify-center min-h-screen bg-gray-100">
  <!-- SginUp -->
  <div
    class="bg-white rounded-lg shadow-md flex flex-col md:flex-row w-full max-w-4xl mx-auto justify-center overflow-hidden ">
    <!-- Bên trái -->
    <div class="bg-yellow-100 flex flex-col justify-center items-center p-10 w-full md:w-1/2 order-2 md:order-1">
      <img src="../assets/images/bg.webp" alt="Trivago" class="mb-6 w-full rounded-lg object-cover">
      <div class="mt-4 bg-gray-100 p-5 rounded-lg text-sm w-full">
        <h3 class="font-bold mb-2">Bạn có thể:</h3>
        <ul class="space-y-2">
          <li>✔ Mở khóa giá thành viên và ưu đãi cho khách hàng thân thiết</li>
          <li>✔ Dễ dàng xem lại nơi lưu trú đã lưu từ bất cứ thiết bị nào</li>
          <li>✔ Tiết kiệm lớn nhờ thông báo giá trên app của chúng tôi</li>
        </ul>
      </div>
    </div>

    <!-- Bên phải -->
    <div id="divSignUp" class="flex flex-col items-center p-10 w-full md:w-1/2 order-1 md:order-2">
      <button id="btnChangLogin" class="flex items-center gap-2 cursor-pointer justify-start w-full">
        <i class="fas fa-chevron-down fa-sm"></i> <!-- xuống -->
        <h3 class="text-sm font-bold">Đăng nhập</h3>

      </button>
      <a href="#" class="flex items-center space-x-2">
        <span class="text-2xl font-bold text-indigo-700 mb-4">FastRoom</span>
      </a>
      <h2 class="text-xl font-bold mb-4 text-center">Tiết kiệm nhiều hơn khi là thành viên</h2>
      <p class="text-sm text-gray-600 mb-4">Đăng nhập hoặc tạo tài khoản bằng email của bạn</p>

      <form method="POST" action="../controllers/register.php" onsubmit="return myFormInSignUp()">
        <input type="email" name="email" placeholder="Nhập địa chỉ email"
          class="border rounded-md w-full px-4 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input id="pass1" type="password" name="password" placeholder="Nhập mật khẩu"
          class="border rounded-md w-full px-4 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input id="pass2" type="password" name="password" placeholder="Nhập lại mật khẩu"
          class="border rounded-md w-full px-4 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
          class="bg-blue-600 text-white font-medium py-2 rounded-md w-full hover:bg-blue-700 transition"> Đăng kí
        </button>
      </form>


      <div class="flex items-center my-6 w-full">
        <hr class="flex-1 border-gray-300">
        <span class="px-3 text-sm text-gray-500">hoặc tiếp tục với</span>
        <hr class="flex-1 border-gray-300">
      </div>

      <div class="flex flex-col md:flex-row space-x-3 w-full gap-2">
        <button
          class="flex-1  border rounded-md py-2 flex justify-center items-center hover:bg-gray-50 transition px-3 w-full md:mb-0 mb-2">
          <img src="https://www.svgrepo.com/show/355037/google.svg" class="h-5 mr-2"> Google
        </button>
        <button
          class="flex-1 border rounded-md py-2 flex justify-center items-center hover:bg-gray-50 transition px-3  w-full md:mb-0 mb-2">
          <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" class="h-5 mr-2"> Apple
        </button>
        <button
          class="flex-1 border rounded-md py-2 flex justify-center items-center hover:bg-gray-50 transition px-3  w-full md:mb-0 mb-2">
          <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg"
            class="h-5 mr-2"> Facebook
        </button>
      </div>

      <p class="text-xs text-gray-500 mt-6 text-center">
        Bằng việc tạo tài khoản, bạn đồng ý với
        <a href="#" class="text-blue-600 hover:underline">Chính sách riêng tư</a> và
        <a href="#" class="text-blue-600 hover:underline">Điều khoản sử dụng</a> của chúng tôi.
      </p>
    </div>

    <!-- Login -->
    <!-- Bên phải -->
    <div id="divLogin" class="hidden flex-col items-center p-10 w-full md:w-1/2 order-1 md:order-2">
      <button id="btnChangSginUp" class="flex items-center gap-2 cursor-pointer justify-start w-full">
        <i class="fas fa-chevron-down fa-sm"></i> <!-- xuống -->
        <h3 class="text-sm font-bold">Đăng kí</h3>

      </button>
      <a href="#" class="flex items-center justify-center space-x-2">
        <span class="text-2xl font-bold text-indigo-700 mb-4">FastRoom</span>
      </a>
      <h2 class="text-xl font-bold mb-4 text-center">Tiết kiệm nhiều hơn khi là thành viên</h2>
      <p class="text-sm text-gray-600 mb-4">Đăng nhập hoặc tạo tài khoản bằng email của bạn</p>

      <form method="POST" action="../controllers/login.php" onsubmit="return myFormInLogin()">
        <input id="emailInLogin" type="email" name="email" placeholder="Nhập địa chỉ email"
          class="border rounded-md w-full px-4 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input id="passwordInLogin" type="password" name="password" placeholder="Nhập mật khẩu"
          class="border rounded-md w-full px-4 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
          class="bg-blue-600 text-white font-medium py-2 rounded-md w-full hover:bg-blue-700 transition"> Đăng
          nhập
      </form>

      </button>

      <div class="flex items-center my-6 w-full">
        <hr class="flex-1 border-gray-300">
        <span class="px-3 text-sm text-gray-500">hoặc tiếp tục với</span>
        <hr class="flex-1 border-gray-300">
      </div>

      <div class="flex flex-col md:flex-row space-x-3 w-full gap-2">
        <button
          class="flex-1  border rounded-md py-2 flex justify-center items-center hover:bg-gray-50 transition px-3 w-full md:mb-0 mb-2">
          <img src="https://www.svgrepo.com/show/355037/google.svg" class="h-5 mr-2"> Google
        </button>
        <button
          class="flex-1 border rounded-md py-2 flex justify-center items-center hover:bg-gray-50 transition px-3  w-full md:mb-0 mb-2">
          <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" class="h-5 mr-2"> Apple
        </button>
        <button
          class="flex-1 border rounded-md py-2 flex justify-center items-center hover:bg-gray-50 transition px-3  w-full md:mb-0 mb-2">
          <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg"
            class="h-5 mr-2"> Facebook
        </button>
      </div>

      <p class="text-xs text-gray-500 mt-6 text-center">
        Bằng việc tạo tài khoản, bạn đồng ý với
        <a href="#" class="text-blue-600 hover:underline">Chính sách riêng tư</a> và
        <a href="#" class="text-blue-600 hover:underline">Điều khoản sử dụng</a> của chúng tôi.
      </p>
    </div>
  </div>
</div>


<script>
  //Sử lý đăng nhập
  function myFormInLogin() {
    const pass = document.getElementById('passwordInLogin').value;
    const email = document.getElementById('emailInLogin').value;

    if (pass === "" || email === "") {
      alert('Vui lòng nhập đủ thông tin!');
      return false;
    }
    return true;
  }

  //Sử lý đăng kí
  function myFormInSignUp() {
    const pass1 = document.getElementById('pass1').value;
    const pass2 = document.getElementById('pass2').value;
    const email = document.getElementsByName('email').value;
    if (pass1 != pass2) {
      alert('Vui lòng nhập đúng mật khẩu!');
      return false;
    }
    else if (email === "" || pass1 === "" || pass2 === "") {
      alert('Vui lòng nhập thông tin!');
      return false;
    }

    return true;
  }

  let changeLogin = document.getElementById('btnChangSginUp');
  let changeSignUp = document.getElementById('btnChangLogin');
  let divLogin = document.getElementById('divLogin');
  let divSignUp = document.getElementById('divSignUp');

  // Show Login
  changeSignUp.addEventListener("click", () => {
    divSignUp.classList.add("opacity-0", "-translate-y-10");
    setTimeout(() => {
      divSignUp.classList.add("hidden");
      divLogin.classList.remove("hidden");
      setTimeout(() => {
        divLogin.classList.remove("opacity-0", "-translate-y-10");
        divLogin.classList.add("opacity-100", "translate-y-0");
      }, 50);
    }, 500);
  });

  // Show SignUp
  changeLogin.addEventListener("click", () => {
    divLogin.classList.add("opacity-0", "-translate-y-10");
    setTimeout(() => {
      divLogin.classList.add("hidden");
      divSignUp.classList.remove("hidden");
      setTimeout(() => {
        divSignUp.classList.remove("opacity-0", "-translate-y-10");
        divSignUp.classList.add("opacity-100", "translate-y-0");
      }, 50);
    }, 500);
  });
</script>