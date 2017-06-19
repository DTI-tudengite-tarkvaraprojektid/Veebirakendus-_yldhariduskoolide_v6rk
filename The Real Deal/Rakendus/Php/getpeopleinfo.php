<?php
    if(!isset($_GET["regid"])){ die(); }
    require ('../functions.php');
    $regID = (string)$_GET["regid"];

    $stmt = $mysqli->prepare("SELECT MAX(year) AS testikas FROM s_data WHERE REG_ID = ?");
    $stmt->bind_param("i", $regID);
    $stmt->bind_result($yearend);
    $stmt->execute();      
    $stmt->fetch();
    $yearend;
    $stmt->close();

    $stmt = $mysqli->prepare("SELECT MIN(year) AS testikas FROM s_data WHERE REG_ID = ?");
    $stmt->bind_param("i", $regID);
    $stmt->bind_result($yearstart);
    $stmt->execute();      
    $stmt->fetch();
    $yearstart;
    $stmt->close();

	$count = false;	
    $stmt = $mysqli->prepare("SELECT students FROM s_data WHERE REG_ID = ? ORDER by year");
    $stmt->bind_param("i", $regID);
    $stmt->bind_result($students);
    $stmt->execute();
    $yearstart = substr($yearstart, 0, 4);
    $v="[".$yearstart.", ";
    //.$yearend.", ";
    //$v="[";
    while($stmt->fetch()){
        if($count == true){
            if( $students == null ){
                $v.=", 0";
            }else{
            $v.=", ".$students;
            }
        }else{
            $count = true;
            if( $students == null ){
                $v.="0";
            }else{
            $v.=$students;
            }
        }

    }
    $v.="]";

    echo $v;
    $stmt->close();

    //echo json_encode($v);
?>