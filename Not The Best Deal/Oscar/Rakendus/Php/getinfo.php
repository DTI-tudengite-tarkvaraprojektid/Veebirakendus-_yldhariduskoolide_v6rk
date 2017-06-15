<?php
    if(!isset($_GET["school"])){ die(); }
    require ('../functions.php');
    $schoolname = (string)$_GET["school"];
    //echo $schoolname;
    /*$database = "if16_Oscar";	
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
    $mysqli->set_charset("utf8");*/
    $stmt = $mysqli->prepare("SELECT county, parish, address, webpage FROM s_schools WHERE name = ?");
    $stmt->bind_param('s', $schoolname);
    $stmt->bind_result($county, $parish, $address, $webpage);
    $stmt->execute();
    $schools = array();
    while ($stmt->fetch()){
        $o = new StdClass();
        $o->name = $schoolname;
        $o->county = $county;
        $o->parish = $parish;
        $o->address = $address;
        $o->webpage = $webpage;
        array_push($schools, $o);
    }
    echo json_encode($schools);
?>

