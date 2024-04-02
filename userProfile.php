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
                                            <img src="<?php echo $img_data["path"] ?>" class="rounded mt-5" style="width: 150px;" />

                                        <?php
                                        }

                                        ?>


                                        <span class="fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"] ?></span>
                                        <span class="fw-bold text-black-50"><?php echo $email ?></span>

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

                                            <div class="col-12">
                                                <label class="form-label">Address Line 01</label>
                                                <input type="text" class="form-control" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 02</label>
                                                <input type="text" class="form-control" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select">
                                                    <option value="0">Select Province</option>
                                                    <option value="1">Colombo</option>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select">
                                                    <option value="0">Select District</option>
                                                    <option value="1">Kaluthara</option>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select">
                                                    <option value="0">Select City</option>
                                                    <option value="1">Kaluthara</option>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" value="Male" readonly />
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