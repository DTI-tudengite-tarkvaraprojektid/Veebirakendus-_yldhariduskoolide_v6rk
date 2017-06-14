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
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
      <tr>
          <td class="field"><p>KOOLI NIMI </p></td>
          <td class="value"><p id="name" name="name" type="text"><?php echo $p->name;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
    	<tr>
          <td class="field"><p>KOOLI TÜÜP </p></td>
          <td class="value"><p id="type" name="type" type="text"><?=$p->type;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
    	<tr>
          <td class="field"><p>MAAKOND </p></td>
          <td class="value"><p id="county" name="county" type="text"><?=$p->county;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
    	<tr>
          <td class="field"><p>VALD/LINN </p></td>
          <td class="value"><p id="city" name="city" type="text"><?=$p->city;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
      <tr>
          <td class="field"><p>ALEVIK/LINNAOSA </p></td>
          <td class="value"><p id="parish" name="parish" type="text"><?=$p->parish;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
      <tr>
          <td class="field"><p>ADDRESS </p></td>
          <td class="value"><p id="address" name="address" type="text"><?=$p->address;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
      <tr>
          <td class="field"><p>POSTCODE </p></td>
          <td class="value"><p id="postcode" name="postcode" type="text"><?=$p->postcode;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>
      <tr>
          <td class="field"><p>WEBPAGE </p></td>
          <td class="value"><p id="webpage" name="webpage" type="text"><?=$p->webpage;?><img src="../pildid/edit.png" onclick="changeValue()" alt="Edit symbol" class="edit"></p></td>
      </tr>

      </form>
    </tbody>
    </table>
<input type="submit" class="buttons" name="update" value="Salvesta">
<a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>
    </body>
    </html>
