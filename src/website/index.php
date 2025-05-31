<?php
session_start();

if (isset($_POST['login'])) {
    include "connection.php";
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind the statement
    $stmt = $con->prepare("SELECT accnt_type.*, accnt_tbl.* FROM accnt_tbl INNER JOIN accnt_type ON accnt_tbl.accnt_type = accnt_type.type_id WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 0) {
        echo '<script>alert("User is not registered.");</script>';
    } else {
        $row = $result->fetch_assoc();
        $_SESSION['accnt_status'] = $row['accnt_status'];
        if ($_SESSION['accnt_status'] == "lock" or $_SESSION['accnt_status'] == "inactive") {
            echo '<script>alert("Your account is inactive or locked! Please contact your administrator.")</script>';
            unset($_SESSION['attempt']);
        } else {
            // Verify password
            if ( sha1 ( $password ) === $row[ 'password' ]) {
                $_SESSION['accnt_id'] = $row['accnt_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['municipality'] = is_null($row['municipality']) ? 'Province Laguna' : $row['municipality'];
                $_SESSION['accnt_type'] = $row['accnt_type'];
                $_SESSION['accnt_status'] = $row['accnt_status'];
                $_SESSION['type_name'] = $row['type_name'];
                $_SESSION['welcome_message'] = "Welcome " . $_SESSION['fullname'];
                header("Location: users/dashboard.php?id=" . $_SESSION['accnt_id']);
                exit();
            } else {
                echo '<script>alert("Invalid Credentials.")</script>';
            }
        }
    }
    $stmt->close();
    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Laguna Provincial Heath Office | Record Management System</title>
    <meta content="" name="description">
    <meta name="author" content="Edward Bacalso">
    <meta name="keyword" content="lpho, laguna, public health office,">

    <!-- Favicons -->
    <link href="" rel="icon">

    <!-- Google Fonts -->
    <link href="assets/font/font1.css" rel="stylesheet">
    <link href="assets/img/lpho.jpg" rel="icon">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body >
<!--<div id="loader" class="center"></div>-->
<!--<img src="assets/img/BFP_bg.jpg" style="position:fixed; margin: 0px; padding: 0px; border: none; width: 100%; height: 104%; top: -10px;" alt="BFP CALABARZON Headquarters">-->
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center mt-4" style="margin-left: 3%;margin-top: -20%">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2 ">
                                    <p class="card-header text-center ">
                                        <img src="assets/img/lpho.jpg" alt="logo" class="mx-auto my-1" height="200">
                                        <strong><h5 class="text-center">Record Management System</h5></strong>
                                    </p>
                                    <h3 class="card-title text-center pb-0 fs-4">Login </h3>
                                    <h6 class="text-center small">Enter your Email & Password to login</h6>
                                </div>

                                <form class="row g-3 needs-validation " novalidate action="" method="post">

                                    <div class="col-12">
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control" id="yourUsername"placeholder="Email" autofocus required>
                                            <div class="invalid-feedback">Email is empty.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Password" required>
                                        <div class="invalid-feedback">Password is empty!</div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="small " style="margin-left: 10px"> <a href="login/forgot.php">Forgot Password?</a></h5>
                                        <button class="btn btn-primary w-100" id="btnlogin" type="submit" name="login" ><i class="bi bi-unlock-fill"></i> Login</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<!--<script src="assets/js/loader.js"></script>-->
</body>

</html>
