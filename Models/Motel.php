<?php

class Motel extends BaseModel{
    const TABLE = 'motels';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
    public function createMotel($motel) {
        $conn = DbConnect::connect();

        $sql = "INSERT INTO motels (name, price, description, status, province_id, district_id, ward_id, attributes) 
                VALUES (:name, :price, :description, :status, :province_id, :district_id, :ward_id, :attributes)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $motel['name']);
        $stmt->bindParam(':price', $motel['price']);
        $stmt->bindParam(':description', $motel['description']);
        $stmt->bindParam(':status', $motel['status']);
        $stmt->bindParam(':province_id', $motel['province_id']);
        $stmt->bindParam(':district_id', $motel['district_id']);
        $stmt->bindParam(':ward_id', $motel['ward_id']);
        $stmt->bindParam(':attributes', $motel['attributes']);
        
        $stmt->execute();

        $id = $conn->lastInsertId();
        return $id;
    }

    public function updateMotel($motel) {
        $conn = DbConnect::connect();

        $sql = "UPDATE motels SET name = :name, 
                price = :price, 
                description = :description, 
                status = :status, 
                province_id = :province_id, 
                district_id = :district_id, 
                ward_id = :ward_id,
                attributes = :attributes 
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $motel['name']);
        $stmt->bindParam(':price', $motel['price']);
        $stmt->bindParam(':description', $motel['description']);
        $stmt->bindParam(':status', $motel['status']);
        $stmt->bindParam(':province_id', $motel['province_id']);
        $stmt->bindParam(':district_id', $motel['district_id']);
        $stmt->bindParam(':ward_id', $motel['ward_id']);
        $stmt->bindParam(':attributes', $motel['attributes']);
        $stmt->bindParam(':id', $motel['id']);
        
        $stmt->execute();
    }

    
    
}