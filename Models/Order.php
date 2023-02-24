<?php

class Order extends BaseModel {
    const table = 'orders';

    public function __construct() {
        $this->table = self::table;
    }

    public function createOrder($data) {
        $conn = DbConnect::connect();

        $sql = "INSERT INTO $this->table (booking_id, total, created_at) VALUES (:booking_id, :total, :created_at)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':booking_id', $data['booking_id']);
        $stmt->bindParam(':total', $data['total']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->execute();
        
    }
}