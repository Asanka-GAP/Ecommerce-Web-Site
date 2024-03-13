<?php
include "connection.php";
$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

if (empty($fname)) {
    echo ("Please enter your First Name.");
}else if(strlen($fname)>45){
    echo("First name must contain LOWER THAN 45 Characters.");
}else if (empty($lname)) {
    echo ("Please enter your Last Name.");
}else if(strlen($lname)>45){
    echo("Last name must contain LOWER THAN 45 Characters.");
}
?>