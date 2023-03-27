<?php

function db_insert_fach($fach)
{
    $db = DatabaseController::getInstance();
    $pdo = $db->getPdo();
    $stmt = $pdo->prepare('INSERT INTO fach (fachbezeichnung) VALUES (:fachbezeichnung)');
    $stmt->execute(array('fachbezeichnung' => $fach->fachbezeichnung));
}

function db_get_fach()
{
    $db = DatabaseController::getInstance();
    $pdo = $db->getPdo();
    $stmt = $pdo->prepare('SELECT * FROM fach');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function db_delete_fach($id)
{
    $db = DatabaseController::getInstance();
    $pdo = $db->getPdo();
    $stmt = $pdo->prepare('DELETE FROM fach WHERE fid=:fid');
    $stmt->execute(array('fid' => $id->fid));
}

function db_select_fach_from_id($id)
{
    $db = DatabaseController::getInstance();
    $pdo = $db->getPdo();
    $stmt = $pdo->prepare('SELECT * FROM fach WHERE fid=:fid');
    $stmt->execute(array('fid' => $id->fid));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function db_update_fach($fach)
{
    $db = DatabaseController::getInstance();
    $pdo = $db->getPdo();
    $stmt = $pdo->prepare('UPDATE fach SET fachbezeichnung=:fachbezeichnung WHERE fid=:fid');
    $stmt->execute(array('fachbezeichnung' => $fach->fachbezeichnung, 'fid' => $fach->fid));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>