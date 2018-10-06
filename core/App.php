<?php

namespace Core;

class App
{

    protected static $registry = [];

    public static function bind($key, $value)
    {
        self::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if (array_key_exists($key, self::$registry)) {
            return self::$registry[$key];
        } else {
            throw new \Exception("key {$key} does not exits in registry");
        }
    }
}
