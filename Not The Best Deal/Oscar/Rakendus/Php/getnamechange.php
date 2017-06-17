<?php
    if(!isset($_GET["REG_ID"])){ die(); }
     require ('../functions.php');
    $REG_ID = (int)$_GET["REG_ID"];
    $stmt = $mysqli->prepare("SELECT name, year FROM `s_names` WHERE REG_ID=? ORDER BY year");
    $stmt->bind_param('i', $REG_ID);
    $stmt->bind_result($name, $year);
    $stmt->execute();
    $namehange = array();
    while ($stmt->fetch()){
        $o = new StdClass();
        $o->year = $year;
        $o->name = $name;
        array_push($namehange, $o);
    }
    echo json_encode($namehange);
?>