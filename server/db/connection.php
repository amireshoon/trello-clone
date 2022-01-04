<?php
/**
 * Database connection class
 * 
 * @package trello-clone
 */

class Connection {
    /**
     * @var PDO
     */
    private static $pdo;

    public function __construct() {
        self::$pdo = new PDO('mysql:host=localhost;dbname=web14', 'root', '');
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Get PDO instance
     * 
     * @return PDO
     */
    public static function getPdo() {

        if (self::$pdo === null) {

            $connection = new Connection();
            return $connection->getPdo();

        }

        return self::$pdo;
    }

    /**
     * Run a query
     * 
     * @param string $query
     * @param array $params
     * @return PDOStatement
     * @throws PDOException
     * @since 1.0
     */
    public static function query($query, $params = []) {

        $pdo = self::getPdo();

        $statement = $pdo->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    /**
     * Get a single row
     * 
     * @param string $query
     * @param array $params
     * @return array
     * @throws PDOException
     * @since 1.0
     */
    public static function row($query, $params = []) {

        $statement = self::query($query, $params);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get multiple rows
     * 
     * @param string $query
     * @param array $params
     * @return array
     * @throws PDOException
     * @since 1.0
     */
    public static function rows($query, $params = []) {

        $statement = self::query($query, $params);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a single column
     * 
     * @param string $query
     * @param array $params
     * @return array
     * @throws PDOException
     * @since 1.0
     */
    public static function column($query, $params = []) {

        $statement = self::query($query, $params);

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Get a single value
     * 
     * @param string $query
     * @param array $params
     * @return mixed
     * @throws PDOException
     * @since 1.0
     */
    public static function value($query, $params = []) {

        $statement = self::query($query, $params);

        return $statement->fetchColumn();
    }

    /**
     * Get the last inserted id
     * 
     * @return int
     * @throws PDOException
     * @since 1.0
     */
    public static function lastInsertId() {

        return self::getPdo()->lastInsertId();

    }
}
