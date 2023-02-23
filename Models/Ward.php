<?php
class Ward extends BaseModel{
    const TABLE = 'wards';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
    public function getWard ($district_id) {
        $conn = DbConnect::connect();
        $sql = "SELECT * FROM $this->table WHERE district_code = '$district_id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}