<?php


function open_database() {
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'root';
	$db_name = 'PROVA';


	try {
		$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
		return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		return null;
	}
}

function close_database($conn) {
	try {
		mysqli_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

?>