<?php

class Favorites
{
    private $conn;

    public $id;
    public $user_id;
    public $hotel_id;

    public $created_at;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create()
    {
        $sql = "INSERT INTO favorites (user_id,hotel_id, created_at) 
        VALUES (?, ?,?)";
        $this->created_at = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sss",
            $this->user_id,
            $this->hotel_id,
            $this->created_at,
        );

        return $stmt->execute();
    }
    public function check($hotel_id)
    {
        $sql = "SELECT id FROM favorites WHERE hotel_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $hotel_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    public function checkShow($user_id, $hotel_id)
    {
        $sql = "SELECT id FROM favorites WHERE user_id = ? AND hotel_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $user_id, $hotel_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    public function delete($user_id, $hotel_id)
    {
        $sql = "DELETE FROM favorites WHERE user_id = ? AND hotel_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $user_id, $hotel_id);
        return $stmt->execute();
    }
    public function deleteById($id)
    {
        $sql = "DELETE FROM favorites WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
    public function getHotel($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM favorites WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}