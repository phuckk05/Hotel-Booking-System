<?php
class Booking
{
    private $conn;

    public $id;
    public $user_id;
    public $hotel_id;
    public $hotel_name;
    public $check_in;
    public $check_out;
    public $quantity;
    public $member;
    public $total_price;
    public $status;
    public $code;

    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $sql = "INSERT INTO bookings (user_id,hotel_id,hotel, check_in, check_out, quantity,member,total_price,created_at, code) 
        VALUES (?, ?,?,?,?,?, ?, ?,?, ?)";
        $this->created_at = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssss",
            $this->user_id,
            $this->hotel_id,
            $this->hotel_name,
            $this->check_in,
            $this->check_out,
            $this->quantity,
            $this->member,
            $this->total_price,
            $this->created_at,
            $this->code
        );

        return $stmt->execute();
    }

    public function getIdBooking($user_id)
    {
        $stmt = $this->conn->prepare("SELECT id FROM bookings WHERE user_id = ? ORDER BY id DESC LIMIT 1");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row["id"];
        }
        return false;
    }
    public function getBookingByUser($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBookingById($booking_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE id = ? LIMIT 1");
        $stmt->bind_param("s", $booking_id); // id là int
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $this->id = $row["id"];
            $this->user_id = $row["user_id"];
            $this->hotel = $row["hotel_id"];
            $this->hotel = $row["hotel"];
            $this->check_in = $row["check_in"];
            $this->check_out = $row["check_out"];
            $this->total_price = $row["total_price"];
            $this->quantity = $row["quantity"];
            $this->member = $row["member"];
            $this->status = $row["status"];
            $this->created_at = $row["created_at"];
            $this->code = $row["code"];
            return true;
        }
        return false;
    }
    public function getBookingByUserId($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE user_id = ? ORDER BY id DESC LIMIT 1");
        $stmt->bind_param("s", $user_id); // id là int
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $this->id = $row["id"];
            $this->user_id = $row["user_id"];
            $this->hotel_id = $row["hotel_id"];
            $this->hotel = $row["hotel"];
            $this->check_in = $row["check_in"];
            $this->check_out = $row["check_out"];
            $this->total_price = $row["total_price"];
            $this->quantity = $row["quantity"];
            $this->member = $row["member"];
            $this->status = $row["status"];
            $this->created_at = $row["created_at"];
            $this->code = $row["code"];
            return true;
        }
        return false;
    }

    public function getBookingByUserIdASSOC($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE user_id = ?  ORDER BY created_at DESC");
        $stmt->bind_param("i", $user_id); // i = integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>