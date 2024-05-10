<?php
class Car {
    private $conn;
    private $table_name = "cars";

    public $id;
    public $model;
    public $brand;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCars($filters = []) {
        $query = "SELECT * FROM " . $this->table_name;
        
        if (!empty($filters)) {
            $conditions = [];
            if (!empty($filters['model'])) $conditions[] = "model LIKE :model";
            if (!empty($filters['brand'])) $conditions[] = "brand LIKE :brand";
            if (!empty($filters['description'])) $conditions[] = "description LIKE :description";

            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->conn->prepare($query);

        if (!empty($filters['model'])) $stmt->bindParam(":model", $filters['model']);
        if (!empty($filters['brand'])) $stmt->bindParam(":brand", $filters['brand']);
        if (!empty($filters['description'])) $stmt->bindParam(":description", $filters['description']);

        $stmt->execute();

        return $stmt;
    }
}
?>
