<?php

namespace App;

use PDO;

class User
{


    public static function add(int $id, string $locale)
    {
        
        $db = DB::getConnection();
        $stmt = $db->prepare('INSERT OR IGNORE INTO user (id,locale) VALUES (?,?)');
        $stmt->execute([$id,$locale]);
        
    }

    public static function getLocale(int $id)
    {
        $db = DB::getConnection();
        $stmt = $db->query("select locale from user where id='$id'");
        return $stmt->fetch()['locale'];
    }
}
