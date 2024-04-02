<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">


            <?php
            include "header.php";
            include "connection.php";

            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];
            ?>
                <div class="col-12 bg-primary">
                    <div class="row">

                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <div class="row g-2">

                                <div class="col-md-3 border-end">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php

                                        $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $email . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                        if (empty($img_data["path"])) {

                                        ?>
                                            <img src="resources/new_user.svg" class="rounded mt-5" style="width: 150px;" />

                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $img_data["path"]; ?>" class="rounded mt-5" style="width: 150px;" />

                                        <?php
                                        }
                                        ?>


                                        <span class="fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                        <span class="fw-bold text-black-50"><?php echo $email; ?></span>

                                        <input type="file" class="d-none" id="profileimage" />
                                        <label for="profileimage" class="btn btn-primary mt-5">Update Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-5 border-end">
                                    <div class="p-3 py-5">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="<?php echo $_SESSION["u"]["fname"] ?>" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" value="<?php echo $_SESSION["u"]["lname"] ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input type="text" class="form-control" value="<?php echo $_SESSION["u"]["mobile"] ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" value="<?php echo $_SESSION["u"]["password"] ?>" readonly />
                                                    <span class="input-group-text bg-primary" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $email ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $_SESSION["u"]["joined_date"] ?>" />
                                            </div>

                                            <?php

                                            $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                                            user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                            city.district_district_id=district.district_id INNER JOIN `province` ON 
                                            district.province_province_id=province.province_id WHERE `user_email`='" . $email . "'");

                                            $address_data = $address_rs->fetch_assoc();



                                            ?>
                                            <div class="col-12">
                                                <label class="form-label">Address Line 01</label>
                                                <?php
                                                if (empty($address_data["line1"])) {
                                                ?>
                                                    <input type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
                                                <?php
                                                }
                                                ?>

                                            </div>



                                            <div class="col-12">
                                                <label class="form-label">Address Line 02</label>

                                                <?php
                                                if (empty($address_data["line2"])) {
                                                ?>
                                                    <input type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" class="form-control" value="<?php echo $address_data["line2"]; ?>" />
                                                <?php
                                                }
                                                ?>

                                            </div>
                                            <?php

                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            ?>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    for ($i = 0; $i < $province_rs->num_rows; $i++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                        if(!empty($address_data["province_id"])){
                                                            if($address_data["province_id"] == $province_data["province_id"]){
                                                                ?>selected<?php
                                                            }
                                                        }
                                                        ?>>
                                                            <?php echo $province_data["province_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    for ($i = 0; $i < $district_rs->num_rows; $i++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                        if(!empty($address_data["district_id"])){
                                                            if($address_data["district_id"] == $district_data["district_id"]){
                                                                ?>selected<?php
                                                            }
                                                        }
                                                        ?>>
                                                            <?php echo $district_data["district_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    for ($i = 0; $i < $city_rs->num_rows; $i++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                        if(!empty($address_data["city_id"])){
                                                            if($address_data["city_id"] == $city_data["city_id"]){
                                                                ?>selected<?php
                                                            }
                                                        }
                                                        ?>>
                                                            <?php echo $city_data["city_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Postal Code</label>
                                                <?php
                                                if(empty($address_data["postal_code"])){
                                                    ?><input type="text" class="form-control" /><?php
                                                }else{
                                                    ?><input type="text" class="form-control" value="<?php echo $address_data["postal_code"] ?>"/><?php
                                                }
                                                ?>
                                                
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <?php
                                                $gender_rs = Database::search("SELECT * FROM `gender` WHERE `id`= '".$_SESSION["u"]["gender_id"]."'");
                                                $gender_data = $gender_rs->fetch_assoc();
                                                ?>
                                                <input type="text" class="form-control" value="<?php echo $gender_data["gender_name"]; ?>" readonly />
                                            </div>

                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn btn-primary">Update My Profile</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4 text-center">
                                    <div class="row">
                                        <span class="fw-bold text-black-50 mt-5">Display ads</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            <?php
            } else {
            ?>
                <script>
                    alert("You need to Login first");
                    window.location = "home.php";
                </script>

            <?php
            }

            ?>

            <?php include "footer.php"; ?>


        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>