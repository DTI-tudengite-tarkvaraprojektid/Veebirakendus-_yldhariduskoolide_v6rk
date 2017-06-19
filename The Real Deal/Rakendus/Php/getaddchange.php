<?php
    if(!isset($_GET["REG_ID"])){ die(); }
     require ('../functions.php');
    $REG_ID = (int)$_GET["REG_ID"];
    $stmt = $mysqli->prepare("SELECT year, address FROM `s_address` WHERE REG_ID=? ORDER BY year");
    $stmt->bind_param('i', $REG_ID);
    $stmt->bind_result($year, $address);
    $stmt->execute();
    $addchange = array();
    while ($stmt->fetch()){
        $o = new StdClass();
        $o->year = $year;
        $o->address = $address;
        array_push($addchange, $o);
    }
    echo json_encode($addchange);
?>