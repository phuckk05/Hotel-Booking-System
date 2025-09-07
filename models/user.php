<?php
class User
{
    // config đến database
    private $conn;

    // 🔹 Properties (thuộc tính của User)
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $role;
    public $created_at;
    public $avatar;

    //Method

    public function __construct($db)
    {
        $this->conn = $db;
    }
    //Random code
    public function createCode()
    {
        $length = 8;
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }
    //check code 
    public function checkCode($code)
    {
        $stmt = $this->conn->prepare("SELECT id FROM bookings WHERE code = ? LIMIT 1");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    // 🔹 Kiểm tra email đã tồn tại chưa
    public function isEmailExists($email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
    //lấy id user
    public function getIdUser($email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row["id"];
        }
        return false;
    }

    // 🔹 Tạo user mới
    public function create()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->created_at = date("Y-m-d H:i:s");
        $this->role = $this->role ?? "user"; // nếu chưa gán thì mặc định là user
        $this->name = !empty($this->name) ? $this->name : "Mark key";
        $this->avatar = !empty($this->avatar) ? $this->avatar : "avatar-1.png";

        $stmt = $this->conn->prepare("
            INSERT INTO users (NAME, email, PASSWORD, phone, role, created_at,avatar) 
            VALUES (?, ?, ?, ?, ?, ?,?)
        ");
        $stmt->bind_param(
            "sssssss",
            $this->name,
            $this->email,
            $this->password,
            $this->phone,
            $this->role,
            $this->created_at,
            $this->avatar
        );
        return $stmt->execute();
    }

    // 🔹 Load user theo email
    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $this->id = $row["id"];
            $this->name = $row["NAME"];
            $this->email = $row["email"];
            $this->password = $row["PASSWORD"];
            $this->phone = $row["phone"];
            $this->role = $row["role"];
            $this->created_at = $row["created_at"];
            $this->avatar = $row["avatar"];
            return true;
        }
        return false;

    }
    public function getByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $this->id = $row["id"];
            $this->name = $row["NAME"];
            $this->email = $row["email"];
            $this->password = $row["PASSWORD"];
            $this->phone = $row["phone"];
            $this->role = $row["role"];
            $this->created_at = $row["created_at"];
            $this->avatar = $row["avatar"];
            return true;
        }
        return false;

    }
    //Đăng nhập
    public function login($email, $password)
    {
        if ($this->getByEmail($email)) {
            if (password_verify($password, $this->password)) { {
                    return true;
                }
            }
        }
        return false;
    }
    //Update thông tin user
    public function upDate($id, $name, $avatar)
    {
        $statement = $this->conn->prepare("UPDATE users SET NAME = ? , avatar = ? WHERE id = ?");
        $statement->bind_param("sss", $name, $avatar, $id);
        $statement->execute();
    }
}
?>