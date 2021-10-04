<?php

class Address extends Database
{

    public static function all()
    {
        $staffs = self::query("SELECT * FROM address");
        return $staffs->fetchAll();
    }
    public static function read($id)
    {
        $staff = self::query("SELECT * FROM address WHERE address_id=$id");
        return $staff->fetch();
    }
}
