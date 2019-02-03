<?php

  $db_host = "127.0.0.1:3307";
	$db_username = "root";
	$db_password = "root";
	$db_name = "dnd_tools";

	$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

	if ($conn->connect_error) {
		die ("Error connecting to the DB.<br>" . $conn->connect_error);
	}

?>
