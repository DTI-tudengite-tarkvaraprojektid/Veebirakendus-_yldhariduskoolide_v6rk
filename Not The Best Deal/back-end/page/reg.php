<?php
	var_dump($_POST);
	var_dump(isset($_POST["signupEmail"]));


	require("../functions.php");

    require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/User.class.php");
	$User = new User($mysqli);

	//var_dump($_GET);

	//echo "<br>";

	//var_dump($_POST);

	//MUUTUJAD
	$signupEmailError = "*";
	$signupEmail = "";

	//kas keegi vajutas nuppu ja see on olemas

	if (isset ($_POST["signupEmail"])) {

		//on olemas
		// kas epost on tuhi
		if (empty ($_POST["signupEmail"])) {

			// on tuhi
			$signupEmailError = "* Vali on kohustuslik!";

		} else {
			// email on olemas ja oige
			$signupEmail = $_POST["signupEmail"];

		}

	}

	$signupPasswordError = "*";

	if (isset ($_POST["signupPassword"])) {

		if (empty ($_POST["signupPassword"])) {

			$signupPasswordError = "* Vali on kohustuslik!";

		} else {

			// parool ei olnud tuhi

			if ( strlen($_POST["signupPassword"]) < 8 ) {

				$signupPasswordError = "* Parool peab olema vahemalt 8 tahemarkki pikk!";

			}

		}

		/* GENDER */

		if (!isset ($_POST["gender"])) {

			//error
		}else {
			// annad vaartuse
		}

	}



	if ( $signupEmailError == "*" AND
		 $signupPasswordError == "*" &&
		 isset($_POST["signupEmail"]) &&
		 isset($_POST["signupPassword"])
	  ) {

		//vigu ei olnud, koik on olemas
		echo "Salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";

		$password = hash("sha512", $_POST["signupPassword"]);

		echo $password."<br>";

		$User->signup($signupEmail, $password);


	}

?>

<div class="container">
	<div class="row">


		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">

			<h1>Loo kasutaja</h1>

			<form method="POST" >

				<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>

				<br><br>

				<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?>

				<br><br>

				<input type="submit" value="Loo kasutaja">

			</form>

		</div>
	</div>
</div>
