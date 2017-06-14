<?php
	//edit.php
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	if(isset($_GET["delete"])){
		$Event->deletePerson($_GET["id"]);
		header("Location: data.php");
		exit();
	}



	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){

		$Event->updatePerson($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["name"]), $Helper->cleanInput($_POST["type"]), $Helper->cleanInput($_POST["county"]), $Helper->cleanInput($_POST["parish"]),$Helper->cleanInput($_POST["city"]), $Helper->cleanInput($_POST["address"]),$Helper->cleanInput($_POST["postcode"]), $Helper->cleanInput($_POST["webpage"]));

		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();

	}

	//saadan kaasa id
	$p = $Event->getSinglePerosonData($_GET["id"]);
	var_dump($p);


?>
<br><br>
<a href="data.php"> tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" >
  	<label for="name" >Kooli nimi</label><br>
	<input id="name" name="name" type="text" value="<?php echo $p->name;?>" ><br><br>
  	<label for="type" >Tüüp</label><br>
	<input id="type" name="type" type="text" value="<?=$p->type;?>"><br><br>
	<label for="county" >Maakond</label><br>
	<input id="county" name="county" type="text" value="<?=$p->county;?>"><br><br>
	<label for="city" >Linn</label><br>
	<input id="city" name="city" type="text" value="<?=$p->city;?>"><br><br>
	<label for="parish" >Linna osa</label><br>
	<input id="parish" name="parish" type="text" value="<?=$p->parish;?>"><br><br>
	<label for="address" >Address</label><br>
	<input id="address" name="address" type="text" value="<?=$p->address;?>"><br><br>
	<label for="postcode" >Postcode</label><br>
	<input id="postcode" name="postcode" type="text" value="<?=$p->postcode;?>"><br><br>
	<label for="webpage" >Veebileht</label><br>
	<input id="webpage" name="webpage" type="text" value="<?=$p->webpage;?>"><br><br>

	<input type="submit" name="update" value="Salvesta">
  </form>


  <a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>
