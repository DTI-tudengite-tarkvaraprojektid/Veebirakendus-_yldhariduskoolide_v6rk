<?php
    if(!isset($_GET["REG_ID"])){ die(); }
    require ('../functions.php');
    $REG_ID = (int)$_GET["REG_ID"];
    $stmt = $mysqli->prepare("SELECT b.name, b.county, b.parish, b.address, b.webpage, a.year AS year_open FROM s_founded a, s_schools b WHERE a.REG_ID=? AND b.id=?");
    $stmt->bind_param('ii', $REG_ID, $REG_ID);
    $stmt->bind_result($schoolname, $county, $parish, $address, $webpage, $openyear);
    $stmt->execute();
    $schools = array();
    while ($stmt->fetch()){
        $o = new StdClass();
        $o->name = $schoolname;
        $o->county = $county;
        $o->parish = $parish;
        $o->address = $address;
        $o->webpage = $webpage;
        $o->openyear = $openyear;
        array_push($schools, $o);
    }
    echo json_encode($schools);
?>

