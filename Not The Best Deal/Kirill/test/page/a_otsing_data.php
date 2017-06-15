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

	//kas aadressireal on logout
	if (isset($_GET["logout"])) {

		session_destroy();

		header("Location: login.php");
		exit();

	}

	$q = $w = "";
	if (isset($_GET["q"])) { $q = $_GET["q"]; }
	if (isset($_GET["w"])) { $e = $_GET["w"]; }

	//vaikimisi, kui keegi mingit linki ei vajuta
  //vaikimisi, kui keegi mingit linki ei vajuta
	$sort = "id";
	$order = "ASC";

	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}

	$people = $Event->getAllPeopleData($q, $sort, $order, $w);


?>
<!DOCTYPE html>

<html lang="et">
<head>
  <meta charset="UTF-8">
  <title>Otsing</title>
  <link href="../css/normalize.css" rel="stylesheet" type="text/css">
  <link href="../css/stiil.css" rel="stylesheet" type="text/css">

</head>
<body>

  <a href="a_avaleht.html"><button class="buttons">AVALEHT</button></a>
  <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>
  <table>
  <tbody>
    <form>
  <tr>

    </th>
		<th><button><a href="?logout=1">Logi välja</th>
  </tr>
  </form>

  <?php


  		$html = "<tr>";



                 $orderYear = "ASC";
           					 if (isset($_GET["order"]) &&
           						 $_GET["order"] == "ASC" &&
           						 $_GET["sort"] == "year" ) {

           						 $orderYear = "DESC";
           					 }
                 $html .= "<th class='center'><a href='?q=".$q."&sort=year&order=".$orderYear."'>
           							Aasta
           					 </th>";


                     $orderLanguage = "ASC";
               			if (isset($_GET["order"]) &&
               				$_GET["order"] == "ASC" &&
               				$_GET["sort"] == "language" ) {

               				$orderLanguage = "DESC";
               			}
                     $html .= "<th class='center'><a href='?q=".$q."&sort=language&order=".$orderLanguage."'>
               							Keel
               					 </th>";

											$html .= "<th class='center'>Muuda</th>";


  		$html .= "</tr>";

  		//iga liikme kohta massiivis
  		foreach ($people as $p) {

  			$html .= "<tr>";
  				$html .= "<td class='center'>".$p->year."</td>";
  				$html .= "<td class='center'>".$p->language."</td>";
					$html .= "<td class='center'>
				<a href='editdata.php?id=".$p->id."'>
					<span class='glyphicon glyphicon-pencil'></span> Muuda
				</a>
				</td>";

  			$html .= "</tr>";

  		}

    $html .= "</tbody>";
  	$html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
  	echo $html;

  ?>
