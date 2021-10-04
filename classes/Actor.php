<?php

class Actor extends Database
{

    public static function all()
    {
        $filmBylanguages = self::query("SELECT * FROM actor");
        return $filmBylanguages->fetchAll();
    }
    public static function read($id)
    {
        $filmBylanguage = self::query("SELECT * FROM actor WHERE actor_id = $id");
        return $filmBylanguage->fetch();
    }
    public static function readByFilm($id)
    {
        $test = self::query("SELECT * FROM actor, film_actor WHERE actor.actor_id = film_actor.actor_id AND film_id = $id");
        return $test->fetchall();
    }
}
