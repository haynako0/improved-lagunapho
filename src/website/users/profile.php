<?php
include "header.php";
include "sidebar.php";
$get_userData=mysqli_query($con,"select * from accnt_tbl where accnt_id='".$_SESSION['accnt_id']."'");
if (mysqli_num_rows($get_userData)>0){
    $row=mysqli_fetch_assoc($get_userData);
}
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Account Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="../assets/img/user_1.png" alt="Profile" class="rounded-circle">
              <h2><?=$row['fullname']?></h2>
              <h3><span class="badge  bg-success"><?=strtoupper($_SESSION['type_name'])?></span></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$row['fullname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$row['email']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?=$row['phone']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Assignment</div>
                    <div class="col-lg-9 col-md-8"><?=is_null($row['municipality']) ? 'Province Laguna' : $row['municipality']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Account Status</div>
                    <div class="col-lg-9 col-md-8">
                        <?php
                        if ($row['accnt_status']=='lock'){
                            echo '<span class="badge bg-danger">Lock</span>';
                        }elseif ($row['accnt_status']=='inactive'){
                            echo '<span class="badge bg-secondary">Inactive</span>';
                        }else{
                            echo '<span class="badge bg-success">Active</span>';
                        }
                        ?>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <small><span class="text-danger">*</span> You can edit <u><b>FULLNAME</b></u>, <u><b>EMAIL</b></u> and <u><b>PHONE</b></u> only.</small>
                  <!-- Profile Edit Form -->
                  <form method="post" action="profile.php" class="mt-2">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullname" type="text" class="form-control" id="fullName" value="<?=$row['fullname']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                          <input name="mail" type="text" class="form-control" id="fullName" value="<?=$row['email']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="company" value="<?=$row['phone']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Assignment</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="<?=is_null($row['municipality']) ? 'Province Laguna' : $row['municipality']?>" disabled>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="save_data">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post" action="profile.php">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="confirmpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="update_pass">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
<?php
include "footer.php";

if (isset($_POST['save_data'])){
    $fullname = $_POST['fullname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];

    $update = mysqli_query($con,"UPDATE `accnt_tbl` SET `fullname` = '$fullname', `email` = '$mail', `phone` = '$phone' WHERE `accnt_tbl`.`accnt_id` = '".$_SESSION['accnt_id']."'");
    if ($update){
        echo '<script>alert("Account Updated.");window.open("profile.php","_self")</script>';
    }else{
        echo '<script>alert("Error encounter while updating account.")</script>';
    }
}

if (isset($_POST['update_pass'])){
    $pass=$_POST['password'];
    $cpass=$_POST['newpassword'];
    $npass=$_POST['confirmpassword'];

    $check_pass =mysqli_query($con,"select * from accnt_tbl where accnt_id='".$_SESSION['accnt_id']."'");
    if (mysqli_num_rows($check_pass)>0){
        if(sha1($pass) === $row['password']){
            if ($cpass==$npass){
                $enc=sha1($npass);
                $update_pass = mysqli_query($con,"UPDATE `accnt_tbl` SET  `password` = '$enc' WHERE `accnt_tbl`.`accnt_id` = '".$_SESSION['accnt_id']."'");
                if ($update_pass) {
                    echo '<script>
                        if (confirm("Password Updated. Do you want to login or retain your current session?")) {
                            window.location.href = "profile.php"; 
                        } else {
                            window.location.href = "../logout.php"; 
                        }
                    </script>';
                }else{
                    echo '<script>alert("Error encounter while updating password. Try again...")</script>';
                }
            }else{
                echo '<script>alert("Password does not match. Try again....")</script>';
            }
        }else{
            echo '<script>alert("Invalid Current Password.")</script>';
        }
    }
}
?>