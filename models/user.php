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

    // 🔹 Kiểm tra email đã tồn tại chưa
    public function isEmailExists($email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
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
    public function upDate($email, $name, $avatar)
    {
        $statement = $this->conn->prepare("UPDATE users SET NAME = ? , avatar = ? WHERE email = ?");
        $statement->bind_param("sss", $name, $avatar, $email);
        $statement->execute();
    }
}
?>