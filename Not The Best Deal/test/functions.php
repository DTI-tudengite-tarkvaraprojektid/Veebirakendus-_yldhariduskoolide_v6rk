<?php

	require("/home/kirikotk/config.php");

	// see fail peab olema siis seotud kõigiga kus
	// tahame sessiooni kasutada
	// saab kasutada nüüd $_SESSION muutujat
	session_start();

	$database = "if16_kirikotk_4";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	$mysqli->set_charset("utf8");
?>
