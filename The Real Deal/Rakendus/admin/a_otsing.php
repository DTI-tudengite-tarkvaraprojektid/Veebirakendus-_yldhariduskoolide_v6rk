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

	$q = $e = $y = $r = "";
	if (isset($_GET["q"])) { $q = $_GET["q"]; }
	if (isset($_GET["e"])) { $e = $_GET["e"]; }
	if (isset($_GET["y"])) { $y = $_GET["y"]; }
	if (isset($_GET["r"])) {  $r = $_GET["r"]; }

	$sort = "id";
	$order = "ASC";

	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}

	$people = $Event->getSchools($q, $sort, $order, $e, $r, $y);


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
  <tbody>
    <form>
  <tr>
      <th><input type="search" class="center2" placeholder="Nimi" name="q" value="<?=$q;?>"></th>
      <th><input type="search" class="center2" placeholder="Maakond" name="e" value="<?=$e;?>"></th>
      <th><input type="search" class="center2" placeholder="Vald/linn" name="y" value="<?=$y;?>"></th>
      <th><input type="search" class="center2" placeholder="Linnaosa/asula" name="r" value="<?=$r;?>"></th>
     <th> <input type="submit" class="buttons search" value="Otsi">
    </th>

 </tr>
  </form>

 <?php


         $html = "<tr>";



     $orderName = "ASC";
            if (isset($_GET["order"]) &&
                $_GET["order"] == "ASC" &&
                $_GET["sort"] == "name" ) {

                $orderName = "DESC";
            }
              $html .= "<th class='center'><a href='?q=".$q."&sort=name&order=".$orderName."'>
                              Kooli nimi
                       </th>";



            $orderCounty = "ASC";
                   if (isset($_GET["order"]) &&
                       $_GET["order"] == "ASC" &&
                       $_GET["sort"] == "county" ) {

                      $orderCounty = "DESC";
                   }
             $html .= "<th class='center'><a href='?q=".$q."&sort=county&order=".$orderCounty."'>
                                   Maakond
                            </th>";


                $orderParish = "ASC";
                                if (isset($_GET["order"]) &&
                                    $_GET["order"] == "ASC" &&
                                    $_GET["sort"] == "parish" ) {

                                   $orderParish = "DESC";
                                }
                 $html .= "<th class='center'><a href='?q=".$q."&sort=parish&order=".$orderParish."'>
                                       Vald/linn
                                </th>";


                    $orderCity = "ASC";
                           if (isset($_GET["order"]) &&
                               $_GET["order"] == "ASC" &&
                               $_GET["sort"] == "city" ) {

                              $orderCity = "DESC";
                           }
                     $html .= "<th class='center'><a href='?q=".$q."&sort=city&order=".$orderCity."'>
                                           Linnaosa/asula
                                    </th>";

                                            $html .= "<th class='center'>Muuda</th>";


         $html .= "</tr>";

         foreach ($people as $p) {

             $html .= "<tr>";
                  $html .= "<td class='center'><a href='a_koolileht.php?schoolname=".$p->name."'>".$p->name."</td>";
                  $html .= "<td class='center'>".$p->county."</td>";
                  $html .= "<td class='center'>".$p->parish."</td>";
                  $html .= "<td class='center'>".$p->city."</td>";
                    $html .= "<td class='center'>
                <a href='edit.php?id=".$p->id."'>
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
