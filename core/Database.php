<?php

namespace Core;

use PDO;
use PDOException;

// Цей клас займається занадто великою кількістю задач. Менеджмент підключення, query builder. Треба розносити на окремі класи
class Database
{
    private static $instance = null;

    protected $db;

    protected string $table;

    protected string $query = '';

    protected array $parameters = [];
    
    private function __construct()
    {
        try {
            // Створення конекшену в базу варто винести в окремий метод, типу connect. Тому що тобі не завжди потрібно підключення,
            // а в поточному випадку ти з кожним реквестом підключаєшся в базу що не зовсім добре для бази в плані навантаження
            $this->db = new PDO(
                'mysql:host=localhost;dbname=http3;charset=utf8',
                'root', // Ну ти креди то винеси в config файл, щоб потім їх можна було додати через ENV змінні. НЕ СЕКЬЮРНО, АЛО
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    // О, пахне сінглтоном.
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function table(string $table) :self
    {
        $this->table = $table;
        $this->parameters = [];
        $this->query = '';
        return $this;
    }

    public function select(array $columns = ['*']) :self
    {
        $this->query = "SELECT " . implode(', ', $columns) . " FROM {$this->table}";
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC') :self
    {
        $this->query .= " ORDER BY $column $direction";
        return $this;
    }

    public function get() :array
    {
        $stmt = $this->db->prepare($this->query);
        $stmt->execute($this->parameters);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert(array $data) :int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
        $values = array_values($data);
    
        $this->query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($this->query);
        $stmt->execute($values);
    
        return (int) $this->db->lastInsertId();
    }    

    public function first() : ?array
    {
        $this->query .= " LIMIT 1";
        $stmt = $this->db->prepare($this->query);
        $stmt->execute($this->parameters);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }

    public function pluck(string $column) : ?int
    {
        $this->query = "SELECT $column FROM {$this->table} " . (strpos($this->query, 'WHERE') ? substr($this->query, strpos($this->query, 'WHERE')) : '');
        $stmt = $this->db->prepare($this->query);
        $stmt->execute($this->parameters);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->parameters = [];
        $this->query = '';

        return $result ? (int)$result[$column] : null;
    }

    public function where(string $column, string $operator, $value) 
    {
        if (strpos($this->query, 'WHERE') === false)
        {
            $this->query .= " WHERE $column $operator ?";
        } else 
        {
            $this->query .= " AND $column $operator ?";
        }
        $this->parameters[] = $value;
        return $this;
    }

    public function update(array $data): void
    {
        $set = [];
        $setParameters = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = ?";
            $setParameters[] = $value;
        }
        $setClause = implode(', ', $set);
    
        $whereClause = '';
        if (strpos($this->query, 'WHERE') !== false) {
            $whereClause = substr($this->query, strpos($this->query, 'WHERE'));
        }
    
        $this->query = "UPDATE {$this->table} SET $setClause $whereClause";
    
        // echo "SQL Query: " . $this->query . "\n";
        // echo "Parameters: " . json_encode(array_merge($setParameters, $this->parameters)) . "\n";
        // exit();
    
        $stmt = $this->db->prepare($this->query);
        $stmt->execute(array_merge($setParameters, $this->parameters));
    
        $this->parameters = [];
        $this->query = '';
    }     

}