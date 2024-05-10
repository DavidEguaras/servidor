<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $token;
    public $token_expiry;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validateUser() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);

        $stmt->execute();

        return $stmt;
    }

    public function createUser() {
        $query = "INSERT INTO " . $this->table_name . " SET username=:username, password=:password";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getUserByToken() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE token = ? AND token_expiry > NOW()";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->token);

        $stmt->execute();

        return $stmt;
    }
}
?>
