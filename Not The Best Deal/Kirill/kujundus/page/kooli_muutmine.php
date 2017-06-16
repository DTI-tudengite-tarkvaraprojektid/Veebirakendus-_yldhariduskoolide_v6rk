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

        var_dump($_POST);

        $id = $Helper->cleanInput($_POST["id"]);
        $name = $Helper->cleanInput($_POST["name"]);
		$type = $Helper->cleanInput($_POST["type"]);
		$county = $Helper->cleanInput($_POST["county"]);
		$city = $Helper->cleanInput($_POST["city"]);
        $parish = $Helper->cleanInput($_POST["parish"]);
		$address = $Helper->cleanInput($_POST["address"]);
		$postcode = $Helper->cleanInput($_POST["postcode"]);
		$webpage = $Helper->cleanInput($_POST["webpage"]);

		$Event->updatePerson($id, $name, $type, $county, $city, $parish, $address, $postcode, $webpage);

		header("Location: a_otsing.php?id=".$_POST["id"]."&success=true");
        exit();

	}

    if(isset($_POST["id"])){
        $p = $Event->getSinglePerosonData($_POST["id"]);
    }else{
	    $p = $Event->getSinglePerosonData($_GET["id"]);
    }


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
          <td class="field"><p>KOOLI NIMI </p></td>
          <td class="value"><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"><input type="hidden" name="name" id="nameInput" value="<?php echo $p->name;?>"><p id="name" name="name" type="text"><?php echo $p->name;?></p><img src="../pildid/edit.png" onclick="changeValue('name')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>KOOLI TÜÜP </p></td>
          <td class="value"><input type="hidden" name="type" id="typeInput" value="<?php echo $p->type;?>"><p id="type" name="type" type="text"><?php echo $p->type;?></p><img src="../pildid/edit.png" onclick="changeValue('type')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>MAAKOND </p></td>
          <td class="value"><input type="hidden" name="county" id="countyInput" value="<?php echo $p->county;?>"><p id="county" name="county" type="text"><?php echo $p->county;?></p><img src="../pildid/edit.png" onclick="changeValue('county')" alt="Edit symbol" class="edit"></td>
      </tr>
    	<tr>
          <td class="field"><p>VALD/LINN </p></td>
          <td class="value"><input type="hidden" name="city" id="cityInput" value="<?php echo $p->city;?>"><p id="city" name="city" type="text"><?php echo $p->city;?></p><img src="../pildid/edit.png" onclick="changeValue('city')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>ALEVIK/LINNAOSA </p></td>
          <td class="value"><input type="hidden" name="parish" id="parishInput" value="<?php echo $p->parish;?>"><p id="parish" name="parish" type="text"><?php echo $p->parish;?></p><img src="../pildid/edit.png" onclick="changeValue('parish')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>ADDRESS </p></td>
          <td class="value"><input type="hidden" name="address" id="addressInput" value="<?php echo $p->address;?>"><p id="address" name="address" type="text"><?php echo $p->address;?></p><img src="../pildid/edit.png" onclick="changeValue('address')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>POSTCODE </p></td>
          <td class="value"><input type="hidden" name="postcode" id="postcodeInput" value="<?php echo $p->postcode;?>"><p id="postcode" name="postcode" type="text"><?php echo $p->postcode;?></p><img src="../pildid/edit.png" onclick="changeValue('postcode')" alt="Edit symbol" class="edit"></td>
      </tr>
      <tr>
          <td class="field"><p>WEBPAGE </p></td>
          <td class="value"><input type="hidden" name="webpage" id="webpageInput" value="<?php echo $p->webpage;?>"><p id="webpage" name="webpage" type="text"><?php echo $p->webpage;?></p><img src="../pildid/edit.png" onclick="changeValue('webpage')" alt="Edit symbol" class="edit"></td>
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
