<?php
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	if(isset($_GET["delete"])){
		$Event->deletePerson($_GET["id"]);
		header("Location: a_otsing.php");
		exit();
	}

	if(isset($_POST["update"])){

				$Event->updatePersonDirector($Helper->cleanInput($_POST["REG_ID"]), $Helper->cleanInput($_POST["start_year"]), $Helper->cleanInput($_POST["end_year"]), $Helper->cleanInput($_POST["principal"]));

		header("Location: direktori_muutmine.php?id=".$_POST["id"]."&success=true");
        exit();

	}

	$p = $Event->getSinglePerosonDataDirectors($_GET["director"]);



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

    <table id="content" class="smaller">
    <tbody>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
      <tr>
          <td class="field"><p>Direktor </p></td>
          <td class="value"><p id="principal" name="principal" type="text"><?php echo $p->principal;?></p><img src="../pildid/edit.png" onclick="changeYearValue('principal')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>Alustamine </p></td>
          <td class="value"><p id="start_year" name="start_year" type="text"><?=$p->start_year;?></p><img src="../pildid/edit.png" onclick="changeYearValue('start_year')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>Lõppetamine </p></td>
          <td class="value"><p id="end_year" name="end_year" type="text"><?=$p->end_year;?></p><img src="../pildid/edit.png" onclick="changeYearValue('end_year')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
      <td colspan="2" class="submit"><input type="submit" name="update" value="Salvesta"></td>
      </tr>

      </form>
    </tbody>
    </table>
<a href="?principal=<?=$_GET["principal"];?>&delete=true">kustuta</a>
    </body>
    </html>
