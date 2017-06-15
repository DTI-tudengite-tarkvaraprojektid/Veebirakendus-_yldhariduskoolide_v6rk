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
  <a href="a_avaleht.html"><button class="buttons">AVALEHT</button></a>
  <a href="a_otsing.php"><button class="buttons"> OTSING</button></a>
  <a href="lisamine.php"><button class="buttons">LISAMINE</button></a>

    <table id="content">
    <tbody>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
      <tr>
          <td class="field"><p>Aasta </p></td>
          <td class="value"><p id="year" name="year" type="text"><?php echo $p->year;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
    	<tr>
          <td class="field"><p>Opilased </p></td>
          <td class="value"><p id="type" name="type" type="text"><?=$p->students;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
    	<tr>
          <td class="field"><p>Mehed </p></td>
          <td class="value"><p id="county" name="county" type="text"><?=$p->boys;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
    	<tr>
          <td class="field"><p>Naised </p></td>
          <td class="value"><p id="city" name="city" type="text"><?=$p->girls;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
      <tr>
          <td class="field"><p>Opetajad </p></td>
          <td class="value"><p id="parish" name="parish" type="text"><?=$p->teachers;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
      <tr>
          <td class="field"><p>Keel </p></td>
          <td class="value"><p id="address" name="address" type="text"><?=$p->language;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
      <tr>
          <td class="field"><p>Notes </p></td>
          <td class="value"><p id="postcode" name="postcode" type="text"><?=$p->notes;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>

      </form>
    </tbody>
    </table>
<input type="submit" class="buttons" name="update" value="Salvesta">
<a class="buttons" href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>
    </body>
    </html>
