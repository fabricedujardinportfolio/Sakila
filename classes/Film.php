<?php

class Film extends Database
{

    public static function all()
    {

        $films = self::query('SELECT film.film_id,film.title,film.description,film.release_year,language.name,film.rental_duration,film.rental_rate,film.length,film.replacement_cost,film.rating,film.special_features,film.last_update 
        FROM film
        INNER JOIN language
        ON film.language_id = language.language_id
        INNER JOIN film_category
        ON film_category.film_id = film.film_id
        AND
        film_category.film_id = film.film_id
        AND language.language_id = film.language_id');

        return $films->fetchAll();
    }

    public static function read($id)
    {
        $film = self::query("SELECT film.film_id,film.title,film.description,film.release_year,language.name,film.rental_duration,film.rental_rate,film.length,film.replacement_cost,film.rating,film.special_features,film.last_update 
        FROM film
        INNER JOIN language
        ON film.language_id = language.language_id
        INNER JOIN film_category
        ON film_category.film_id = film.film_id
        AND
        film_category.film_id = film.film_id
        AND language.language_id = film.language_id
        WHERE film.film_id = $id");
        return $film->fetch();
    }

    public static function readByCat($id)
    {
        $filmByCategorie = self::query("SELECT * FROM film_category WHERE film_category.category_id = $id");
        return $filmByCategorie->fetchAll();
    }
    public static function readByCatId($id)
    {
        $filmByCategorie = self::query("SELECT * FROM film_category WHERE film_category.film_id = $id");
        return $filmByCategorie->fetchAll();
    }
    
}