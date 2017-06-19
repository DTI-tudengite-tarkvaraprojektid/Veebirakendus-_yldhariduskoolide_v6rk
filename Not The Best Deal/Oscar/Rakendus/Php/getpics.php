<?php
    if(!isset($_GET["REG_ID"])){ die(); }
    require ('../functions.php');
    $REG_ID = (int)$_GET["REG_ID"];
    $stmt = $mysqli->prepare("SELECT name, pic_nr, link FROM `s_pic` WHERE REG_ID=? ORDER BY pic_nr");
    $stmt->bind_param('i', $REG_ID);
    $stmt->bind_result($name, $pic_nr, $link);
    $stmt->execute();
    $pics = array();
    while ($stmt->fetch()){
        $o = new StdClass();
        $o->name = $name;
        $o->pic_nr = $pic_nr;
        $o->link = $link;
        array_push($pics, $o);
    }
    echo json_encode($pics);
?>