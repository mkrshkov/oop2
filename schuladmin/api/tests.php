<?php

require_once('Entity.php');

class Klasse extends Entity {
    protected static $tableName = 'klasse';

    private $id;
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public static function getAll() {
        $db = self::getDbHandler();
        $stmt = $db->prepare("SELECT * FROM klasse");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = array();
        foreach ($rows as $row) {
            $klasse = new Klasse($row['id'], $row['name']);
            array_push($result, $klasse);
        }
        return $result;
    }

    public static function getById($id) {
        $db = self::getDbHandler();
        $stmt = $db->prepare("SELECT * FROM klasse WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $klasse = new Klasse($row['id'], $row['name']);
            return $klasse;
        } else {
            return null;
        }
    }

    public function save() {
        $db = self::getDbHandler();
        if ($this->id) {
            $stmt = $db->prepare("UPDATE klasse SET name = :name WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->execute();
        } else {
            $stmt = $db->prepare("INSERT INTO klasse (name) VALUES (:name)");
            $stmt->bindParam(':name', $this->name);
            $stmt->execute();
            $this->id = $db->lastInsertId();
        }
    }

    public function delete() {
        $db = self::getDbHandler();
        $stmt = $db->prepare("DELETE FROM klasse WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $this->id = null;
    }
}
