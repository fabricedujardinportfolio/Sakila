<?php

class Rental extends Database
{

    public static function all()
    {
        $rentals = self::query('SELECT * FROM rental');
        return $rentals->fetchAll();
    }
    public static function read($id)
    {
        $rental = self::query("SELECT * FROM rental WHERE rental_id=$id");
        return $rental->fetch();
    }
    public static function allWidthLimit($id, $second)
    {
        $rentals = self::query("SELECT * FROM `rental` ORDER BY rental_date DESC LIMIT $id, $second");
        return $rentals->fetchAll();
    }
    public static function readByCustomer($id)
    {
        $rentals = self::query("SELECT * FROM `rental`  WHERE customer_id=$id");
        return $rentals->fetchAll();
    }
    public static function readByInventoryAndCustomer($id, $inventory)
    {
        $rentals = self::query("SELECT * FROM `rental`  WHERE customer_id=$id AND inventory_id=$inventory");
        return $rentals->fetchAll();
    }
    public static function add(string $newDaterental, $inventory_id, $customer_id, string $newDaterentalreturnDate, $staff_id)
    {
        return self::query("INSERT INTO sakila.rental (rental_date,inventory_id,customer_id,return_date,staff_id) VALUES ('$newDaterental','$inventory_id','$customer_id','$newDaterentalreturnDate','$staff_id')");
    }
}
