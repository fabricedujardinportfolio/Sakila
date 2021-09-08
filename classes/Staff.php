<?php

class Staff extends Database
{

    public static function all()
    {
        $staffs = self::query("SELECT * FROM staff");
        return $staffs->fetchAll();
    }
    public static function read($id)
    {
        $staff = self::query("SELECT * FROM staff WHERE staff_id=$id");
        return $staff->fetch();
    }
    public static function readByEmail($email)
    {
        $staffEmail = self::query("SELECT * FROM staff WHERE staff.email='$email'");
        return $staffEmail->fetch();
    }
    
    
}