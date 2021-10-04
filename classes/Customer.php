<?php

class Customer extends Database
{

    public static function all()
    {
        $staffs = self::query("SELECT * FROM customer");
        return $staffs->fetchAll();
    }
    public static function read($id)
    {
        $staff = self::query("SELECT * FROM customer WHERE customer_id=$id");
        return $staff->fetch();
    }
    public static function readByEmail($email)
    {
        $staffEmail = self::query("SELECT * FROM customer WHERE customer.email='$email'");
        return $staffEmail->fetch();
    }
    public static function readByLike($like)
    {
        $customerLike = self::query("SELECT * FROM customer WHERE last_name like '%$like%'");
        return $customerLike->fetchAll();
    }
}
