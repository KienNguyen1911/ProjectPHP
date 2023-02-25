<?php 
class User extends BaseModel {

    CONST TABLE = 'users';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
    public function login($username, $password) {
        $conn = DbConnect::connect();
        $sql = "SELECT * FROM " . self::TABLE . " WHERE username = '$username' AND password = '$password'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function signup($username, $password, $email, $phonenumber, $role) {
        $conn = DbConnect::connect();
        $sql = "INSERT INTO " . self::TABLE . " (username, password, email, phonenumber, role) VALUES ('$username', '$password', '$email', '$phonenumber', '$role')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $id = $conn->lastInsertId();
        return $id;
    }


}