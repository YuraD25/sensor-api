<?php

namespace Sensor\Db;

class Db
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=db;dbname=db', 'db', 'db');
    }

    public function query(string $sql, array $params = [], $class = \stdClass::class): array
    {
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll(\PDO::FETCH_CLASS, $class);
    }
}