<?php
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	if(isset($_GET["delete"])){
		$Event->deleteDirectors($_GET["director"]);
		header("Location: direktori_muutmine.php?q=".$_GET['id']);
		exit();
	}
	if (!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	if (isset($_GET["logout"])) {

		session_destroy();

		header("Location: login.php");
		exit();

	}

	if(isset($_POST["principal"])){
		$p = $Event->getSingleDirector($_POST["principal"]);
		$w = $Event->deleteDirectors($_POST["principal"]);
	}else{
		$p = $Event->getSingleDirector($_GET["director"]);
		$w = $Event->deleteDirectors($_GET["director"]);
	}

?>

<!DOCTYPE html>

<html lang="et">
<head>
		<meta charset="UTF-8">
		<title>Koolileht</title>
		<link href="../css/normalize.css" rel="stylesheet" type="text/css">
		<link href="../css/stiil.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src = "../script/edit.js" ></script>
</head>
<body>
  <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>
	<a href="a_otsing_del.php"><button class="buttons deleted">KUSTUTATUD</button></a>
	<button class="logout"><a href="?logout=1" class="logoutlink">Logi välja</a></button>
    </body>
    </html>
