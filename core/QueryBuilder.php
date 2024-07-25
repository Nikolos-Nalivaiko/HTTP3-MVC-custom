<?php

declare(strict_types=1);

namespace core;

use PDO;
use PDOStatement;

class QueryBuilder
{

    protected PDO $db;
    protected string $table;
    protected string $query = '';
    protected array $parameters = [];

    public function __construct(PDO $db)
    {
        $this->db = $db;
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
    
        $stmt = $this->db->prepare($this->query);
        $stmt->execute(array_merge($setParameters, $this->parameters));
    
        $this->parameters = [];
        $this->query = '';
    }     

}