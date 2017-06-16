<?php
	//ühendan sessiooniga
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	//kui ei ole sisseloginud, suunan login lehele
	if (!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	//kas aadressireal on logout
	if (isset($_GET["logout"])) {

		session_destroy();

		header("Location: login.php");
		exit();

	}


	if ( isset($_POST["REG_ID"]) &&
     isset($_POST["start_year"]) &&
		 isset($_POST["end_year"]) &&
		 isset($_POST["principal"]) &&
     !empty($_POST["REG_ID"]) &&
		 !empty($_POST["start_year"]) &&
		 !empty($_POST["end_year"]) &&
		 !empty($_POST["principal"])
	) {

    $REG_ID = $Helper->cleanInput($_POST["REG_ID"]);
    $start_year = $Helper->cleanInput($_POST["start_year"]);
		$end_year = $Helper->cleanInput($_POST["end_year"]);
		$principal = $Helper->cleanInput($_POST["principal"]);

		$Event->saveEventDirector($Helper->cleanInput($_POST["REG_ID"]), $start_year, $end_year, $principal );
	}


?>

<!DOCTYPE html>

<html lang="et">
<head>
		<meta charset="UTF-8">
		<title>Lisamine</title>
		<link href="../css/normalize.css" rel="stylesheet" type="text/css">
		<link href="../css/stiil.css" rel="stylesheet" type="text/css">
</head>
<body>
  <a href="a_avaleht.html"><button class="buttons">AVALEHT</button></a>
  <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>
    <br>
    <h2>Lisa uus kool</h2>
    <form method="POST" >

    	<label>REG_ID</label><br>
    	<input name="REG_ID" type="number">

    	<br><br>
		<label>Start</label><br>
		<input name="start_year" type="number">

		<br><br>
    	<label>End</label><br>
    	<input name="end_year" type="number">

    	<br><br>
    	<label>principal</label><br>
    	<input name="county" type="text">

    	<br><br>

    	<input type="submit" value="Salvesta">

    </form>
</body>
</html>
