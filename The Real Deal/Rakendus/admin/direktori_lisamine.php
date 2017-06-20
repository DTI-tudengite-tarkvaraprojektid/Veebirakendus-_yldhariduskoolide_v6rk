<?php
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	if (!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	if (isset($_GET["logout"])) {

		session_destroy();

		header("Location: login.php");
		exit();

	}

	$getId = '';
	if(isset($_GET["id"])){ $getId = $_GET["id"]; }


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

		$Event->saveDirector($Helper->cleanInput($_POST["REG_ID"]), $start_year, $end_year, $principal);
	}


?>

<!DOCTYPE html>

<html lang="et">
<head>
		<meta charset="UTF-8">
		<title>Aasta õpilaste Lisamine</title>
		<link href="../css/normalize.css" rel="stylesheet" type="text/css">
		<link href="../css/stiil.css" rel="stylesheet" type="text/css">
</head>
<body>
  <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>
	<a href="a_otsing_del.php"><button class="buttons deleted">KUSTUTATUD</button></a>
	<button class="logout"><a href="?logout=1" class="logoutlink">Logi välja</a></button>

	<table id="content" class="smaller">
    <tbody>



    <form method="post" >
		<tr>
    	<td class="field">REG_ID</td>
    	<td class="value"><p><?=$getId;?></p><input type="hidden" name="REG_ID" type="number" value="<?=$getId;?>"></td>
		</tr>
		<tr>
    	<td class="field">Alustamine</td>
    	<td class="value"><input name="start_year" type="number"></td>
		</tr>
		<tr>
    	<td class="field">Lõppetamine</td>
    	<td class="value"><input name="end_year" type="number"></td>
		</tr>
		<tr>
    	<td class="field">Direktori nimi</td>
    	<td class="value"><input name="principal" type="text"></td>
		</tr>
		<tr>
    	<td colspan="2" class="submit"><input type="submit" class="submitbtn" value="Salvesta"></td>
		</tr>
    </form>
	</tbody>
    </table>
</body>
</html>
