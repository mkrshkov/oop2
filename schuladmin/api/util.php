<?php

	function formatMessage($status = 200, $data = null) {
		$message = array();
		$message['status'] = $status;
		$message['data'] = $data;
		return $message;
	}


	function redirect($id = "") {
		if (!empty($id)) $id = "?id=$id";
		header("Location: " . $_SERVER['PHP_SELF'] . $id);
		exit();
	}

	function CheckEmail($value, $empty = 'N') {
		$pattern_email = '/^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/i';
		if ($empty == 'Y' && empty($value)) return true;
		if (preg_match($pattern_email, $value)) return true;
		else return false;
	}

	function CheckBirthDate($value, $empty = 'N') {
		$pattern_date = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
		if ($empty == 'Y' && empty($value)) return true;
		if (preg_match($pattern_date, $value)) return true;
		else return false;
	}

	function CheckName($value, $empty = 'N') {
		$pattern_name = '/^[a-zA-ZÄÖÜäöü \-]{2,}$/';
		if ($empty == 'Y' && empty($value)) return true;
		if (preg_match($pattern_name, $value)) return true;
		else return false;
	}

	function CheckOrt($value, $empty = 'N') {
		$pattern_ort = '/^[a-zA-ZÄÖÜäöü \-\.]{2,}$/';
		if ($empty == 'Y' && empty($value)) return true;
		if (empty($value)) return false;
		if (preg_match($pattern_ort, $value)) return true;
		else return false;
	}

	function CheckPLZ($value, $empty = 'N') {
		$pattern_plz = '/^[0-9]{4,}$/';
		if ($empty == 'Y' && empty($value)) return true;
		if (empty($value)) return false;
		if (preg_match($pattern_plz, $value)) return true;
		else return false;
	}

// Allow letters, numbers, - and ' ' 
	function CheckClass($value, $empty = 'N') {
		$pattern_plz = '/^[a-z0-9 .\-]+$/';
		if ($empty == 'Y' && empty($value)) return true;
		if (empty($value)) return false;
		if (preg_match($pattern_plz, $value)) return true;
		else return false;
	}

?>