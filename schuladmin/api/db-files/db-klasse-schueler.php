<?php
	function db_get_schueler_klasse($id) {
		$sql = "SELECT schueler.sid, schueler.vorname, schueler.name, klasse.kid, klasse.klassenbezeichnung
    FROM schueler 
    JOIN `schueler-klasse` on (schueler.sid=`schueler-klasse`.sid) 
    JOIN klasse on (klasse.kid=`schueler-klasse`.kid) WHERE klasse.kid = " . $id . ";";

		return sqlSelect($sql);
	}

	function db_insert_schueler_klasse($klasseSchueler) {
		$sql = "INSERT INTO `schuladmin`.`schueler-klasse` (`sid`, `kid`) VALUES (" . addslashes($klasseSchueler->sid) . ", " . addslashes($klasseSchueler->kid) . ");";
		sqlQuery($sql);
	}

	function db_delete_schueler_klasse($klasseSchueler) {
		$sql = "DELETE FROM `schuladmin`.`schueler-klasse`  WHERE `sid`=" . addslashes($klasseSchueler->sid) . " and `kid`= " . addslashes($klasseSchueler->kid) . ";";
		sqlQuery($sql);
	}

?>