<?php

class Booking extends BaseModel
{
    const TABLE = 'bookings';

    public function __construct()
    {
        $this->table = self::TABLE;
    }

    public function create($data)
    {
        $conn = DbConnect::connect();

        echo $sql = "INSERT INTO $this->table (user_id, motel_id, start, end) VALUES (:user_id, :motel_id, :start, :end)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':motel_id', $data['motel_id']);
        $stmt->bindParam(':start', $data['start']);
        $stmt->bindParam(':end', $data['end']);
        $stmt->execute();

        return $conn->lastInsertId();
    }

    public function getByUserIdAndMotelId($user_id, $motel_id)
    {
        $conn = DbConnect::connect();

        $sql = "SELECT * FROM bookings WHERE user_id = :user_id AND motel_id = :motel_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':motel_id', $motel_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function updateBooking($id, $data)
    {
        $conn = DbConnect::connect();

        $sql = "UPDATE $this->table SET start = :start, end = :end WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':start', $data['start']);
        $stmt->bindParam(':end', $data['end']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getBookingsByUserId($user_id)
    {
        $conn = DbConnect::connect();

        $sql = "SELECT bookings.*, motels.*, provinces.name AS province_name, districts.name AS district_name, wards.name AS ward_name FROM $this->table
                INNER JOIN motels ON motels.id = bookings.motel_id
                INNER JOIN users ON users.id = bookings.user_id
                INNER JOIN provinces ON provinces.id = motels.province_id
                INNER JOIN districts ON districts.id = motels.district_id
                INNER JOIN wards ON wards.id = motels.ward_id
                WHERE bookings.user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBookingsByMotelId($motel_id)
    {
        $conn = DbConnect::connect();

        $sql = "SELECT bookings.*, motels.*, provinces.name AS province_name, districts.name AS district_name, wards.name AS ward_name FROM $this->table
                INNER JOIN motels ON motels.id = bookings.motel_id
                INNER JOIN users ON users.id = bookings.user_id
                INNER JOIN provinces ON provinces.id = motels.province_id
                INNER JOIN districts ON districts.id = motels.district_id
                INNER JOIN wards ON wards.id = motels.ward_id
                WHERE bookings.id = :motel_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':motel_id', $motel_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
