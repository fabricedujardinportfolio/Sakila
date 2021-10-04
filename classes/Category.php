<?php

class Category extends Database
{

    public static function all()
    {
        $categories = self::query('SELECT * FROM category');
        return $categories->fetchAll();
    }
    public static function read($id)
    {
        $categorie = self::query("SELECT * FROM category WHERE category_id=$id");
        return $categorie->fetch();
    }
    public static function readByFilmId($id)
    {
        $categorie = self::query("SELECT * FROM film_category WHERE film_category.film_id = $id");
        return $categorie->fetchAll();
    }
    public static function readByFilms($id)
    {
        $categorie = self::query("SELECT * FROM film_category WHERE film_category.category_id = $id");
        return $categorie->fetchAll();
    }
    public static function readByFilm($id)
    {
        $categorie = self::query("SELECT * FROM film_category WHERE film_category.category_id = $id");
        return $categorie->fetch();
    }
}
