<?php

include "connection.php";

$clr = $_GET["clr"];

$clr_rs = Database::search("SELECT * FROM `color` WHERE `clr_name` LIKE '%".$clr."%'");
$clr_num = $clr_rs->num_rows;

if($clr_num == 0){

    Database::iud("INSERT INTO `color`(`clr_name`) VALUES ('".$clr."')");
    echo ("saved");

}else{
    echo ("Same or similar color has saved before.");
}

?>