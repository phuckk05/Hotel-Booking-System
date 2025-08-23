<?php
class Room
{
    private $conn;

    public $id;
    public $hotel_id;
    public $room_type;
    public $price;
    public $capacity;
    public $total_rooms;
    public $available_rooms;
    public $description;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $sql = "INSERT INTO rooms (hotel_id, room_type, price, capacity, total_rooms, available_rooms, description) 
                VALUES (:hotel_id, :room_type, :price, :capacity, :total_rooms, :available_rooms, :description)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':hotel_id' => $this->hotel_id,
            ':room_type' => $this->room_type,
            ':price' => $this->price,
            ':capacity' => $this->capacity,
            ':total_rooms' => $this->total_rooms,
            ':available_rooms' => $this->available_rooms,
            ':description' => $this->description
        ]);
    }
    public function getByHotel($hotel_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM rooms WHERE hotel_id = ?");
        $stmt->bind_param("i", $hotel_id); // i = integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>