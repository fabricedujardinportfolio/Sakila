<?php

class Language extends Database
{

    public static function all($id)
    {
        $filmBylanguages = self::query("SELECT * FROM language");
        return $filmBylanguages->fetchAll();
    }
    public static function read($id)
    {
        $filmBylanguage = self::query("SELECT * FROM language WHERE language.language_id = $id");
        return $filmBylanguage->fetch();
    }
}
