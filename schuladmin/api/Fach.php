<?php

class Fach extends Entity
{

    private $fid;
    private $fachbezeichnung;

    public function __construct($fid, $fachbezeichnung)
    {
        $this->fid = $fid;
        $this->fachbezeichnung = $fachbezeichnung;
    }

    public function getFid()
    {
        return $this->fid;
    }

    public function setFid($fid)
    {
        $this->fid = $fid;
    }

    public function getFachbezeichnung()
    {
        return $this->fachbezeichnung;
    }

    public function setFachbezeichnung($fachbezeichnung)
    {
        $this->fachbezeichnung = $fachbezeichnung;
    }

    public function getAll($table_name)
    {
        $result = array();
        $rows = parent::getAll($table_name);
        foreach ($rows as $row) {
            $fach = new Fach($row['fid'], $row['fachbezeichnung']);
            array_push($result, $fach);
        }
        return $result;
    }

    public function getById($id)
    {
        $row = parent::getById(self::$tableName, $id);
        if ($row) {
            $fach = new Fach($row['fid'], $row['fachbezeichnung']);
            return $fach;
        } else {
            return null;
        }
    }

    public function insert($table_name, $data)
    {
        $this->fachbezeichnung = $data->fachbezeichnung;
        $data = array('fachbezeichnung' => $this->fachbezeichnung);
        $this->fid = parent::insert($table_name, $data);
    }

    public function update($table_name, $id, $id_type, $data)
    {
        $this->fachbezeichnung = $data->fachbezeichnung;
        $data = array('fachbezeichnung' => $this->fachbezeichnung);
        $id_type = "fid";
        parent::update($table_name, $id, $id_type, $data);
    }

    public function delete($table_name, $id)
    {
        $conditions = array('fid' => $id);
        parent::delete($table_name, $conditions);
    }
}
