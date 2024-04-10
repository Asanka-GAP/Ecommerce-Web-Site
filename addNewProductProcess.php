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

    $length = sizeof($_FILES);
    if ($length<=3 && $length>0) {
        
        $allowed_img_extensions = array("image/jpeg","image/png","image/svg+xml");
        
        for ($i=0; $i <$length ; $i++) { 
            if (isset($_FILES["image".$i])) {
                
                $image_file = $_FILES["image".$i];
                $img_type = $image_file["type"];

                if (in_array($img_type,$allowed_img_extensions)) {

                    $new_img_extension;

                if($img_type == "image/jpeg"){
                    $new_img_extension = ".jpeg";
                }else if($img_type == "image/png"){
                    $new_img_extension = ".png";
                }else if($img_type == "image/svg+xml"){
                    $new_img_extension = ".svg";
                }

                $file_name = "resources//mobile_images//".$title."_".$i."_".uniqid().$new_img_extension;
                move_uploaded_file($image_file["tmp_name"],$file_name);

                Database::iud("INSERT INTO `product_img`(`path`,`product_id`) VALUES ('".$file_name."','".$product_id."')");
                
                echo("success");
                    
                }else {
                    echo("Invalid image type");
                }
            }
        }
        
    }else{
        echo("Invalid Image Count");
    }
    
    

?>