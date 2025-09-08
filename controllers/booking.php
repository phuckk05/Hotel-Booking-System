<?php
//sử dụng composter gưi email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// khai báo PHPmailer
$mail = new PHPMailer(true);
//lấy id user
session_start();
require_once("../database/config.php");
require_once("../models/user.php");
require_once("../models/booking.php");
require_once("../models/booking_rooms.php");

if (isset($_SESSION["user_id"]) == null) {
    $backUrl = $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') ? '&' : '?') . 'success=login';
    header("Location: " . $backUrl);

    exit;
}
if (isset($_SESSION["user_id"]) && $_POST['check_in_last'] && $_POST['check_out_last'] && $_POST['roomNumber_last'] && $_POST['total_price'] && $_POST['nameHotel_last'] && $_POST['member_last'] && $_POST['hotel_id'] && $_POST['total_rooms'] && $_POST['total_price'] && $_POST['nameHotel_last'] && $_POST['member_last'] && $_POST['hotel_id'] && $_POST['address'] && $_POST['city']) {
    $user_id = $_SESSION["user_id"];

    $address = $_POST["address"];
    $city = $_POST["city"];

    $hotel_id = $_POST['hotel_id'];
    $name = $_POST["nameHotel_last"];
    $member = $_POST["member_last"];
    $total_price = $_POST["total_price"];
    $check_in = $_POST['check_in_last'];
    $check_out = $_POST['check_out_last'];
    $quantity1 = $_POST['roomNumber_last'];
    //Random code
    $newCode = new User($conn);
    //
    $booking_rooms = new BookingRoom($conn);
    $code = $newCode->createCode();
    // check code
    while ($newCode->checkCode($code)) {
        $code = $newCode->createCode();
    }
    $booking = new Booking($conn);

    //lấy tổng phòng
    $total_rooms = $_POST['total_rooms'];
    //Lấy data
    $booking->user_id = $user_id;
    $booking->hotel_id = $hotel_id;
    $booking->hotel_name = $name;
    $booking->check_in = $check_in;
    $booking->check_out = $check_out;
    $booking->quantity = $total_rooms;
    $booking->member = $member;
    $booking->total_price = $total_price;
    $booking->code = $code;
    //save
    $booking->create();

    // lưu đata 
    $data = $booking->getBookingByUserId($user_id);
    $_SESSION['code'] = $code;
    $_SESSION['hotel_name'] = $name;
    $_SESSION['check_in'] = $check_in;
    $_SESSION['check_out'] = $check_out;
    $_SESSION['member'] = $member;



    //lấy id booking
    $booking_id = $booking->getIdBooking($user_id);

} else {
    $backUrl = $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') ? '&' : '?') . 'success=fail';
    header("Location: " . $backUrl);
    exit;
}

if (isset($_POST["email"]) && $_POST['telephone'] && $_POST['counter']) {
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $counter = $_POST['counter'];
    for ($i = 1; $i <= $counter; $i++) {
        if (isset($_POST["firstName-$i"]) && isset($_POST["id-$i"]) && isset($_POST["totalPrice-$i"]) && isset($_POST["totalRooms-$i"]) && $_POST["lastName-$i"]) {
            $room_id = $_POST["id-$i"];
            $totalPrice = $_POST["totalPrice-$i"];
            $totalRooms = $_POST["totalRooms-$i"];
            $select = $_POST["selected-$i"];
            $firstName = $_POST["firstName-$i"];
            $lastName = $_POST["lastName-$i"];
            $fullName = $firstName . " " . $lastName;

            // cập nhật dữ liệu cho booking_roooms
            $booking_rooms->booking_id = $booking_id;
            $booking_rooms->room_id = $room_id;
            $booking_rooms->name = $fullName;
            $booking_rooms->phone = $telephone;
            $booking_rooms->email = $email;
            $booking_rooms->quantity = $totalRooms;
            $booking_rooms->guests = $select;
            $booking_rooms->price = $totalPrice;

            $booking_rooms->create();


        }
    }

    //thực hiện gừi email báo cho user thông tin vé phòng
    try {

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '23211tt4425@mail.tdc.edu.vn'; // Gmail của phúc
        $mail->Password = 'jgmp mvxk hvwh vrzj';   // App Password (không phải mật khẩu Gmail thường)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('23211TT4425@mail.tdc.edu.vn', 'FastRoom');
        $mail->addAddress($email, 'Khách hàng');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Thông tin đặt phòng';
        $mail->Body = '
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: Arial, sans-serif; background:#f9f9f9; color:#333; }
    .container { max-width:600px; margin:0 auto; background:#fff; border-radius:8px; padding:20px; box-shadow:0 2px 6px rgba(0,0,0,0.1);}
    .header { background:#2563eb; color:#fff; padding:15px; border-radius:8px 8px 0 0; text-align:center; font-size:20px; font-weight:bold; }
    .content { padding:20px; }
    .content h2 { color:#2563eb; }
    .footer { margin-top:20px; font-size:12px; text-align:center; color:#777; }
    .info { margin:15px 0; }
    .info p { margin:8px 0; }
    .highlight { font-weight:bold; color:#2563eb; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">FastRoom - Xác nhận đặt phòng</div>
    <div class="content">
      <h2>Xin chào quý khách,</h2>
      <p>Cảm ơn bạn đã đặt phòng qua <span class="highlight">FastRoom</span>. Dưới đây là thông tin đặt phòng của bạn:</p>
      
      <div class="info">
        <p><strong>Mã đặt phòng:</strong> ' . $_SESSION['code'] . '</p>
        <p><strong>Khách sạn:</strong> ' . $_SESSION['hotel_name'] . '</p>
        <p><strong>Địa chỉ:</strong> ' . $address . "," . $city . '</p>
        <p><strong>Ngày nhận phòng:</strong> ' . $_SESSION['check_in'] . '</p>
        <p><strong>Ngày trả phòng:</strong> ' . $_SESSION['check_out'] . '</p>
        <p><strong>Số lượng khách:</strong> ' . $_SESSION['member'] . '</p>
        <p><strong>Số lượng phòng:</strong> ' . $total_rooms . '</p>
      </div>

      <p>Nếu có bất kỳ thắc mắc nào, vui lòng gửi phản hồi trên website <span class="highlight">FastRoom</span>.</p>
      <p>Chúng tôi chúc bạn có một kỳ nghỉ tuyệt vời! 🌴</p>
    </div>
    <div class="footer">
      © ' . date("Y") . ' FastRoom. Mọi quyền được bảo lưu.
    </div>
  </div>
</body>
</html>';


        $mail->send();
    } catch (Exception $e) {
        echo "" . $e->getMessage() . "";
    }

    include "../includes/loading.html";





} else {
    $backUrl = $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') ? '&' : '?') . 'success=fail';
    header("Location: " . $backUrl);
    exit;
}

?>