<?php
	//edit.php
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);




	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){

		$Event->updatePerson($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["name"]), $Helper->cleanInput($_POST["type"]), $Helper->cleanInput($_POST["county"]), $Helper->cleanInput($_POST["parish"]),$Helper->cleanInput($_POST["city"]), $Helper->cleanInput($_POST["address"]),$Helper->cleanInput($_POST["postcode"]), $Helper->cleanInput($_POST["webpage"]));

		header("Location: a_koolileht.php?id=".$_POST["id"]."&success=true");
        exit();

	}

	//saadan kaasa id
	$p = $Event->getSinglePerosonData($_GET["id"]);


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
  <a href="a_avaleht.html"><button class="buttons">AVALEHT</button></a>
  <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>

    <table id="content">
    <tbody>
    
	<?php
		
			$html = "<tr>";
			$html .= "<td class='choose'>
				<a href='kooli_muutmine.php?id=".$p->id."'>
					<span class='glyphicon glyphicon-pencil'></span> Muuda kooli infot
				</a>
				</td>";

			$html .= "<td class='choose'>
				<a href='aasta_lisamine.php?id=".$p->id."'>
					<span class='glyphicon glyphicon-pencil'></span> Lisa õppeaasta info
				</a>
				</td>";
			$html .= "</tr>";



			$html .= "</tbody>";
  	$html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
  	echo $html;

  ?>


	