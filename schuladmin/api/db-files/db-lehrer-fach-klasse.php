<?php
	function db_get_lehrer_fach_klasse($id) {
		$sql = "SELECT lehrer.lid, lehrer.vorname, lehrer.name, klasse.kid, klasse.klassenbezeichnung, fach.fid, fach.fachbezeichnung
FROM lehrer 
JOIN `lehrer-fach-klasse` on (lehrer.lid=`lehrer-fach-klasse`.lid) 
JOIN klasse on (klasse.kid=`lehrer-fach-klasse`.kid) 
JOIN fach on (fach.fid= `lehrer-fach-klasse`.fid) WHERE lehrer.lid = " . $id . ";";

		return sqlSelect($sql);
	}

	function db_insert_lehrer_fach_klasse($lehrerFachKlasse) {
		$sql = "INSERT INTO `schuladmin`.`lehrer-fach-klasse` (`fid`, `kid`, `lid`) VALUES (" . addslashes($lehrerFachKlasse->fid) . ", " . addslashes($lehrerFachKlasse->kid) . ", " . addslashes($lehrerFachKlasse->lid) . ");";
		sqlQuery($sql);
	}

	function db_delete_lehrer_fach_klasse($lehrerFachKlasse) {
		$sql = "DELETE FROM `schuladmin`.`lehrer-fach-klasse` WHERE `fid`=" . addslashes($lehrerFachKlasse->fid) . " and `kid`= " . addslashes($lehrerFachKlasse->kid) . " and `lid`=" . addslashes($lehrerFachKlasse->lid) . ";";
		sqlQuery($sql);
	}

?>