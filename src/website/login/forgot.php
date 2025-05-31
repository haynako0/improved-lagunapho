<?php session_start() ?>
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
<!--<div id="loader" class="center"></div>-->
<!--<img src="../assets/img/BFP_bg.jpg" style="position:fixed; margin: 0px; padding: 0px; border: none; width: 100%; height: 104%; top: -10px;  ">-->

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
                            <h3 class="card-title text-center pb-0 fs-4">Password Recovery</h3>
                            <p class="text-center small">Enter your email to recover</p>
                        </div>

                        <form class="row g-3 needs-validation"  action="" method="post">

                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <input type="email" name="email" class="form-control" id="yourEmail" required autofocus placeholder="Enter Email here ....">
                                    <div class="invalid-feedback">Please enter your Registered Email.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <p class="small mb-0 "><a href="../index.php" class="text-decoration-none forgot-password-link">Login to your account?</a></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100"  type="submit" name="recover" id="login" > <i class="bi bi-unlock-fill"></i> RECOVER</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--<script src="../assets/js/loader.js"></script>-->
</body>
</html>
<?php
include "../connection.php";
if(isset($_POST["recover"])){
    session_start();
    $email = $_POST["email"];

    $user = mysqli_query($con, "Select * from accnt_tbl where email = '$email'");
    $fetchuser = mysqli_fetch_assoc($user);


    if (mysqli_num_rows($user) == 0 ){
        echo '<script>alert("No email exist.")</script>';
    }elseif (mysqli_num_rows($user) > 0 ){
        if ($fetchuser['accnt_status'] == "lock" or $fetchuser['accnt_status'] == "inactive"){
            echo '  <script>alert(\'Your account is inactive or lock you cannot change password! Please contact your administrator.\')</script>';
        }else{
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;

            $to = $email;
            $subject = "Password Recovery";
            $txt = "Dear $email,\n\n\tWe received a request to reset your password. \n\tYour OTP code is $otp.\n\n\t\t (This is system generated email. Don't reply.)";
            $header = "From: Provincial Health Office Laguna";

            if (mail($to, $subject, $txt, $header)) {
                ?>
                <script>
                    alert("<?php echo "Password Recovery, OTP sent to " . $email . "  in order to recover your account." ?>");
                    window.location.replace("verification_pw.php?email=<?php echo $email?>");
                </script>
                <?php
            } else {
                echo '<script>alert(" Please check your internet connection or the email you inputted.")</script>';
            }
        }
    } else {
        echo '<script>alert(" Something went wrong during selection!")</script>';
    }
 }
?>
