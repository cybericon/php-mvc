<?php

namespace Core\Database;

use Core\App;

class Model
{
    protected static $table;
    public static function get()
    {
        return App::get('database')->selectAll(static::$table);
    }

    public static function find($id)
    {
        return App::get('database')->get(static::$table, $id);
    }

    public static function remove($id)
    {
        return App::get('database')->delete(static::$table, $id);
    }

    public static function add($params)
    {
        return App::get('database')->insert(static::$table, $params);
    }

    public static function edit($params)
    {
        return App::get('database')->update(static::$table, $params);
    }
}
