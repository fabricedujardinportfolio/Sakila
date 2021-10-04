<?php

class Store extends Database
{

    public static function all()
    {
        $staffs = self::query("SELECT * FROM store");
        return $staffs->fetchAll();
    }
    public static function read($id)
    {
        $staff = self::query("SELECT * FROM store WHERE store_id=$id");
        return $staff->fetch();
    }
    public static function readByStaffId($id)
    {
        $staff = self::query("SELECT * FROM store WHERE manager_staff_id=$id");
        return $staff->fetch();
    }
}
