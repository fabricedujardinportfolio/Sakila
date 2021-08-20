<?php

class Film extends Database
{

    public static function all()
    {

        $films = self::query('SELECT * FROM film');

        return $films->fetchAll();
    }

    public static function read($id)
    {
        $film = self::query("SELECT * FROM film WHERE film_id=$id");
        return $film->fetch();
    }

    public static function readByCat($id)
    {
        $filmByCategorie = self::query("SELECT * FROM film_category WHERE film_category.category_id = $id");
        return $filmByCategorie->fetchAll();
    }
}