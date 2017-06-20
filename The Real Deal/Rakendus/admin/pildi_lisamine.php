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



?>


<!DOCTYPE html>

<html lang="et">
<head>
        <meta charset="UTF-8">
        <title>Pildi lisamine</title>
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

    <form action="../Php/save.php" method="post" enctype="multipart/form-data">
    <input type="text" name="REG_ID" id="REG_ID" hidden>
    <tr><td class="field">Pealkiri:</td><td class="value"><input type="text" name="picname" id="picname"></td></tr>
    <tr><td class="field">Mitmes pilt:</td><td class="value"><input type="number" name="picnr" id="picnr"></td></tr>
    <tr><td class="field">Valige pilt:</td><td class="value"><input type="file" name="fileToUpload" id="fileToUpload"></td></tr>
    <tr><td colspan="2" class="submit"><input type="submit" class="submitbtn" value="Upload Image" name="submit"></td></tr>
    </form>
    </tbody>
    </table>

    <script type="text/javascript">
      var reg_id = decodeURI(location.search.substring(3));
      console.log(reg_id);
      document.getElementById("REG_ID").value = reg_id;
    </script>
</body>
</html>
