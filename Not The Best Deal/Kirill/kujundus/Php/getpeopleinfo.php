<?php
    if(!isset($_GET["regid"])){ die(); }
    require ('../functions.php');
    $regID = (string)$_GET["regid"];;
	$count = false;	
    $stmt = $mysqli->prepare("SELECT students FROM s_data WHERE REG_ID = ? ORDER by year");
    $stmt->bind_param("i", $regID);
    $stmt->bind_result($students);
    $stmt->execute();
    $v="[";
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
    //echo json_encode($v);
?>