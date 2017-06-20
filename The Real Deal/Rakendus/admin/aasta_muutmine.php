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

	if (isset($_GET["logout"])) {

		session_destroy();

		header("Location: login.php");
		exit();

	}

	$q = $w = "";
	if (isset($_GET["q"])) { $q = $_GET["q"]; }
	if (isset($_GET["w"])) { $e = $_GET["w"]; }

	$sort = "id";
	$order = "ASC";

	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}

	$people = $Event->getData($q, $sort, $order, $w);


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
  <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>
	<a href="a_otsing_del.php"><button class="buttons deleted">KUSTUTATUD</button></a>
	<button class="logout"><a href="?logout=1" class="logoutlink">Logi välja</a></button>
  <table>

    <form>
  <tr>

    	<th colspan="5"><a href="" id="addyear">Lisa uue õppeaasta info</th>
  </tr>
  </form>

  <script type="text/javascript" >
  		window.onload = function(){
			var id = location.search.substring(3);
			document.getElementById("addyear").href="aasta_lisamine.php?id="+id;
		}
  </script>
</body>
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

					$orderStudents = "ASC";
               			if (isset($_GET["order"]) &&
               				$_GET["order"] == "ASC" &&
               				$_GET["sort"] == "students" ) {

               				$orderStudents = "DESC";
               			}
                     $html .= "<th class='center'><a href='?q=".$q."&sort=students&order=".$orderStudents."'>
               							Õpilaste arv
               					 </th>";



					 $orderBoys = "ASC";
               			if (isset($_GET["order"]) &&
               				$_GET["order"] == "ASC" &&
               				$_GET["sort"] == "boys" ) {

               				$orderBoys = "DESC";
               			}
                     $html .= "<th class='center'><a href='?q=".$q."&sort=boys&order=".$orderBoys."'>
               							Poiste arv
               					 </th>";

					$orderGirls = "ASC";
               			if (isset($_GET["order"]) &&
               				$_GET["order"] == "ASC" &&
               				$_GET["sort"] == "girls" ) {

               				$orderGirls = "DESC";
               			}
                     $html .= "<th class='center'><a href='?q=".$q."&sort=girls&order=".$orderGirls."'>
               							Tüdrukute arv
               					 </th>";

											$html .= "<th class='center'>Muuda</th>";


  		$html .= "</tr>";

  		//iga liikme kohta massiivis
  		foreach ($people as $p) {

  			$html .= "<tr>";
  				$html .= "<td class='center'>".$p->year."</td>";
  				$html .= "<td class='center'>".$p->students."</td>";
				$html .= "<td class='center'>".$p->boys."</td>";
				$html .= "<td class='center'>".$p->girls."</td>";
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
