<?php
class Image extends BaseModel {
    const TABLE = 'images';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
    public function createImage($id) {
        $conn = DbConnect::connect();
        $target_dir = "Views/upload/";
        $array = $_FILES["images"]["name"];

        // validate form upload image png, jpg, jpeg, jfif
        $valid_extensions = array('jpeg', 'jpg', 'png', 'jfif', 'webp');
        foreach ($array as $key => $value) {
            $ext = strtolower(pathinfo($array[$key], PATHINFO_EXTENSION));
            if (!in_array($ext, $valid_extensions)) {
                echo "File không hợp lệ";
                die();
            }
        }        

        // upload image
        $count = 1;
        foreach ($array as $key => $value) {
            $target_file = $target_dir ."-" . $id. "-" . $count. "-" . basename($array[$key]);
            if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_file)) {
                echo $sql = "INSERT INTO images (motel_id, image_name) VALUES ('$id', '$target_file')";
                $conn->exec($sql);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function getOneImage($id) {
        $conn = DbConnect::connect();
        $sql = "SELECT * FROM images WHERE motel_id = $id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getAllImage($id) {
        $conn = DbConnect::connect();
        $sql = "SELECT * FROM images WHERE motel_id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function findImageByMotel($id) {
        $conn = DbConnect::connect();
        $sql = "SELECT images.* FROM $this->table INNER JOIN motels ON motels.id = images.motel_id WHERE motels.id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteImage($idImg, $idMotel) {
        $conn = DbConnect::connect();
        $sql = "DELETE FROM $this->table WHERE motel_id = :idMotel AND id = :idImg";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idMotel', $idMotel);
        $stmt->bindParam(':idImg', $idImg);

        $stmt->execute();
    }

    public function createImgMotel($id) {
        $conn = DbConnect::connect();
        $target_dir = "Views/upload/";
        $array = $_FILES["images"]["name"];

        // validate form upload image png, jpg, jpeg, jfif
        $valid_extensions = array('jpeg', 'jpg', 'png', 'jfif', 'webp');
        foreach ($array as $key => $value) {
            $ext = strtolower(pathinfo($array[$key], PATHINFO_EXTENSION));
            if (!in_array($ext, $valid_extensions)) {
                echo "File không hợp lệ";
                die();
            }
        }        

        // upload image
        $count = 1;
        foreach ($array as $key => $value) {
            $target_file = $target_dir ."-" . $id. "-" . $count. "-" . basename($array[$key]);
            if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_file)) {
                echo $sql = "INSERT INTO images (motel_id, image_name) VALUES ('$id', '$target_file')";
                $conn->exec($sql);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}