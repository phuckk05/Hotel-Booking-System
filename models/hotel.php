<?php
class Hotel
{
    private $conn;

    public $id;
    public $name;
    public $address;
    public $city;
    public $description;
    public $phone;
    public $email;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Tạo khách sạn
    public function create()
    {
        $sql = "INSERT INTO hotels (name, address, city, description, phone, email) 
                VALUES (:name, :address, :city, :description, :phone, :email)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':address' => $this->address,
            ':city' => $this->city,
            ':description' => $this->description,
            ':phone' => $this->phone,
            ':email' => $this->email
        ]);
    }

    // Lấy tất cả khách sạn
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT id, name, address, city, description, phone, email FROM hotels");
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = $res->fetch_all(MYSQLI_ASSOC);
        $res->free();
        $stmt->close();
        return $rows;
    }

    // Lấy tất cả khách sạn
    public function getByAddress($address)
    {
        $stmt = $this->conn->query("SELECT * FROM hotels WHERE address LIKE : address");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 khách sạn theo id 
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM hotels WHERE id = ?");
        $stmt->bind_param("i", $id); // i = integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function getByIdOder($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM hotels WHERE id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $id); // i = integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //Lấy danh sách theo city
    public function getByCity($city)
    {
        $nameCity = explode(' ', $city);

        if ($nameCity[0] === "Tỉnh") {
            $nameCityOfice = trim(implode(' ', array_slice($nameCity, 1)));
        } elseif ($nameCity[0] === "Thành" && $nameCity[1] === "phố") {
            $nameCityOfice = trim(implode(' ', array_slice($nameCity, 2)));
        } else {
            $nameCityOfice = trim($city);
        }

        $stmt = $this->conn->prepare("SELECT * FROM hotels WHERE city = ?");
        $stmt->bind_param("s", $nameCityOfice); // "s" = string
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);

    }
}
?>