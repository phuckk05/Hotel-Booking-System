<?php
class Booking {
    private $conn;
    

    public $id;
    public $user_id;
    public $room_id;
    public $check_in;
    public $check_out;
    public $quantity;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $sql = "INSERT INTO bookings (user_id, room_id, check_in, check_out, quantity, status) 
                VALUES (:user_id, :room_id, :check_in, :check_out, :quantity, :status)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user_id' => $this->user_id,
            ':room_id' => $this->room_id,
            ':check_in' => $this->check_in,
            ':check_out' => $this->check_out,
            ':quantity' => $this->quantity,
            ':status' => $this->status
        ]);
    }

    public function getByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
