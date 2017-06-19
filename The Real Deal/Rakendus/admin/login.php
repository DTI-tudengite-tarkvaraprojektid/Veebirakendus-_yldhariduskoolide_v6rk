<?php


	require("../functions.php");

    require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/User.class.php");
	$User = new User($mysqli);

	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location: a_otsing.php");
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
<!DOCTYPE html>

<html lang="et">
<head>
        <meta charset="UTF-8">
        <title>Administraatori avaleht</title>
    <link href="../css/normalize.css" rel="stylesheet" type="text/css">
    <link href="../css/stiil.css" rel="stylesheet" type="text/css">
</head>
<body>

 <h3>Adminstraatori lehele sisenemiseks logi sisse</h3>
<table>
<tbody>

 <tr>
      <td class="login">
<div class="container">
    <div class="row">

        <div class="col-sm-4 col-md-3">
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

                <input class="loginbtn" type="submit" value="Logi sisse">
            </form>
        </div>

    </div>
</div>
</td>
  </tr>
</tbody>

</table>


</body>
</html>
