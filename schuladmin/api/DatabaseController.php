<?php

class DatabaseController
{
    private static $instance = null;
    private $pdo;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . config::DBHOST . ";dbname=" . config::DBNAME, config::DBUSER, config::DBPASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            rest::setHttpHeaders(422, true);
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DatabaseController();
        }
        return self::$instance;
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}


