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
    // public static function read($id)
    // {
    //     $filmBylanguage = self::query("SELECT * FROM actor WHERE actor_id = $id");
    //     return $filmBylanguage->fetch();
    // }
    // public static function readByFilm($id) {
    //     $test = self::query("SELECT * FROM actor, film_actor WHERE actor.actor_id = film_actor.actor_id AND film_id = $id");
    //     // var_dump($test);
    //     return $test->fetchall();
    // }
    
}