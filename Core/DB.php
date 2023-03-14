<?php

use Dotenv\Dotenv;

class DB
{

    protected static $instance;

    private function __construct() {
        try {

            $dotenv = Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->load();

            self::$instance = new \PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance(): PDO | null
    {
        if (!self::$instance) {
            new self();
        }

        return self::$instance;
    }
}