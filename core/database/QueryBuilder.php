<?php

namespace Core\Database;

class QueryBuilder
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        return $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function get($table, $id)
    {
        $statement = $this->pdo->prepare("select * from {$table} where id={$id}");
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_OBJ);
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

    public function update($table, $params)
    {
        $sql = sprintf(
            'UPDATE %s SET %s=%s WHERE id=%s',
            $table,
            array_keys($params)[0],
            ":" . array_keys($params)[0],
            ":" . array_keys($params)[1]
        );

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
    }

}
