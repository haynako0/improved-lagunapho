<?php
include "header.php";
include "sidebar.php";
?>
    <main id="main" class="main">

    <div class="pagetitle">
      <h1>Coordinator/s</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Coordinator/s</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Coordinator/s <a class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccount" href=""> <i class="bi bi-person-plus"></i> New Account</a></h5>
              <p>Coordinator/s assigned in there respective Municipality</p>
              <!-- Table with stripped rows -->
              <table id="manageTableCoordinator" class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Municipality</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Account Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $get_coordinator = mysqli_query($con, "SELECT * FROM accnt_tbl WHERE accnt_type = '2' ORDER BY accnt_id DESC");

                if (mysqli_num_rows($get_coordinator) > 0) {
                    $i=0;
                    while ($row = mysqli_fetch_assoc($get_coordinator)) {
                        $a="b-".$i;
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $row['accnt_id']; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['municipality']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                           <td>
                                <?php
                                if ($row['accnt_status'] == 'active') {
                                    echo '<span class="badge bg-success">Active</span>';
                                } elseif ($row['accnt_status'] == 'inactive') {
                                    echo '<span class="badge bg-secondary">Inactive</span>';
                                } else {
                                    echo '<span class="badge bg-danger">Locked</span>';
                                }
                                ?>
                            </td>
                            <td class="flex">
                                <form action="" method="post">
                                    <input type="hidden" value="<?=$row['accnt_id']?>" name="accnt">
                                    <button class="btn btn-primary" type="submit" name="send" title="Send Credentials"><i class="bi bi-send"></i></button>
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?=$a?>" href="" title="Update Status"><i class="bi bi-pencil"></i></a>
                                </form>
                                </td>
                        </tr>
                        <div class="modal fade" id=<?=$a?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-center fw-bold" id="exampleModalLabel">Update Status</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        <div class="container align-items-center">
                                            <form method="post" action="coordinators.php">
                                                <input type="hidden" value="<?=$row['accnt_id']?>" name="id">
                                                <div class="row mb-3">
                                                    <label for="">Status</label>
                                                    <div class="col">
                                                        <select name="status" id="" class="form-control">
                                                            <option value="">Select status</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                            <option value="lock">Lock</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm" name="save_status">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

    <div class="modal fade" id=addAccount tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center fw-bold" id="exampleModalLabel">New Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container align-items-center">
                        <form method="post" action="coordinators.php">
                            <div class="row mb-3">
                                <label for="">Fullname</label>
                                <div class="col">
                                    <input name="fullname" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="">Email</label>
                                <div class="col">
                                    <input name="mail" type="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="">Phone</label>
                                <div class="col">
                                    <input name="phone" type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="">Municipality</label>
                                <div class="col">
                                    <select name="mun" id="" class="form-control" required>
                                        <option value="">Select municipality</option>
                                        <?php
                                        $data=mysqli_query($con,"select * from municipality order by mun_name ASC");
                                        if (mysqli_num_rows($data)>0){
                                            while ($m=mysqli_fetch_assoc($data)){
                                                ?>
                                                <option value="<?=$m['mun_name']?>"><?=$m['mun_name']?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="">Temporary Password</label>
                                <div class="col">
                                    <input name="pass" type="password" class="form-control" value="abc12345" required>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" name="save_accnt">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php
include "footer.php";
if (isset($_POST['save_accnt'])) {
    $name = $_POST['fullname'];
    $email = $_POST['mail'];
    $phone = $_POST['phone'];
    $mun = $_POST['mun'];
    $pass = $_POST['pass'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email address.");</script>';
        exit; // Stop execution if email is invalid
    }

    if (!is_numeric($phone)) {
        echo '<script>alert("Invalid phone number.");</script>';
        exit; // Stop execution if phone number is invalid
    }


    $enc = sha1($pass);

    $stmt = $con->prepare("INSERT INTO `accnt_tbl` (`fullname`, `municipality`, `email`, `phone`, `password`, `accnt_type`, `accnt_status`) VALUES (?, ?, ?, ?, ?, '2', 'active')");

    $stmt->bind_param("sssss", $name, $mun, $email, $phone, $enc);

    $success = $stmt->execute();

    // Check if insertion was successful
    if ($success) {
        echo '<script>alert("Successfully created account.");window.open("coordinators.php","_self");</script>';
    } else {
        echo '<script>alert("Error encountered while creating account.");</script>';
    }

    // Close the statement
    $stmt->close();
}

if (isset($_POST['send'])) {
    $id = $_POST['accnt'];

    // Prepare the SQL statement
    $stmt = $con->prepare("SELECT * FROM accnt_tbl WHERE accnt_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if account exists
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $to = $data['email'];

        $subject = "Account Creation";
        $message = "Dear $to,\n\nWe successfully created your account. \n\nCredentials as follows:\nEmail: $to\nPassword: abc12345\n\nPlease change your temporary password immediately. Thank you.\n\n(This is a system-generated email. Do not reply.)";
        $headers = "From: Provincial Health Office Laguna";

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            echo '<script>alert("The user has been successfully notified via email.");window.open("coordinators.php","_self");</script>';
            exit;
        } else {
            echo '<script>alert("Failed to send email. Please check your internet connection or the email address you provided.");</script>';
        }
    } else {
        echo '<script>alert("Account not found.");</script>';
    }

    // Close the statement
    $stmt->close();
}

if (isset($_POST['save_status'])){
    $status=$_POST['status'];
    $id=$_POST['id'];

    $upate=mysqli_query($con,"UPDATE `accnt_tbl` SET `accnt_status` = '$status' WHERE `accnt_tbl`.`accnt_id` = '$id'");
    if ($upate){
        echo '<script>alert("Status updated.");window.open("coordinators.php","_self")</script>';
    }
}

?>