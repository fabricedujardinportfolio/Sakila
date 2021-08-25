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
        $staffEmail = self::query("SELECT email FROM staff WHERE email=$email");
        var_dump($staffEmail);
        return $staffEmail->fetch();
    }
    
}