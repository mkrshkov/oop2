<?php

class Controller
{
    function controller($method, $ressource, $id, $dataFromClient)
    {
// Teacher part of the controller
        if ($ressource == 'lehrer') {
            switch ($method) {
                case 'GET':
                    if (!empty($id)) {
                        return formatMessage(200, getTeacherById($id));
                    } else {
                        return formatMessage(200, getLehrer());
                    }
                case 'POST':
                    return insertLehrer($dataFromClient);
                case 'PUT':
                    return updateLehrer($dataFromClient);
                case 'DELETE':
                    return formatMessage(200, deleteLehrer($dataFromClient));
                case 'OPTIONS':
                    return formatMessage(405);
                default:
                    return formatMessage(405);
            }
        } // Student part of the controller
        else if ($ressource == 'schueler') {
            switch ($method) {
                case 'GET':
                    return formatMessage(200, getSchueler());
                case 'POST':
                    return insertSchueler($dataFromClient);
                case 'PUT':
                    return updateSchueler($dataFromClient);
                case 'DELETE':
                    return formatMessage(200, deleteSchueler($dataFromClient));
                case 'OPTIONS':
                    return formatMessage(405);
                default:
                    return formatMessage(405);
            }
        } // Subject part of the controller
        else if ($ressource == 'fach') {
            $fach = new Fach(null, null);
            switch ($method) {
                case 'GET':
                    $fachs = $fach->getAll('fach');
                    $response = array();
                    foreach ($fachs as $fach) {
                        $response[] = array('fid' => $fach->getFid(), 'fachbezeichnung' => $fach->getFachbezeichnung());
                    }
                    return formatMessage(200, $response);
                case 'POST':
                    $fach->insert('fach', $dataFromClient);
                    return formatMessage(200, $fach);
                case 'PUT':
                    $fid = $dataFromClient->fid;
                    if (!isset($fid)) {
                        return formatMessage(400, 'Missing ID');
                    }
                    $fach->setFachbezeichnung($dataFromClient->fachbezeichnung);
                    $fach->update('fach', $fid, 'fid', $dataFromClient);
                    return formatMessage(200, $fach);
                case 'DELETE':
                    $fid = $dataFromClient->fid;
                    if (!isset($fid)) {
                        return formatMessage(400, 'Missing ID');
                    }
                    $fach->delete('fach', $fid);
                    return formatMessage(200, 'Successfully deleted');
                case 'OPTIONS':
                    return formatMessage(405);
                default:
                    return formatMessage(405);
            }
        } // Class part of the controller
        else if ($ressource == 'klasse') {
            switch ($method) {
                case 'GET':
                    if (!empty($id)) {
                        return formatMessage(200, getClassById($id));
                    } else {
                        return formatMessage(200, Klasse::getAll());
                    }
                case 'POST':
                    return SELF::insertKlasse($dataFromClient);
                case 'PUT':
                    return updateKlasse($dataFromClient);
                case 'DELETE':
                    return formatMessage(200, deleteKlasse($dataFromClient));
                case 'OPTIONS':
                    return formatMessage(405);
                default:
                    return formatMessage(405);
            }
        } // TeacherSubjectClass part of the controller
        else if ($ressource == 'lehrerFachKlasse') {
            switch ($method) {
                case 'GET':
                    return formatMessage(200, getLehrerFachKlasse($id));
                case 'DELETE':
                    return formatMessage(200, deleteLehrerFachKlasse($dataFromClient));
                case 'OPTIONS':
                    return formatMessage(405);
                default:
                    return formatMessage(405);
            }
        } // AddTeacherSubjectClass part of the controller
        else if ($ressource == 'addLehrerFachKlasse') {
            switch ($method) {
                case 'POST':
                    return formatMessage(200, addLehrerFachKlasse($dataFromClient));
                case 'OPTIONS':
                    return formatMessage(405);
                default:
                    return formatMessage(405);
            }
        } // ClassStudent part of the controller
        else if ($ressource == 'klasseSchueler') {
            switch ($method) {
                case 'GET':
                    return formatMessage(200, getKlasseSchueler($id));
                case 'DELETE':
                    return formatMessage(200, deleteKlasseSchueler($dataFromClient));
                case 'OPTIONS':
                    return formatMessage(405);
                default:
                    return formatMessage(405);
            }
        } // AddClassStudent part of the controller
        else if ($ressource == 'addKlasseSchueler') {
            switch ($method) {
                case 'POST':
                    return formatMessage(200, addSchuelerKlasse($dataFromClient));
                case 'OPTIONS':
                    return formatMessage(405);
                default:
                    return formatMessage(405);
            }
        } // Catches everything inbetween
        else {
            return formatMessage(404, "Controller successful accessed");
        }
    }

// Check inputs ----------------------------------------------------------

