<?php


namespace App\DB;

use PDO;

class DB
{
    private static $instance = null;

    private $server = 'db';

    private $database = 'shop_db';

    private $user = 'root';

    private $password = 'secret';

    private $connection;

    private function __construct()
    {
        $this->connection = new PDO("mysql:host=$this->server;port=3306;dbname=$this->database", $this->user, $this->password);
    }

    public static function getInstance()
    {
        if(self::$instance) {
            return self::$instance;
        }

        return self::$instance = new self();
    }

    public function getConnection()
    {
        return $this->connection;
    }

//    public function unsecuredQuery(string $statement)
//    {
//        $stmt = $this->connection->query($statement);
//
//        return $stmt->fetchAll(PDO::FETCH_OBJ);
//    }

    public function query(string $preparedStatement, array $args = [])
    {
//        if (substr_count($preparedStatement, '?') !== count($args)) {
//            throw new \LogicException('Invalid number of arguments');
//        }

        $stmt = $this->connection->prepare($preparedStatement);
        $stmt->execute($args);

        return $stmt;
    }

    public function getLastInsertedId()
    {
        return $this->connection->lastInsertId();
    }
}
