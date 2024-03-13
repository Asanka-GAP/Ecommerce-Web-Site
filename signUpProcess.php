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
} else if (strlen($fname) > 45) {
    echo ("First name must contain LOWER THAN 45 Characters.");
} else if (empty($lname)) {
    echo ("Please enter your Last Name.");
} else if (strlen($lname) > 45) {
    echo ("Last name must contain LOWER THAN 45 Characters.");
} else if (empty($email)) {
    echo ("Please enter your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Email Address must contain LOWER THAN 100 Characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
} else if (empty($password)) {
    echo ("Please enter your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("The Password must contain 5 to 20 Characters.");
} else if (empty($mobile)) {
    echo ("Please enter your Mobile Number.");
} else if (strlen($mobile) != 10) {
    echo ("Mobile Numbers must contain 10 Characters.");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo ("Invalid Mobile Number.");
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' OR `mobile`='" . $mobile . "' ");
    $n = $rs->num_rows;

    if ($n > 0) {
        echo ("User with the same Email Address or Mobile Number already exists");
    } else {
       $d = new DateTime();
       $tz = new DateTimeZone("Asia/Colombo");
       $d->setTimezone($tz);
       $date= $d->format("Y-m-d H:i:s");

       Database::iud("INSERT INTO `user`(`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`status`,`gender_id`) VALUES 
       ('".$fname."','".$lname."','".$email."','".$password."','".$mobile."','".$date."','1','".$gender."')");

        echo("Success");
    }
}

?>
