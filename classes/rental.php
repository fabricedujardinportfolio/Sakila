<?php

class Rental extends Database{

    public static function all() {
        $rentals = self::query('SELECT * FROM rental');
        return $rentals->fetchAll();
    }
    public static function read($id) {
        $rental = self::query("SELECT * FROM rental WHERE rental_id=$id");
        return $rental->fetch();
    }
    public static function allWidthLimit($id,$second)
    {
        $rentals = self::query("SELECT * FROM `rental`  LIMIT $id, $second");
        return $rentals->fetchAll();
    }
}