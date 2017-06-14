<?php
	var_dump($_POST);
	var_dump(isset($_POST["signupEmail"]));


	require("../functions.php");

    require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/User.class.php");
	$User = new User($mysqli);

	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}

	$notice = "";
	//kas kasutaja tahab sisse logida
	if ( isset($_POST["loginEmail"]) &&
		 isset($_POST["loginPassword"]) &&
		 !empty($_POST["loginEmail"]) &&
		 !empty($_POST["loginPassword"])
	) {

		$notice = $User->login($_POST["loginEmail"], $_POST["loginPassword"]);

	}

?>

<div class="container">
	<div class="row">

		<div class="col-sm-4 col-md-3">

			<h1>Logi sisse</h1>
			<br>
			<p style="color:red;"><?=$notice;?></p>
			<form method="POST" >


				<div class="form-group">
				<input class="form-control" name="loginEmail" placeholder="E-post" type="email">
				</div>

				<br>

				<div class="form-group">
				<input class="form-control" name="loginPassword" placeholder="Parool" type="password">
				</div>

				<br>

				<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Logi sisse 1">
			</form>
		</div>

	</div>
</div>
