<?php
//if(!isset($_GET["REG_ID"])){ die(); }
require ('../functions.php');
$piclocation = "http://greeny.cs.tlu.ee/~oaheinla/Praktika/Veebirakendus-_yldhariduskoolide_v6rk/Not%20The%20Best%20Deal/Oscar/Pildi_upload/";
$target_dir = "../upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "fail on pilt - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "fail ei ole pilt.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sellise nimegas fail on juba olemas.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Pilt on liiga suur.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "vale pildiformaat, lubatud on JPG, JPEG ja PNG formaadid.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Pildi laadimine ei õnnestunud.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $link=$target_file;
        $pic_nr =  $_POST['picnr'];
        $REG_ID = $_POST["REG_ID"];
        $name = $_POST['picname'];
        $stmt = $mysqli->prepare("INSERT INTO s_pic(REG_ID, pic_nr, link, name) VALUE (?, ?, ?, ?)");
        $stmt->bind_param('iiss', $REG_ID, $pic_nr, $link, $name);
        if ( $stmt->execute() ) {
            echo "Pilt nimega ". basename( $_FILES["fileToUpload"]["name"]). " salvestamine õnnestus.<br>".$piclocation.$target_file;
        }else{
            echo "ERROR".$stmt->error;
        }
                
    } else {
        echo "Pildi laadimine ei õnnestunud.";
    }
}
?>