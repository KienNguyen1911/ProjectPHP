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
        
        $id = $conn->lastInsertId();
        
        return $id;
    }

    public function getOrdersByUserId($id) {
        $conn = DbConnect::connect();

        $sql = "SELECT orders.*, bookings.*, motels.*, provinces.name AS province_name, districts.name AS district_name, wards.name AS ward_name FROM motels 
        INNER JOIN bookings ON motels.id = bookings.motel_id 
        INNER JOIN orders ON bookings.id = orders.booking_id 
        INNER JOIN provinces ON motels.province_id = provinces.id
        INNER JOIN districts ON motels.district_id = districts.id
        INNER JOIN wards ON motels.ward_id = wards.id
        WHERE bookings.user_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }

    public function getOrderByMotel($id) {
        $conn = DbConnect::connect();

        $sql = "SELECT orders.*, bookings.*, motels.* FROM motels 
        INNER JOIN bookings ON motels.id = bookings.motel_id 
        INNER JOIN orders ON bookings.id = orders.booking_id
        WHERE motels.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }

    public function getOrderByBooking($id) {
        $conn = DbConnect::connect();

        $sql = "SELECT orders.*, bookings.*, motels.* FROM motels 
        INNER JOIN bookings ON motels.id = bookings.motel_id 
        INNER JOIN orders ON bookings.id = orders.booking_id
        WHERE bookings.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function getAllOrder() {
        $conn = DbConnect::connect();

        $sql = "SELECT orders.*, bookings.user_id, bookings.motel_id, bookings.start, bookings.end, motels.name, users.email, provinces.name AS province_name, districts.name AS district_name, wards.name AS ward_name FROM motels 
        INNER JOIN bookings ON motels.id = bookings.motel_id 
        INNER JOIN orders ON bookings.id = orders.booking_id 
        INNER JOIN provinces ON motels.province_id = provinces.id
        INNER JOIN districts ON motels.district_id = districts.id
        INNER JOIN wards ON motels.ward_id = wards.id
        INNER JOIN users ON bookings.user_id = users.id
        ORDER BY orders.created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }

    public function getStatistics() {
        $conn = DbConnect::connect();

        $sql = "SELECT SUM(total) AS total, MONTH(created_at) AS month FROM orders GROUP BY MONTH(created_at)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }
}