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

	$q = "";
	if (isset($_GET["q"])) { $q = $_GET["q"]; }

	$sort = "principal";
	$order = "ASC";

	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}

	$people = $Event->getDirectors($q, $sort, $order);


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

    	<th colspan="4"><a href="" id="addyear">Lisa uus direktor</th>
  </tr>
  </form>

  <script type="text/javascript" >
  		window.onload = function(){
			var id = location.search.substring(3);
			document.getElementById("addyear").href="direktori_lisamine.php?id="+id;
		}
  </script>
</body>
  <?php


  		$html = "<tr>";


                 $orderPrincipal = "ASC";
           					 if (isset($_GET["order"]) &&
           						 $_GET["order"] == "ASC" &&
           						 $_GET["sort"] == "principal" ) {

           						 $orderPrincipal = "DESC";
           					 }
                 $html .= "<th class='center'><a href='?q=".$q."&sort=principal&order=".$orderPrincipal."'>
           							Direktori nimi
           					 </th>";

					$orderStart_year = "ASC";
               			if (isset($_GET["order"]) &&
               				$_GET["order"] == "ASC" &&
               				$_GET["sort"] == "start_year" ) {

               				$orderStart_year = "DESC";
               			}
                     $html .= "<th class='center'><a href='?q=".$q."&sort=start_year&order=".$orderStart_year."'>
               							Alustamine
               					 </th>";



					 $orderEnd_year = "ASC";
               			if (isset($_GET["order"]) &&
               				$_GET["order"] == "ASC" &&
               				$_GET["sort"] == "end_year" ) {

               				$orderEnd_year = "DESC";
               			}
                     $html .= "<th class='center'><a href='?q=".$q."&sort=end_year&order=".$orderEnd_year."'>
               							Lõppemine
               					 </th>";

											$html .= "<th class='center'>Muuda</th>";


  		$html .= "</tr>";

  		//iga liikme kohta massiivis
  		foreach ($people as $p) {

  			$html .= "<tr>";
  				$html .= "<td class='center'>".$p->principal."</td>";
  				$html .= "<td class='center'>".$p->start_year."</td>";
				$html .= "<td class='center'>".$p->end_year."</td>";
					$html .= "<td class='center'>
				<a href='editdirector.php?director=".$p->principal."'>
					<span class='glyphicon glyphicon-pencil'></span> Muuda
				</a>
				<a href='deletedirector.php?director=".$p->principal."'>
					<span class='glyphicon glyphicon-pencil'></span> Kustuta
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
