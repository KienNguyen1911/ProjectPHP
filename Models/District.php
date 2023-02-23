<?php

class District extends BaseModel{
    const TABLE = 'districts';

    public function __construct() {
        $this->table = self::TABLE;
    }

    public function getDistricts($province_id) {
        $conn = DbConnect::connect();
        $sql = "SELECT * FROM $this->table WHERE province_code = '$province_id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    
}