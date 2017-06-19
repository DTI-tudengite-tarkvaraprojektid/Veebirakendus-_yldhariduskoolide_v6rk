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

	$p = ($_GET["id"]);

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

   <table id="content">
    <tbody>

    <?php



            $html = "<tr>";
            $html .= "<td class='choose'>
                <a href='kooli_muutmine.php?id=".$p."'>
                    Muuda kooli infot
                </a>
                </td></tr>";

            $html .= "<tr><td class='choose'>
                <a href='aasta_muutmine.php?q=".$p."'>
                    Muuda õppeaasta info
                </a>
                </td></tr>";
                $html .= "<tr><td class='choose'>
                    <a href='direktori_muutmine.php?q=".$p."'>
                        Muuda direktori info
                    </a>
                    </td></tr>";
                $html .= "<tr><td class='choose'>
                    <a href='pildi_lisamine.php?q=".$p."'>
                        Lisa pilt
                    </a>
                    </td>";
            $html .= "</tr>";


            $html .= "</tbody>";
      $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
      echo $html;

 ?>
