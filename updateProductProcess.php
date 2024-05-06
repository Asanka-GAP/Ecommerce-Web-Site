<?php

session_start();
include "connection.php";

if (isset($_POST["p"])) {
    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["d1"];
    $doc = $_POST["d2"];
    $description = $_POST["d3"];
    $pid = $_POST["p"];

    Database::iud("UPDATE `product` SET `title`='".$title."',`qty`='".$qty."',`delivery_fee_colombo`='".$dwc."',`delivery_frr_other`='".$doc."',`description`='".$description."' WHERE `id`='".$pid."'");
    
    echo("Product Updated.");

    $length = sizeof($_FILES);

if ($length <= 3 && $length > 0) {

    $allowed_img_extentions = array("image/jpeg", "image/png", "image/svg+xml");

    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='".$pid."'");
    $img_num = $img_rs->num_rows;

    for ($i=0; $i <$img_num ; $i++) { 
        $img_data = $img_rs->fetch_assoc();
        unlink($img_data["path"]);
        Database::iud("DELETE FROM `product_img` WHERE `path`='".$img_data["path"]."' AND `product_id`='".$pid."'");
    }
    
    for ($x = 0; $x < $length; $x++) {
        if (isset($_FILES["i" . $x])) {

            $image_file = $_FILES["i" . $x];
            $img_type = $image_file["type"];

            if (in_array($img_type, $allowed_img_extentions)) {

                $new_img_extension;

                if ($img_type == "image/jpeg") {
                    $new_img_extension = ".jpeg";
                } else if ($img_type == "image/png") {
                    $new_img_extension = ".png";
                } else if ($img_type == "image/svg+xml") {
                    $new_img_extension = ".svg";
                }

                $file_name = "resources//mobile_images//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                move_uploaded_file($image_file["tmp_name"], $file_name);

                Database::iud("INSERT INTO `product_img`(`path`,`product_id`) VALUES 
                ('" . $file_name . "','" . $pid . "')");

                echo ("success");
            } else {
                echo ("Invalid image type.");
            }
        }
    }
} else {
    echo ("Invalid Image Count");
}
    
}else{
    echo("Something Went Wrong");
}
?>