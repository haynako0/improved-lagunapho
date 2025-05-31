<?php
include "header.php";
include "sidebar.php";
?>
    <main id="main" class="main">

    <div class="pagetitle">
      <h1>Municipality</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Municipality</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Municipality in Province of Laguna <a class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMun" href=""> <i class="bi bi-plus-circle"></i> Add Municipality</a></h5>
              <!-- Table with stripped rows -->
              <table id="manageTable" class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $get_mun = mysqli_query($con, "SELECT * FROM municipality ORDER BY mun_name ASC");

                if (mysqli_num_rows($get_mun) > 0) {
                    while ($row = mysqli_fetch_assoc($get_mun)) {
                        ?>
                        <tr>
                            <td><?php echo $row['mun_id']; ?></td>
                            <td><?php echo $row['mun_name']; ?></td>
                        </tr>
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

    <div class="modal fade" id=addMun tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center fw-bold" id="exampleModalLabel">Add Municipality</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container align-items-center">
                        <form method="post" action="municipality.php">
                            <div class="row mb-3">
                                <label for="">Name</label>
                                <div class="col">
                                    <input name="mun" type="text" class="form-control" required>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" name="save_mun">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php
include "footer.php";

if (isset($_POST['save_mun'])){
    $mun = $_POST['mun'];
        $save = mysqli_query($con, "INSERT INTO `municipality` (`mun_name`) VALUES ('$mun')");
        if ($save){
            echo '<script>alert("Saved.");window.open("municipality.php","_self")</script>';
        } else {
            echo '<script>alert("Error encountered while saving. Try Again....");window.open("municipality.php","_self")</script>';
        }
}
?>