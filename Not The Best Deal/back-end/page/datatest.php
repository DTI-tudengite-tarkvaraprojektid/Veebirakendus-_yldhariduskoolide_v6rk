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

	// otsib
	if (isset($_GET["q"])) {

		$q = $_GET["q"];

	}
	else {
		//ei otsi
		$q = "";
	}
	// otsib
	if (isset($_GET["e"])) {
		$e = $_GET["e"];
	}
	else {
		//ei otsi
		$e = "";
	}
	// otsib
	if (isset($_GET["r"])) {
		$r = $_GET["r"];
	}
	else {
		//ei otsi
		$r = "";
	}
	// otsib
	if (isset($_GET["y"])) {
		$y = $_GET["y"];
	}
	else {
		//ei otsi
		$y = "";
	}

	//vaikimisi, kui keegi mingit linki ei vajuta
	$sort = "id";
	$order = "ASC";

	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}

	$people = $Event->getAllPeople($q, $sort, $order, $e, $r, $y);


?>

<h1>Admin panel</h1>


<p>
	Tere tulemast <?=$_SESSION["userEmail"];?></a>!
	<a href="?logout=1">logi välja</a>
</p>


<h2>Koolid</h2>
<a class="btn btn-primary btn-sm hidden-xs" href="dataadd.php">Lisa kool</a>
<br><br>

<form>
	<input type="search" placeholder="Nimi" name="q" value="<?=$q;?>">
	<input type="search" placeholder="Maakond" name="e" value="<?=$e;?>">
	<input type="search" placeholder="Linna osa" name="r" value="<?=$r;?>">
	<input type="search" placeholder="Linn" name="y" value="<?=$y;?>">
	<input type="submit" value="Otsi">
	<input type="reset" value="Kustuta">

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


			$html .= "<th>Edit</th>";

		$html .= "</tr>";

		//iga liikme kohta massiivis
		foreach ($people as $p) {

			$html .= "<tr>";
				$html .= "<td>".$p->id."</td>";
                $html .= "<td>
							<a class='btn btn-default btn-xs' href='edit.php?id=".$p->id."'>
								<span class='glyphicon glyphicon-pencil'></span> Muuda
							</a>
						  </td>";

			$html .= "</tr>";

		}

	$html .= "</table>";

	echo $orderName;

?>
