<?php

namespace Core\Database;

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
        $params = $this->normalize($params);

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

    // TODO: refactor update method
    public function update($table, $params)
    {
        $params = $this->normalize($params);

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

    /**
     * @param params array to be processed
     * @return array of normalize values
     */
    private function normalize(array $params): array
    {
        return array_map(function ($param) {
            return \htmlspecialchars($param);
        }, $params);
    }

}
