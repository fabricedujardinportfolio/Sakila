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
        $staff = self::query("SELECT * FROM inventory WHERE store_id=$store_id");
        return $staff->fetchAll();
    }
    // public static function readByEmail($email)
    // {
    //     $staffEmail = self::query("SELECT * FROM inventory WHERE staff.email='$email'");
    //     return $staffEmail->fetch();
    // }
    
}