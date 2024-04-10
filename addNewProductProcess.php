<?php

    session_start();
    include "connection.php";
    
    $email = $_SESSION["u"]["email"];
    
    $category = $_POST["ca"];
    $brand = $_POST["b"];
    $model = $_POST["m"];
    $title = $_POST["t"];
    $condition = $_POST["con"];
    $clr = $_POST["col"];
    $qty = $_POST["q"];
    $cost = $_POST["co"];
    $doc = $_POST["doc"];
    $dwc = $_POST["dwc"];
    $desc = $_POST["desc"];

    //validations-----------------

    //----------------------------

    
    $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."'");

    $mhb_id;

    if ($mhb_rs->num_rows >0) {
        $mhb_data = $mhb_rs->fetch_assoc();
        $mhb_id = $mhb_data["id"];
    }else{
        Database::iud("INSERT INTO `model_has_brand`(`model_model_id`,`brand_brand_id`)VALUES
        ('".$model."','".$brand."')");
        $mhb_id = Database::$connection->insert_id;

        
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;
    
    Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_frr_other`,`category_cat_id`,`model_has_brand_id`,`condition_condition_id`,`status_status_id`,`user_email`,`color_clr_id`)
    VALUES ('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$dwc."','".$doc."','".$category."','".$mhb_id."','".$condition."','".$status."','".$email."','".$clr."')");
    
    $product_id = Database::$connection->insert_id;

    
    
    

?>