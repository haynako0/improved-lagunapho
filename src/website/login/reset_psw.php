<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Edward Bacalso">
    <meta name="keyword" content="lpho, laguna, public health office,">

       <title>Laguna Provincial Heath Office | Record Management System</title>

    <link href="../assets/font/font2.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/img/lpho.jpg" rel="icon">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>
<body>
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center " style="margin-left: 3.5%">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center" style="margin-top: 40px;position:center;">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <p class="card-header text-center ">
                                <img src="../assets/img/lpho.jpg" alt="logo" class="mx-auto my-1" height="200">
                                <strong><h5 class="text-center">Record Management System</h5></strong>
                            </p>
                            <h3 class="card-title text-center pb-0 fs-4">Reset Password</h3>
                            <p class="text-center small">Enter your new password to change</p>
                        </div>

                        <form class="row g-3 needs-validation" action="" method="post">

                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <input type="password" name="password" class="form-control" id="yourPassword" required minlength="8" placeholder="Enter New Password ...." autofocus>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <input type="password" name="cpassword" class="form-control" id="yourPassword" required minlength="8" placeholder="Confirm Password ...." autofocus>
                                    <div class="invalid-feedback">Please confirm your password!</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <p class="small mb-0 "><a href="../index.php" class="text-decoration-none forgot-password-link">Login to your account?</a></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100"  type="submit" name="resetpw" id="login" > <i class="bi bi-unlock-fill"></i> SUBMIT</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<!--<script src="../assets/js/loader.js"></script>-->
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_POST["resetpw"])) {
    include "../connection.php";
    $cpsw = $_POST['cpassword'];
    $psw = $_POST["password"];
    $email = $_GET['email'];

    if ($psw != $cpsw) {
        echo '<script>alert("Password does not match. Please try again...");</script>';
    } else {
        $hash = sha1($psw);

        // Prepare and bind the statement
        $stmt = $con->prepare("SELECT * FROM accnt_tbl WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            // Fetch the user data
            $fetchuser = $result->fetch_assoc();
            if ($email == $fetchuser['email']) {
                // Update the password
                $new_pass = $hash;
                $stmt = $con->prepare("UPDATE accnt_tbl SET password = ? WHERE email = ?");
                $stmt->bind_param("ss", $new_pass, $email);
                $stmt->execute();

                ?>
                <script>
                    window.location.replace("../index.php");
                    alert("<?php echo "Your password has been successfully reset!" ?>");
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("<?php echo "Please try again" ?>");
                </script>
                <?php
            }
        } else {
            echo '<script>alert("User does not exist. Please try again...");</script>';
        }

        // Close the statement and connection
        $stmt->close();
        $con->close();
    }
}
?>
