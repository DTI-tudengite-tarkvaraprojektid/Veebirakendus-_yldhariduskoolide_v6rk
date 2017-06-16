<?php

    if(!isset($_GET["REG_ID"])){ die(); }
    require ('../functions.php');
    $REG_ID = (int)$_GET["REG_ID"];
    $stmt = $mysqli->prepare("SELECT principal, start_year, end_year FROM s_principals WHERE REG_ID = ? AND deleted is NULL ORDER BY start_year");
    $stmt->bind_param('i', $REG_ID);
    $stmt->bind_result($principal, $start, $end);
    $stmt->execute();
    $pricipals = array();
    while ($stmt->fetch()){
        $o = new StdClass();
        $o->principal = $principal;
        $o->start = $start;
        $o->end = $end;
        array_push($pricipals, $o);
    }
    echo json_encode($pricipals);
?>