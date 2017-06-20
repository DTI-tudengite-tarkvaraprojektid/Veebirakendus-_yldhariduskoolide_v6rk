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

		$Event->saveShool($Helper->cleanInput($_POST["id"]), $name, $type, $county, $parish, $city, $address, $postcode, $webpage );
	}


?>

<!DOCTYPE html>

<html lang="et">
<head>
        <meta charset="UTF-8">
        <title>Uue kooli lisamine</title>
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

   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
        <tr>
        <td class="field">registri kood</td>
        <td class="value">
        <input name="id" type="text">
        </td></tr>

      <tr>
        <td class="field">kooli nimi</td>
        <td class="value">
        <input name="name" type="text">
        </td></tr>

       <tr>
        <td class="field">tüüp</td>
        <td class="value">
        <input name="type" type="text">
        </td></tr>

      <tr>
        <td class="field">maakond</td>
        <td class="value">
        <input name="county" type="text">
        </td></tr>

      <tr>
        <td class="field">vald/linn</td>
        <td class="value">
        <input name="parish" type="text">
        </td></tr>

      <tr>
        <td class="field">asula/linnaosa</td>
        <td class="value">
        <input name="city" type="text">
        </td></tr>

      <tr>
        <td class="field">aadress</td>
        <td class="value">
        <input name="address" type="text">
        </td></tr>

      <tr>
        <td class="field">postiindeks</td>
        <td class="value">
        <input name="postcode" type="text">
        </td></tr>

      <tr>
        <td class="field">veebileht</td>
        <td class="value">
        <input name="webpage" type="text">
        </td></tr>


       <tr>
        <td colspan="2" class="submit"><input type="submit" class="submitbtn" value="Salvesta"></td>
        </tr>
    </form>
</body>
</html>
