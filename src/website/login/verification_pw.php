<?php
session_start();
$email = $_GET['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Edward Bacalso">
    <meta name="keyword" content="lpho, laguna, public health office,">

    <title>Laguna Public Heath Office | Record Management System</title>

    <link href="../assets/font/font2.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/img/lpho.jpg" rel="icon">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>
<body>
<!--<div id="loader" class="center"></div>-->

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center " style="margin-left: 3.5%">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center" style="margin-top: 30px;position:center;">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-2 pb-2">
                            <p class="card-header text-center ">
                                <img src="../assets/img/lpho.jpg" alt="logo" class="mx-auto my-1" height="200">
                                <strong><h5 class="text-center">Record Management System</h5></strong>
                            </p>
                            <h3 class="card-title text-center pb-0 fs-4">Verify Email</h3>
                            <p class="text-center small">Enter your OTP to verify</p>
                        </div>

                        <form class="row g-3 needs-validation"  action="" method="post">

                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <input type="text" name="otp_code" class="form-control" id="yourEmail" required autofocus placeholder="Enter OTP here ...">
                                    <div class="invalid-feedback">Please enter your OTP</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <p class="small mb-0 "><a href="../index.php" class="text-decoration-none forgot-password-link">Login to your account?</a></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100"  type="submit" name="verify" id="login" > <i class="bi bi-unlock-fill"></i> VERIFY</button>
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
include "../connection.php";
if(isset($_POST["verify"])){
    session_start();
    $otp = $_SESSION['otp'];
    $otp_code = $_POST['otp_code'];

    if($otp != $otp_code){
        ?>
        <script>
            alert("Invalid OTP code");
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Verify account done, you may reset your password now");
            window.location.replace("reset_psw.php?email=<?php echo $email?>");
        </script>
        <?php
    }
}
?>
