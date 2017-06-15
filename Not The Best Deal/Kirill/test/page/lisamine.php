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


	if ( isset($_POST["id"]) &&
     isset($_POST["name"]) &&
		 isset($_POST["type"]) &&
		 isset($_POST["county"]) &&
		 isset($_POST["city"]) &&
		 isset($_POST["parish"]) &&
		 isset($_POST["address"]) &&
		 isset($_POST["postcode"]) &&
		 isset($_POST["webpage"]) &&
     !empty($_POST["id"]) &&
		 !empty($_POST["name"]) &&
		 !empty($_POST["type"]) &&
		 !empty($_POST["county"]) &&
		 !empty($_POST["city"]) &&
		 !empty($_POST["parish"]) &&
		 !empty($_POST["address"]) &&
		 !empty($_POST["postcode"]) &&
		 !empty($_POST["webpage"])
	) {

    $id = $Helper->cleanInput($_POST["id"]);
    $name = $Helper->cleanInput($_POST["name"]);
		$type = $Helper->cleanInput($_POST["type"]);
		$county = $Helper->cleanInput($_POST["county"]);
		$parish = $Helper->cleanInput($_POST["parish"]);
		$city = $Helper->cleanInput($_POST["city"]);
		$address = $Helper->cleanInput($_POST["address"]);
		$postcode = $Helper->cleanInput($_POST["postcode"]);
		$webpage = $Helper->cleanInput($_POST["webpage"]);

		$Event->saveEvent($Helper->cleanInput($_POST["id"]), $name, $type, $county, $parish, $city, $address, $postcode, $webpage );
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

    	<label>ID</label><br>
    	<input name="id" type="text">

    	<br><br>
		<label>Kooli nimi</label><br>
		<input name="name" type="text">

		<br><br>
    	<label>Tüüp</label><br>
    	<input name="type" type="text">

    	<br><br>
    	<label>Maakond</label><br>
    	<input name="county" type="text">

    	<br><br>
    	<label>Linn</label><br>
    	<input name="parish" type="text">

    	<br><br>
    	<label>Linna osa</label><br>
    	<input name="city" type="text">

    	<br><br>
    	<label>Address</label><br>
    	<input name="address" type="text">

    	<br><br>
    	<label>Postcode</label><br>
    	<input name="postcode" type="text">

    	<br><br>
    	<label>Veebileht</label><br>
    	<input name="webpage" type="text">

    	<br><br>

    	<input type="submit" value="Salvesta">

    </form>
</body>
</html>
