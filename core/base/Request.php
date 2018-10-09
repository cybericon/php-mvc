<?php

namespace Core\Base;

class Request
{
    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function get($key)
    {
        return \htmlspecialchars($_REQUEST[$key]);
    }

    public static function all()
    {
        array_walk($_REQUEST, function (&$val, $key) {
            $val = \htmlspecialchars($val);
        });
        return $_REQUEST;
    }
}
