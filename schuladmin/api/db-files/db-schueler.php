<?php
	function db_insert_student($student) {
		if (!$student->geburtsdatum) {
			$sql = "insert into schueler (username,id,name,vorname,kuerzel,mail)
        values ('" . addslashes($student->username) . "','" . addslashes($student->id) . "','" .
				$student->name . "','" . addslashes($student->vorname) . "','" . addslashes($student->kuerzel) . "','" . addslashes($student->mail) . "')";
			sqlQuery($sql);
		} else {
			$sql = "insert into schueler (username,id,name,vorname,geburtsdatum,kuerzel,mail)
            values ('" . addslashes($student->username) . "','" . addslashes($student->id) . "','" .
				$student->name . "','" . addslashes($student->vorname) . "','" .
				addslashes($student->geburtsdatum) . "','" . addslashes($student->kuerzel) . "','" . addslashes($student->mail) . "')";
			sqlQuery($sql);
		}
	}

	function db_get_schueler() {
		$sql = "select * from schueler";
		return sqlSelect($sql);
	}

	function db_delete_schueler($id) {
		$sql = "DELETE FROM schueler WHERE sid=" . addslashes($id->sid);
		sqlQuery($sql);
	}

	function db_select_schueler_from_id($id) {
		$sql = "SELECT * FROM schueler WHERE sid=" . addslashes($id->sid);
		return sqlQuery($sql);
	}

	function db_update_schueler($student) {
		$sql = "UPDATE schueler SET username='" . addslashes($student->username) . "', id='" . addslashes($student->id) . "', name='" . addslashes($student->name) . "', vorname='" . addslashes($student->vorname) . "', geburtsdatum='" . addslashes($student->geburtsdatum) . "', kuerzel='" . addslashes($student->kuerzel) . "', mail='" . addslashes($student->mail) . "' WHERE sid=" . addslashes($student->sid);
		return sqlQuery($sql);
	}

?>