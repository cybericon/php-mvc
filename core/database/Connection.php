<?php

namespace Core\Database;

use Core\App;

class Connection
{
    private static $instance;

    private static function make()
    {
        $db = App::get('config')['database'];
        try {
            return new \PDO(
                $db['type'] . ":host=" . $db['host'] . ";dbname=" . $db['name'],
                $db['user'],
                $db['password'],
                $db['options']
            );
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = self::make();
        }
        return self::$instance;
    }
}
