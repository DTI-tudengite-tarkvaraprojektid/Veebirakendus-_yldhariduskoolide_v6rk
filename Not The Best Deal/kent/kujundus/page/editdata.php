<?php
	//edit.php
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



	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){

		$Event->updatePersonData($Helper->cleanInput($_POST["id"]), $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes);

		header("Location: a_koolileht.php?id=".$_POST["id"]."&success=true");
        exit();

	}

	//saadan kaasa id
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

    <table id="content" class="smaller">
    <tbody>
    
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
      <tr>
          <td class="field"><p>Õppeaasta </p></td>
          <td class="value"><p id="year" name="year" type="text"><?php echo $p->year;?></p><img src="../pildid/edit.png" onclick="changeYearValue('year')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>Õpilaste arv </p></td>
          <td class="value"><p id="students" name="students" type="text"><?=$p->students;?></p><img src="../pildid/edit.png" onclick="changeYearValue('students')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>Poiste arv </p></td>
          <td class="value"><p id="boys" name="boys" type="text"><?=$p->boys;?></p><img src="../pildid/edit.png" onclick="changeYearValue('boys')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>Tüdrukute arv </p></td>
          <td class="value"><p id="girls" name="girls" type="text"><?=$p->girls;?></p><img src="../pildid/edit.png" onclick="changeYearValue('girls')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>Õpetajate arv </p></td>
          <td class="value"><p id="teachers" name="teachers" type="text"><?=$p->teachers;?></p><img src="../pildid/edit.png" onclick="changeYearValue('teachers')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>Õppekeel </p></td>
          <td class="value"><p id="language" name="language" type="text"><?=$p->language;?></p><img src="../pildid/edit.png" onclick="changeYearValue('language')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>Märkused </p></td>
          <td class="value"><p id="notes" name="notes" type="text"><?=$p->notes;?></p><img src="../pildid/edit.png" onclick="changeYearValue('notes')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
      <td colspan="2" class="submit"><input type="submit" name="update" value="Salvesta"></td>
      </tr>
      
      </form>
    </tbody>
    </table>
<a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>
    </body>
    </html>
