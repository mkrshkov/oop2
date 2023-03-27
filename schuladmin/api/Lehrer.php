<?php

class Lehrer extends Person
{
    const TABLE_NAME = 'lehrer';
    private $entity;

    public function __construct()
    {
        parent::__construct();
        $this->entity = new Entity(self::TABLE_NAME);
    }

    public static function db_insert_lehrer($lehrer)
    {
        $entity = new Entity(self::TABLE_NAME);
        $data = array(
            'vorname' => $lehrer->vorname,
            'nachname' => $lehrer->nachname,
            'geburtsdatum' => $lehrer->geburtsdatum,
            'gehalt' => $lehrer->gehalt,
            'fach_fid' => $lehrer->fach_fid
        );
        return $entity->insert($data);
    }

    public static function db_get_lehrer()
    {
        $entity = new Entity(self::TABLE_NAME);
        return $entity->getAll();
    }

    public static function db_delete_lehrer($id)
    {
        $id_type = "lid";
        $entity = new Entity(self::TABLE_NAME);
        return $entity->delete($id, $id_type);
    }

    public static function db_select_lehrer_from_id($id)
    {
        $entity = new Entity(self::TABLE_NAME);
        return $entity->getById($id);
    }

    public static function db_update_lehrer($lehrer)
    {
        $entity = new Entity(self::TABLE_NAME);
        $id_type = "lid";
        $data = array(
            'vorname' => $lehrer->vorname,
            'nachname' => $lehrer->nachname,
            'geburtsdatum' => $lehrer->geburtsdatum,
            'gehalt' => $lehrer->gehalt,
            'fach_fid' => $lehrer->fach_fid
        );
        return $entity->update($lehrer->lid, $id_type, $data);
    }

    public function db_insert_lehrer_fach_klasse($lehrerFachKlasse)
    {
        $data = array(
            'fid' => $lehrerFachKlasse->fid,
            'kid' => $lehrerFachKlasse->kid,
            'lid' => $this->id
        );
        $this->entity->insert($data);
    }

    public static function db_delete_lehrer_fach_klasse($lehrerFachKlasse)
    {
        $table = 'lehrer-fach-klasse';
        $entity = new Entity($table);
        $entity->delete(array(
            'fid' => intval($lehrerFachKlasse->fid),
            'kid' => intval($lehrerFachKlasse->kid),
            'lid' => intval($lehrerFachKlasse->lid)
        ));
    }

    public static function db_get_lehrer_fach_klasse($id)
    {
        $db = DatabaseController::getInstance();
        $pdo = $db->getPdo();
        $sql = "SELECT lehrer.lid, lehrer.vorname, lehrer.name, klasse.kid, klasse.klassenbezeichnung, fach.fid, fach.fachbezeichnung
        FROM lehrer 
        JOIN `lehrer-fach-klasse` on (lehrer.lid=`lehrer-fach-klasse`.lid) 
        JOIN klasse on (klasse.kid=`lehrer-fach-klasse`.kid) 
        JOIN fach on (fach.fid= `lehrer-fach-klasse`.fid) WHERE lehrer.lid = " . $id . ";";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
