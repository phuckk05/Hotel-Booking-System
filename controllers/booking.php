<?php
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
if (isset($_SESSION["user_id"]) && $_POST['check_in_last'] && $_POST['check_out_last'] && $_POST['roomNumber_last'] && $_POST['total_price'] && $_POST['nameHotel_last'] && $_POST['member_last'] && $_POST['hotel_id'] && $_POST['total_rooms']) {
    $user_id = $_SESSION["user_id"];
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
    include "../includes/loading.html";



} else {
    $backUrl = $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') ? '&' : '?') . 'success=fail';
    header("Location: " . $backUrl);
    exit;
}

?>