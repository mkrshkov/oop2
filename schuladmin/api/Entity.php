<?php

abstract class Entity
{
    protected $pdo;

    public function __construct($table_name)
    {
        $db = DatabaseController::getInstance();
        $this->pdo = $db->getPdo();
        $this->table_name = $table_name;
    }

    public function getAll($table_name)
    {
        $db = DatabaseController::getInstance();
        $this->pdo = $db->getPdo();
        $sql = "SELECT * FROM {$table_name}";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($table_name, $data)
    {
        $db = DatabaseController::getInstance();
        $this->pdo = $db->getPdo();
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$table_name} ({$fields}) VALUES ({$placeholders})";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return $this->pdo->lastInsertId();
    }

    public function update($table_name, $id, $id_type, $data)
    {
        $db = DatabaseController::getInstance();
        $this->pdo = $db->getPdo();
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "{$key} = :{$key}, ";
        }
        $set = rtrim($set, ", ");

        $sql = "UPDATE {$table_name} SET {$set} WHERE $id_type = :id";
        $data['id'] = $id;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->rowCount();
    }

    public function delete($table_name, $conditions)
    {
        $db = DatabaseController::getInstance();
        $this->pdo = $db->getPdo();
        $where = "";
        foreach ($conditions as $key => $value) {
            $where .= "{$key} = :{$key} AND ";
        }
        $where = rtrim($where, " AND ");

        $sql = "DELETE FROM {$table_name} WHERE {$where}";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);

        return $stmt->rowCount();
    }

}
