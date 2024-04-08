<?php

include "connection.php";

$bid = $_GET["bid"];

$model_rs = Database::search("SELECT * FROM `model_has_brand` INNER JOIN `model` ON
model_has_brand.model_model_id=model.model_id WHERE `brand_brand_id`='".$bid."'");

$model_num = $model_rs->num_rows;

for ($i=0; $i <$model_num; $i++) { 
    $model_data = $model_rs->fetch_assoc();
    ?>
    
    <option value="<?php echo $model_data["model_id"]?>">
    <?php echo $model_data["model_name"];?>
</option>
    
    <?php
}

?>