<?php

include "connection.php";

$cid = $_GET["cid"];

$brand_rs = DataBase::search("SELECT * FROM `brand` WHERE `category_cat_id`='".$cid."'");
$brand_num = $brand_rs->num_rows;

for ($i=0; $i <$brand_num ; $i++) { 
    $brand_data = $brand_rs->fetch_assoc();
    
    ?>

<option value="<?php echo $brand_data["brand_id"];?>">
    <?php echo $brand_data["brand_name"];?>
</option>

<?php

}

?>