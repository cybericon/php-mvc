<?php

namespace Core\Database;

use Core\App;

class Model
{
    protected static $table;
    protected static function get()
    {
        return App::get('database')
            ->selectAll(
                static::$table,
                'App\\Models\\' . ucfirst((rtrim(static::$table, 's')))
            );
    }

    public static function find($id)
    {
        return App::get('database')->get(
            static::$table,
            $id,
            '\\App\\Models\\' . ucfirst((rtrim(static::$table, 's')))
        );
    }

    public static function remove($id)
    {
        return App::get('database')->delete(static::$table, $id);
    }

    public function add($params)
    {
        return App::get('database')->insert(static::$table, $params);
    }

    public static function edit($params)
    {
        return App::get('database')->update(static::$table, $params);
    }

    public function addProperty($property, $value)
    {
        if (\property_exists(
            'App\\Models\\' . ucfirst((rtrim(static::$table, 's'))),
            $property)
        ) {
            $this->$property = $value;
        } else {
            throw new \Exception("Property $property does not exist in" . __CLASS__);
        }
        return $this;
    }

    public function addProperties(array $properties)
    {
        foreach ($properties as $property => $value) {
            $this->addProperty($property, $value);
        }
        return $this;
    }
}
