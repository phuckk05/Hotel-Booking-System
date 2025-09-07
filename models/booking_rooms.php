<?php
class BookingRoom
{
    private $conn;
    private $table = "booking_rooms"; // tên bảng trong DB

    // Các thuộc tính
    public $id;
    public $booking_id;
    public $room_id;
    public $name;
    public $quantity;
    public $guests;
    public $price;
    public $email;
    public $phone;
    public $created_at;

    // Hàm khởi tạo kết nối DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy theo booking_id
    public function getByBooking($booking_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE booking_id = :booking_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":booking_id", $booking_id);
        $stmt->execute();
        return $stmt;
    }

    // Thêm mới
    public function create()
    {

        $sql = "INSERT INTO booking_rooms (booking_id, room_id, name, quantity, guests, price, email, phone, created_at) 
        VALUES (?, ?, ?, ?, ?,?,?,?,?)";
        $this->created_at = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssssssss",
            $this->booking_id,
            $this->room_id,
            $this->name,
            $this->quantity,
            $this->guests,
            $this->price,
            $this->email,
            $this->phone,
            $this->created_at
        );

        return $stmt->execute();
    }

    // Cập nhật
    public function update()
    {
        $query = "UPDATE " . $this->table . " 
                  SET name = :name, quantity = :quantity, guests = :guests, 
                      price = :price, email = :email, phone = :phone 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":guests", $this->guests);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Xóa
    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
