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
     	isset($_POST["year"]) &&
	 	isset($_POST["REG_ID"]) &&
		 isset($_POST["students"]) &&
		 isset($_POST["boys"]) &&
		 isset($_POST["girls"]) &&
		 isset($_POST["teachers"]) &&
		 isset($_POST["language"]) &&
		 isset($_POST["notes"]) &&
		 
     !empty($_POST["id"]) &&
		 !empty($_POST["year"]) &&
		 !empty($_POST["REG_ID"]) &&
		 !empty($_POST["students"]) &&
		 !empty($_POST["boys"]) &&
		 !empty($_POST["girls"]) &&
		 !empty($_POST["teachers"]) &&
		 !empty($_POST["language"]) &&
		 !empty($_POST["notes"])
	) {

    $id = $Helper->cleanInput($_POST["id"]);
    $year = $Helper->cleanInput($_POST["year"]);
	$REG_ID = $Helper->cleanInput($_POST["REG_ID"]);
		$students = $Helper->cleanInput($_POST["students"]);
		$boys = $Helper->cleanInput($_POST["boys"]);
		$girls = $Helper->cleanInput($_POST["girls"]);
		$teachers = $Helper->cleanInput($_POST["teachers"]);
		$language = $Helper->cleanInput($_POST["language"]);
		$notes = $Helper->cleanInput($_POST["notes"]);

		$Event->saveEventData($Helper->cleanInput($_POST["id"]), $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes);
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
  <a href="a_avaleht.html"><button class="buttons">AVALEHT</button></a>
  <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>
    
	<table id="content">
    <tbody>
   


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
		<tr>
    	<td class="field">id</td>
    	<td class="value"><input name="id" type="number" ></td>
		</tr>
    	<tr>
    	<td class="field">Õppeaasta</td>
    	<td class="value"><input name="year" type="number"></td>
		</tr>
		<tr>
    	<td class="field">REG_ID</td>
    	<td class="value"><input name="REG_ID" type="number"></td>
		</tr>
		<tr>
    	<td class="field">Õpilaste arv</td>
    	<td class="value"><input name="students" type="number"></td>
		</tr>
		<tr>
    	<td class="field">Poiste arv</td>
    	<td class="value"><input name="boys" type="number"></td>
		</tr>
		<tr>
    	<td class="field">Tüdrukute arv</td>
    	<td class="value"><input name="girls" type="number"></td>
		</tr>
		<tr>
    	<td class="field">Õpetajate arv</td>
    	<td class="value"><input name="teachers" type="number"></td>
		</tr>
		<tr>
    	<td class="field">Õppekeel</td>
    	<td class="value"><input name="language" type="text"></td>
		</tr>
		<tr>
    	<td class="field">Märkused</td>
    	<td class="value"><input name="notes" type="text"></td>
		</tr>
		<tr>
    	<td colspan="2" class="submit"><input type="submit" value="Salvesta"></td>
		</tr>
    </form>
	</tbody>
    </table>
</body>
</html>
