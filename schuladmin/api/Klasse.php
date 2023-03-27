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
/*
    public  function getAll() {
        $result = array();
        $rows = parent::getAll(self::$tableName);
        foreach ($rows as $row) {
            $klasse = new Klasse($row['id'], $row['name']);
            array_push($result, $klasse);
        }
        return $result;
    }

    public static function getById($id) {
        $row = parent::getById(self::$tableName, $id);
        if ($row) {
            $klasse = new Klasse($row['id'], $row['name']);
            return $klasse;
        } else {
            return null;
        }
    }

    public function save() {
        $data = array('name' => $this->name);
        if ($this->id) {
            $id_type = "id";
            parent::update(self::$tableName, $this->id, $id_type, $data);
        } else {
            $this->id = parent::insert(self::$tableName, $data);
        }
    }
*/
}
