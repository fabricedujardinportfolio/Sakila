<?php

class Search extends Database
{

    public static function all()
    {
        $categories = self::query('SELECT * FROM film');
        return $categories->fetchAll();
    }
}
