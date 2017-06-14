<?php
	//ühendan sessiooniga
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	//kui ei ole sisseloginud, suunan login lehele
	if (!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	//kas aadressireal on logout
	if (isset($_GET["logout"])) {

		session_destroy();

		header("Location: login.php");
		exit();

	}


	if ( isset($_POST["name"]) &&
		 isset($_POST["type"]) &&
		 isset($_POST["county"]) &&
		 isset($_POST["city"]) &&
		 isset($_POST["address"]) &&
		 isset($_POST["webpage"]) &&
		 !empty($_POST["name"]) &&
		 !empty($_POST["type"]) &&
		 !empty($_POST["county"]) &&
		 !empty($_POST["city"]) &&
		 !empty($_POST["address"]) &&
		 !empty($_POST["webpage"])
	) {


		$name = $Helper->cleanInput($_POST["name"]);
		$type = $Helper->cleanInput($_POST["type"]);
		$county = $Helper->cleanInput($_POST["county"]);
		$city = $Helper->cleanInput($_POST["city"]);
		$address = $Helper->cleanInput($_POST["address"]);

		$Event->saveEvent($Helper->cleanInput($_POST["webpage"]), $name, $type, $county, $city, $address );
	}

	// otsib
	if (isset($_GET["q"])) {

		$q = $_GET["q"];

	} else {
		//ei otsi
		$q = "";
	}

	//vaikimisi, kui keegi mingit linki ei vajuta
	$sort = "id";
	$order = "ASC";

	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}

	$people = $Event->getAllPeople($q, $sort, $order);


?>

<h1>Admin panel</h1>


<p>
	Tere tulemast <?=$_SESSION["userEmail"];?></a>!
	<a href="?logout=1">logi välja</a>
</p>

<h2>Salvesta sündmus</h2>
<form method="POST" >

	<label>Kooli nimi</label><br>
	<input name="name" type="text">

	<br><br>
	<label>Tüüp</label><br>
	<input name="type" type="text">

	<br><br>
	<label>Riik</label><br>
	<input name="county" type="text">

	<br><br>
	<label>Linn</label><br>
	<input name="city" type="text">

	<br><br>
	<label>Address</label><br>
	<input name="address" type="text">

	<br><br>
	<label>Veebileht</label><br>
	<input name="webpage" type="text">

	<br><br>

	<input type="submit" value="Salvesta">

</form>


<h2>Koolid</h2>

<form>
	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Otsi">
</form>

<?php


	$html = "<table class='table table-striped table-condensed'>";

		$html .= "<tr>";

			$orderId = "ASC";
			$arr="&darr;";
			if (isset($_GET["order"]) &&
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "id" ) {

				$orderId = "DESC";
				$arr="&uarr;";
			}

			$html .= "<th>
						<a href='?q=".$q."&sort=id&order=".$orderId."'>
							ID ".$arr."
						</a>
					 </th>";


			$orderName = "ASC";
			if (isset($_GET["order"]) &&
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "name" ) {

				$orderName = "DESC";
			}

			$html .= "<th>
						<a href='?q=".$q."&sort=name&order=".$orderName."'>
							Kooli nimi
						</a>
					 </th>";

			$orderType = "ASC";
			if (isset($_GET["order"]) &&
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "type" ) {

				$orderType = "DESC";
			}

			$html .= "<th>
						<a href='?q=".$q."&sort=type&order=".$orderType."'>
							Tüüp
						</a>
					 </th>";

			$orderCounty = "ASC";
			if (isset($_GET["order"]) &&
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "county" ) {

				$orderCounty = "DESC";
			}

			$html .= "<th>
						<a href='?q=".$q."&sort=county&order=".$orderCounty."'>
							Riik
						</a>
					 </th>";

			$orderCity = "ASC";
			if (isset($_GET["order"]) &&
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "city" ) {

				$orderCity = "DESC";
			}

			$html .= "<th>
						<a href='?q=".$q."&sort=city&order=".$orderCity."'>
							Linn
						</a>
					 </th>";

			$orderAddress = "ASC";
			if (isset($_GET["order"]) &&
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "address" ) {

				$orderAddress = "DESC";
			}

			$html .= "<th>
						<a href='?q=".$q."&sort=address&order=".$orderAddress."'>
							Address
						</a>
					 </th>";

			$orderWebpage = "ASC";
			if (isset($_GET["order"]) &&
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "webpage" ) {

				$orderWebpage = "DESC";
			}

			$html .= "<th>
						<a href='?q=".$q."&sort=webpage&order=".$orderWebpage."'>
							Veebileht
						</a>
					 </th>";


			$html .= "<th>Edit</th>";

		$html .= "</tr>";

		//iga liikme kohta massiivis
		foreach ($people as $p) {

			$html .= "<tr>";
				$html .= "<td>".$p->id."</td>";
				$html .= "<td>".$p->name."</td>";
				$html .= "<td>".$p->type."</td>";
				$html .= "<td>".$p->county."</td>";
				$html .= "<td>".$p->city."</td>";
				$html .= "<td>".$p->address."</td>";
				$html .= "<td>".$p->webpage."</td>";
                $html .= "<td>
							<a class='btn btn-default btn-xs' href='edit.php?id=".$p->id."'>
								<span class='glyphicon glyphicon-pencil'></span> Muuda
							</a>
						  </td>";

			$html .= "</tr>";

		}

	$html .= "</table>";

	echo $html;

?>
