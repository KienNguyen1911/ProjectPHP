<?php
class DbConnect
{
    public static function connect()
    {
        $host = "localhost";
        $username = "root";
        $dbName = "btl_php1";
        $dsn = "mysql:host=" . $host . ";dbname=" . $dbName;
        $password = "";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
        
    }
}
