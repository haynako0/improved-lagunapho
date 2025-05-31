<?php
include "../connection.php";
if (isset($_GET['id'])) {
    $delete = mysqli_query($con, "delete from request_tbl where r_id='".$_GET['id']."'");
    if ($delete){
        echo '<script>alert("Request deleted successfully.");window.open("requestors.php","_self")</script>';
    }else{
        echo '<script>alert("Error encounter while deleting request.")</script>';
    }
}
