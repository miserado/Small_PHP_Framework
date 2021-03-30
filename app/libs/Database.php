<?php

namespace app\libs;

use app\core\Config;
use PDO, PDOException, PDOStatement;

class DataBase
{
    private $db;

    public function __construct()
    {
        try {
            $params = Config::getConfig('database');
            $this->db = new PDO('mysql:host=' . $params['host'] . ';dbname=' . $params['db'] . '', $params['user'], $params['password']);
            $this->db->exec('SET NAMES utf8');
        } catch (PDOException $E) {
            die('Database access error: ' . $E->getMessage());
        }
    }

    public function sendQuery(string $sql, array $values): PDOStatement
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($values))
            foreach ($values as $key => $value)
                $stmt->bindValue(':' . $key, $value);
        $stmt->execute();
        return $stmt;
    }

    public function fetchAll(string $sql, array $values)
    {
        $result = $this->sendQuery($sql,  $values);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
