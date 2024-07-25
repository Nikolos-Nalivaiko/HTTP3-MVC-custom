<?php

declare(strict_types=1);

namespace Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private static $instance = null;

    protected $db;

    protected string $table;

    protected string $query = '';

    protected array $parameters = [];

    private function __construct()
    {
        $this->loadEnv();
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../config');
        $dotenv->load();
    }

    protected function connect()
    {
        if ($this->db === null) {
            try {
                $this->db = new PDO(
                    'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'],
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASSWORD'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
    }

    public function getPDO(): PDO
    {
        return $this->db;
    }

}