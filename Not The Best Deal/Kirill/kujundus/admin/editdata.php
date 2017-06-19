<?php
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	if(isset($_GET["delete"])){
		$Event->deletePersonData($_GET["id"]);
		header("Location: a_otsing.php");
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
    $id = $Helper->cleanInput($_POST["id"]);
    $year = $Helper->cleanInput($_POST["year"]);
		$students = $Helper->cleanInput($_POST["students"]);
		$boys = $Helper->cleanInput($_POST["boys"]);
		$girls = $Helper->cleanInput($_POST["girls"]);
    $teachers = $Helper->cleanInput($_POST["teachers"]);
		$language = $Helper->cleanInput($_POST["language"]);
		$notes = $Helper->cleanInput($_POST["notes"]);

echo $id;
		$Event->updatePersonData($id, $year, $students, $boys, $girls, $teachers, $language, $notes);

		header("Location: aasta_muutmine.php?q=".$_POST["id"]."&success=true");
        exit();

	}

	$p = $Event->getSinglePerosonDataData($_GET["id"]);


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
          <td class="field"><p>Õppeaasta </p></td>
          <td class="value"><input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
					<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
          <input type="hidden" name="year" id="yearInput" value="<?php echo $p->year;?>">
          <p id="year" name="year" type="text"><?php echo $p->year;?></p><img src="../pildid/edit.png" onclick="changeYearValue('year')" alt="Edit symbol" class="edit">

      </tr>
    	<tr>
          <td class="field"><p>Õpilaste arv </p></td>
          <td class="value"><input type="hidden" name="students" id="studentsInput" value="<?php echo $p->students;?>"><p id="students" name="students" type="text"><?=$p->students;?></p><img src="../pildid/edit.png" onclick="changeYearValue('students')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>Poiste arv </p></td>
          <td class="value"><input type="hidden" name="boys" id="boysInput" value="<?php echo $p->boys;?>"><p id="boys" name="boys" type="text"><?=$p->boys;?></p><img src="../pildid/edit.png" onclick="changeYearValue('boys')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>Tüdrukute arv </p></td>
          <td class="value"><input type="hidden" name="girls" id="girlsInput" value="<?php echo $p->girls;?>"><p id="girls" name="girls" type="text"><?=$p->girls;?></p><img src="../pildid/edit.png" onclick="changeYearValue('girls')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>Õpetajate arv </p></td>
          <td class="value"><input type="hidden" name="teachers" id="teachersInput" value="<?php echo $p->teachers;?>"><p id="teachers" name="teachers" type="text"><?=$p->teachers;?></p><img src="../pildid/edit.png" onclick="changeYearValue('teachers')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>Õppekeel </p></td>
          <td class="value"><input type="hidden" name="language" id="languageInput" value="<?php echo $p->language;?>"><p id="language" name="language" type="text"><?=$p->language;?></p><img src="../pildid/edit.png" onclick="changeYearValue('language')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>Märkused </p></td>
          <td class="value"><input type="hidden" name="notes" id="notesInput" value="<?php echo $p->notes;?>"><p id="notes" name="notes" type="text"><?=$p->notes;?></p><img src="../pildid/edit.png" onclick="changeYearValue('notes')" alt="Edit symbol" class="edit"></td>
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
