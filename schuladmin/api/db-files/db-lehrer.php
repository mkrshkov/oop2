<?php
	function db_insert_lehrer($lehrer) {

		if (!$lehrer->geburtsdatum) {
			$sql = "insert into lehrer (username,id,name,vorname,kuerzel,mail)
        values ('" . addslashes($lehrer->username) . "','" . addslashes($lehrer->id) . "','" .
				$lehrer->name . "','" . addslashes($lehrer->vorname) . "','" . addslashes($lehrer->kuerzel) . "','" . addslashes($lehrer->mail) . "')";
			sqlQuery($sql);
		} else {
			$sql = "insert into lehrer (username,id,name,vorname,geburtsdatum,kuerzel,mail)
        values ('" . addslashes($lehrer->username) . "','" . addslashes($lehrer->id) . "','" .
				$lehrer->name . "','" . addslashes($lehrer->vorname) . "','" .
				addslashes($lehrer->geburtsdatum) . "','" . addslashes($lehrer->kuerzel) . "','" . addslashes($lehrer->mail) . "')";
			sqlQuery($sql);
		}

	}

	function db_get_lehrer() {
		$sql = "select * from lehrer";
		return sqlSelect($sql);
	}

	function db_delete_lehrer($lehrer) {
		$sql = "DELETE FROM lehrer WHERE lid=" . addslashes($lehrer->lid);
		sqlQuery($sql);
	}

	function db_select_lehrer_from_id($id) {
		$sql = "SELECT * FROM lehrer WHERE lid=" . addslashes($id) . ";";
		return sqlSelect($sql);
	}

	function db_update_lehrer($lehrer) {
		$sql = "UPDATE lehrer SET username='" . addslashes($lehrer->username) . "', id='" . addslashes($lehrer->id) . "', name='" . addslashes($lehrer->name) . "', vorname='" . addslashes($lehrer->vorname) . "', geburtsdatum='" . addslashes($lehrer->geburtsdatum) . "', kuerzel='" . addslashes($lehrer->kuerzel) . "', mail='" . addslashes($lehrer->mail) . "' WHERE lid=" . addslashes($lehrer->lid);
		return sqlQuery($sql);
	}

?>