<?php

include "connection.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPmailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");
    $num = $rs->num_rows;

    if ($num == 1) {

        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE `email`='".$email."'");
        
         // email code
         $mail = new PHPMailer;
         $mail->IsSMTP();
         $mail->Host = 'smtp.gmail.com';
         $mail->SMTPAuth = true;
         $mail->Username = 'nuwandilshan830@gmail.com';
         $mail->Password = 'tuuvheqatffvuhkt';
         $mail->SMTPSecure = 'ssl';
         $mail->Port = 465;
         $mail->setFrom('nuwandilshan830@gmail.com', 'eShop Community');
         $mail->addReplyTo('nuwandilshan830@gmail.com', 'eShop Community');
         $mail->addAddress($email);
         $mail->isHTML(true);
         $mail->Subject = 'eShop Forgot Password Verification Code';
         $bodyContent = '<h1 style="color:red;font-family: Segoe UI;">Your Verification Code Is : '.$code.'</h1>';
         $mail->Body    = $bodyContent;

         if (!$mail->send()) {
            echo("Email sent Failed.");
         }else{
            echo("success");
         }



    }else{
        echo("Invalid Email Address.");
    }

}else{
    echo("Please enter your email address in email field.");

}

?>