    function checkInputSubject($dataSrc)
    {
        $status = true;
        $inputfields = array('fachbezeichnung' => true);

        if (!CheckClass($dataSrc->fachbezeichnung)) {
            $inputfields['fachbezeichnung'] = false;
            $status = false;
        }

        if ($status) return formatMessage();
        else return formatMessage(420, $inputfields);
    }

    function checkInputClass($dataSrc)
    {
        $status = true;
        $inputfields = array('klassenbezeichnung' => true);

        if (!CheckClass($dataSrc->klassenbezeichnung)) {
            $inputfields['klassenbezeichnung'] = false;
            $status = false;
        }

        if ($status) return formatMessage();
        else return formatMessage(420, $inputfields);
    }

    function checkInput($dataSrc)
    {
        $status = true;
        $inputfields = array('name' => true, 'vorname' => true, 'mail' => true);

        if (!CheckName($dataSrc->name)) {
            $inputfields['name'] = false;
            $status = false;
        }

        if (!CheckName($dataSrc->vorname)) {
            $inputfields['vorname'] = false;
            $status = false;
        }

        if (!CheckEmail($dataSrc->mail)) {
            $inputfields['mail'] = false;
            $status = false;
        }

        if ($status) return formatMessage();
        else return formatMessage(420, $inputfields);
    }

// INSERT ----------------------------------------------------------
    function insertLehrer($lehrer)
    {
        $status = SELF::checkInput($lehrer);
        if ($status['status'] == 200) {
            db_insert_lehrer($lehrer);
        }
        return $status;
    }

    function insertSchueler($student)
    {
        $status = checkInput($student);
        if ($status['status'] == 200) {
            db_insert_student($student);
        }
        return $status;
    }

    function insertFach($subject)
    {
        $status = checkInputSubject($subject);
        if ($status['status'] == 200) {
            Fach::db_insert_fach($subject);
        }
        return $status;
    }

    function insertKlasse($class)
    {
        $status = SELF::checkInputClass($class);
        if ($status['status'] == 200) {
            Klasse::db_insert_klasse($class);
        }
        return $status;
    }

// GET ----------------------------------------------------------
    function getLehrer()
    {
        return Lehrer::db_get_lehrer();
    }

    function getSchueler()
    {
        return db_get_schueler();
    }

    function getFach()
    {
        return Fach::db_get_fach();
    }

    function getKlasse()
    {
        return db_get_klasse();
    }

// UPDATE ----------------------------------------------------------
    function updateLehrer($lehrer)
    {
        $status = checkInput($lehrer);
        if ($status['status'] == 200) {
            db_update_lehrer($lehrer);
        }
        return $status;
    }

    function updateSchueler($schueler)
    {
        $status = checkInput($schueler);
        if ($status['status'] == 200) {
            db_update_schueler($schueler);
        }
        return $status;
    }

    function updateFach($subject)
    {
        $status = checkInputSubject($subject);
        if ($status['status'] == 200) {
            Fach::db_update_fach($subject);
        }
        return $status;
    }


    function updateKlasse($klasse)
    {
        $status = checkInputClass($klasse);
        if ($status['status'] == 200) {
            db_update_klasse($klasse);
        }
        return $status;
    }

// GET FROM ID ----------------------------------------------------------
    function getTeacherById($id)
    {
        return db_select_lehrer_from_id($id);
    }

    function getClassById($id)
    {
        return db_select_klasse_from_id($id);
    }

// GET (joined tables) ----------------------------------------------------------

    function getLehrerFachKlasse($id)
    {
        return Lehrer::db_get_lehrer_fach_klasse($id);
    }

    function getKlasseSchueler($id)
    {
        return db_get_schueler_klasse($id);
    }

// ADD (joined tables) ----------------------------------------------------------

    function addLehrerFachKlasse($lehrerFachKlasse)
    {

        return db_insert_lehrer_fach_klasse($lehrerFachKlasse);
    }

    function addSchuelerKlasse($klasseSchueler)
    {
        return db_insert_schueler_klasse($klasseSchueler);
    }

// DELETE ----------------------------------------------------------
    function deleteLehrerFachKlasse($lehrerFachKlasse)
    {
        Lehrer::db_delete_lehrer_fach_klasse($lehrerFachKlasse);
    }

    function deleteKlasseSchueler($klasseSchueler)
    {
        db_delete_schueler_klasse($klasseSchueler);
    }

    function deleteLehrer($lehrer)
    {
        db_delete_lehrer($lehrer);
    }

    function deleteSchueler($schueler)
    {
        db_delete_schueler($schueler);
    }

    function deleteFach($fach)
    {
        Fach::db_delete_fach($fach);
    }

    function deleteKlasse($klasse)
    {
        db_delete_klasse($klasse);
    }
}

?>