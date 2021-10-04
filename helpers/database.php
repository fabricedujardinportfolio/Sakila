<?php
class Database
{

    const servername = "localhost";
    const username = "root";
    const password = "secret";
    const database = "sakila";

    public static $conn;

    protected static function connect()
    {
        try {
            if (!self::$conn) {
                $conn = new PDO("mysql:host=" . self::servername . ";dbname=" . self::database, self::username, self::password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn = $conn;
            }

            return self::$conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected static function query($sql, $params = [])
    {
        try {
            $stmt = self::connect()->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
