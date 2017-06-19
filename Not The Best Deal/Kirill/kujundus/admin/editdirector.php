<?php
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	if(isset($_GET["delete"])){
		$Event->deletePersonDirector($_GET["director"]);
		header("Location: direktori_muutmine.php?q=".$_GET['id']);
		exit();
	}
	if (!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	if (isset($_GET["logout"])) {

		session_destroy();

		header("Location: login.php");
		exit();

	}

	if(isset($_POST["update"])){

				$Event->updatePersonDirector($Helper->cleanInput($_POST["REG_ID"]), $Helper->cleanInput($_POST["start_year"]), $Helper->cleanInput($_POST["end_year"]), $Helper->cleanInput($_POST["principal"]));

		header("Location: direktori_muutmine.php?id=".$_POST["id"]."&success=true");
        exit();

	}

	$p = $Event->getSinglePerosonDataDirectors($_GET["director"]);
	$w = $Event->deletePersonDirector($_GET["director"]);



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

    <table id="content" class="smaller">
    <tbody>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
				<tr>
	          <td class="field"><p>Direktor </p></td>
	          <td class="value"><input type="hidden" name="principal" id="principalInput" value="<?php echo $p->principal;?>"><p id="principal" name="principal" type="text"><?php echo $p->principal;?></p><img src="../pildid/edit.png" onclick="changeDirectorValue('principal')" alt="Edit symbol" class="edit"></td>
	      </tr>
				<tr>
	          <td class="field"><p>Alustamine </p></td>
	          <td class="value"><input type="hidden" name="start_year" id="start_yearInput" value="<?php echo $p->start_year;?>"><p id="start_year" name="start_year" type="text"><?=$p->start_year;?></p><img src="../pildid/edit.png" onclick="changeDirectorValue('start_year')" alt="Edit symbol" class="edit"></td>
	      </tr>
				<tr>
	          <td class="field"><p>Lõpetamine </p></td>
	          <td class="value"><input type="hidden" name="end_year" id="end_yearInput" value="<?php echo $p->end_year;?>"><p id="end_year" name="end_year" type="text"><?=$p->end_year;?></p><img src="../pildid/edit.png" onclick="changeDirectorValue('end_year')" alt="Edit symbol" class="edit"></td>
	      </tr>
      <tr>
      <td colspan="2" class="submit"><input type="submit" class="submitbtn" name="update" value="Salvesta"></td>
      </tr>

      </form>
    </tbody>
    </table>
<a href="?id=<?=$_GET["id"];?>&delete=true" class="deletebtn"><button>kustuta</a>
    </body>
    </html>
