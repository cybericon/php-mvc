<?php

namespace Core\Database;

use Core\Base\Request;

class QueryBuilder
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        return $this->pdo = $pdo;
    }

    public function selectAll($table, $class = '')
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        if (empty($class)) {
            return $statement->fetchAll(\PDO::FETCH_CLASS);
        }
        return $statement->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function get($table, $id, $class = '')
    {
        $statement = $this->pdo->prepare("select * from {$table} where id={$id}");
        $statement->execute();
        if (!empty($class)) {
            $statement->setFetchMode(\PDO::FETCH_CLASS, $class);
        }
        return $statement->fetch();

    }

    public function insert($table, $params)
    {

        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($params)),
            ":" . implode(', :', array_keys($params))
        );

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        // insert into table (keys) values (values)
    }

    public function delete($table, $row_id)
    {
        $sql = "DELETE FROM {$table} WHERE id = {$row_id}";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();

    }

    public function update($table, array $fillable)
    {
        // initialize an array with values:
        $params = [];

        // initialize a string with `fieldname` = :placeholder pairs
        $setStr = "";

        // loop over source data array
        foreach ($fillable as $key) {
            if (!empty([$key]) || $key != "" || $key != null) {

                if (Request::get($key) != null) {

                    $setStr .= "`$key` = :$key ,";
                    $params[$key] = Request::get($key);

                } else {

                    $setStr .= "`$key` = $key ,";

                }

            } else {

            }
        }
        $setStr = rtrim($setStr, ",");

        $params['id'] = Request::get('id');

        $sql = "UPDATE $table SET $setStr WHERE id = :id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
    }

    /**
     * @param params array to be processed
     * @return array of normalize values
     */
    private function normalize()
    {
        //
    }
}
