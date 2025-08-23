<?php
class Payment {
    private $conn;

    public $id;
    public $booking_id;
    public $amount;
    public $method;
    public $status;
    public $paid_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $sql = "INSERT INTO payments (booking_id, amount, method, status, paid_at) 
                VALUES (:booking_id, :amount, :method, :status, :paid_at)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':booking_id' => $this->booking_id,
            ':amount' => $this->amount,
            ':method' => $this->method,
            ':status' => $this->status,
            ':paid_at' => $this->paid_at
        ]);
    }

    public function getByBooking($booking_id) {
        $stmt = $this->conn->prepare("SELECT * FROM payments WHERE booking_id = :booking_id");
        $stmt->execute([':booking_id' => $booking_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
