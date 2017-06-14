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
	 <table id="content">
    <tbody>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
    <form method="POST" >

    	<tr>
    	<td class="field">REG_ID</td>
    	<td class="value"><input name="id" type="text"></td>
		</tr>
    	<tr>
    	<td class="field">KOOLI NIMI</td>
    	<td class="value"><input name="name" type="text"></td>
		</tr>
		<tr>
    	<td class="field">KOOLI TÜÜP</td>
    	<td class="value"><input name="type" type="text"></td>
		</tr>
    	<tr>
    	<td class="field">MAAKOND</td>
    	<td class="value"><input name="county" type="text"></td>
		</tr>
    	<tr>
    	<td class="field">VALD/LINN</td>
    	<td class="value"><input name="parish" type="text"></td>
		</tr>
    	<tr>
    	<td class="field">ASULA/LINNAOSA</td>
    	<td class="value"><input name="city" type="text"></td>
		</tr>
    	<tr>
    	<td class="field">AADRESS</td>
    	<td class="value"><input name="address" type="text"></td>
		</tr>
    	<tr>
    	<td class="field">POSTI INDEKS</td>
    	<td class="value"><input name="postcode" type="number"></td>
		</tr>
    	<tr>
    	<td class="field">VEEBILEHT</td>
    	<td class="value"><input name="webpage" type="text"></td>
		</tr>
    	
		<tr><td colspan="2" class="submit"><input type="submit" value="Salvesta"></td></tr>
    </form>
	</tbody>
	</table>
</body>
</html>
