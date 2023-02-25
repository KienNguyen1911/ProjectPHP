<?php

class BaseModel implements IAction{
    protected $table;

    public function show() {
        $conn = DbConnect::connect();
        $sql = "SELECT * FROM $this->table";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function create($data) {
        $conn = DbConnect::connect();
        $key = array_keys($data);

        echo $sql = "INSERT INTO $this->table (".implode(',', $key).") VALUES (:".implode(',:', $key).")";
        $stmt = $conn->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindParam(':'.$key, $value);
        }
        $stmt->execute();

    }

    public function update($id, $data) {
        $conn = DbConnect::connect();
        $key = array_keys($data);

        $sql = "UPDATE $this->table SET ".implode(' = :', $key)." = :".implode(' = :', $key)." WHERE id = :id";
        $stmt = $conn->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindParam(':'.$key, $value);
        }
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function delete($id) {
        $conn = DbConnect::connect();
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function find($id) {
        $conn = DbConnect::connect();
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
}