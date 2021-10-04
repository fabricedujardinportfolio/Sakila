<?php

class Inventory extends Database
{

    public static function all()
    {
        $staffs = self::query("SELECT * FROM inventory");
        return $staffs->fetchAll();
    }
    public static function read($id)
    {
        $staff = self::query("SELECT * FROM inventory WHERE inventory_id=$id");
        return $staff->fetch();
    }
    public static function readByStore($store_id)
    {
        $staff = self::query("SELECT * FROM inventory WHERE store_id=$store_id GROUP BY film_id");
        return $staff->fetchAll();
    }
    public static function readForAjaxByFilm1($title)
    {
        $films = self::query("SELECT title FROM sakila.inventory where store_id=1 and title LIKE '%$title%' ");
        return $films->fetch();
    }
}
