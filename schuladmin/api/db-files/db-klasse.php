<?php
	function db_insert_klasse($klasse) {
		$sql = "insert into klasse (klassenbezeichnung)
            values ('" . addslashes($klasse->klassenbezeichnung) . "')";
		sqlQuery($sql);
	}

	function db_get_klasse() {
		$sql = "select * from klasse";
		return sqlSelect($sql);
	}

	function db_delete_klasse($id) {
		$sql = "DELETE FROM klasse WHERE kid=" . addslashes($id->kid);
		sqlQuery($sql);
	}

	function db_select_klasse_from_id($id) {
		$sql = "SELECT * FROM klasse WHERE kid=" . addslashes($id) . ";";
		return sqlSelect($sql);
	}

	function db_update_klasse($klasse) {
		$sql = "UPDATE klasse SET klassenbezeichnung='" . addslashes($klasse->klassenbezeichnung) . "' WHERE kid=" . addslashes($klasse->kid);
		return sqlQuery($sql);
	}

?>