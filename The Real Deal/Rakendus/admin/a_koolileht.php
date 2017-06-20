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
 ?>
<!DOCTYPE html>

<html lang="et">
<head>
        <meta charset="UTF-8">
        <title>Koolileht</title>
        <link href="../css/normalize.css" rel="stylesheet" type="text/css">
        <link href="../css/stiil.css" rel="stylesheet" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript" src = "../script/getinfo.js" ></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZZb_ZloG3Ylb1tA6Dt5U-O3tNW8hCDvw&callback=initMap"></script>
</head>
<body>

 <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>
    <a href="a_otsing_del.php"><button class="buttons deleted">KUSTUTATUD</button></a>
    <button class="logout"><a href="?logout=1" class="logoutlink">Logi välja</a></button>
<table id="content">

  <tr>
      <td class="infocolumn" rowspan="2">
          <p class="info" >KOOLI NIMI</p>
          <p class="infovalue" id="name"></p>
          <p class="info">ASUTAMISE AASTA</p>
          <p class="infovalue" id="openyear"></p>
          <p class="info">ASUKOHT</p>
          <p class="infovalue" id="address"></p>
          <p class="info ">VEEBILEHT</p>
          <p class="infovalue" id="website"></p>
          <div class="wrapper">
<ul>
  <li>
    <input type="checkbox" id="list-item-2">
    <label for="list-item-2" class="middle">DIREKTORID ↓</label>
    <ul id="principals">
      <li></li>
    </ul>
  </li>
  <li>
    <input type="checkbox" id="list-item-3">
    <label for="list-item-3" class="middle">ASUKOHA MUUTUSED ↓</label>
    <ul id="addchange">
      <li></li>
    </ul>
  </li>
  <li>
    <input type="checkbox" id="list-item-4">
    <label for="list-item-4" class="middle">NIME MUUTUSED ↓</label>
    <ul id="namechange">
      <li></li>
    </ul>
  </li>
  <li>
    <input type="checkbox" id="list-item-5">
    <label for="list-item-5" class="last">LISAINFO ↓</label>
    <ul>
      <li></li>
    </ul>
  </li>
</ul>
</div>

  </td>
      <td href="gallery.html" class="img" id="image"></td>
  </tr>

  <tr>
      <td class="map"><div id="map"></div></td>
  </tr>



  <tr>
      <td colspan="3" class="diagram"><div id="container1"></div></td>
  </tr>


</table>
</body>
</html>
