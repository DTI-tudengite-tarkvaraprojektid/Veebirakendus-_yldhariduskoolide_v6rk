<?php

    if(!isset($_GET["school"])){ die(); }
    require ('../functions.php');
    $schoolname = (string)$_GET["school"];
    //echo $schoolname;
    
    $stmt = $mysqli->prepare("SELECT id FROM s_schools WHERE name = ? ");
    $stmt->bind_param("s", $schoolname);
    $stmt->bind_result($regid);
    $stmt->execute();
    $stmt->fetch();
    echo $regid;

?>