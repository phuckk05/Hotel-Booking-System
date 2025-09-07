<?php
class Booking
{
    private $conn;

    public $id;
    public $user_id;
    public $check_in;
    public $check_out;
    public $quantity;

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
        $sql = "INSERT INTO bookings (user_id, check_in, check_out, quantity,total_price,created_at, code) 
        VALUES (?, ?, ?, ?,?, ?,?)";
        $this->created_at = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssssss",
            $this->user_id,
            $this->check_in,
            $this->check_out,
            $this->quantity,
            $this->total_price,
            $this->created_at,
            $this->code
        );

        return $stmt->execute();
    }

    public function getIdBooking($user_id)
    {

        $stmt = $this->conn->prepare("SELECT id FROM bookings WHERE user_id = ? LIMIT 1");
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
}
?>