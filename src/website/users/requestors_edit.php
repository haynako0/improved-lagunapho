<?php
    include "../connection.php";
    
    if ( isset( $_GET[ 'id' ] ) ) {
        $id = htmlspecialchars ( $_GET[ 'id' ] ); // Sanitize input
        
        // Use prepared statement for the SELECT query
        $stmt = $con -> prepare ( "SELECT * FROM `request_tbl` WHERE r_id = ?" );
        $stmt -> bind_param ( "i", $id ); // Assuming 'id' is an integer
        $stmt -> execute ();
        $result = $stmt -> get_result ();
        
        if ( $result -> num_rows > 0 ) {
            $r = $result -> fetch_assoc ();
        }
    }
    
    include "header.php";
    include "sidebar.php";
?>
<main id = "main" class = "main">
    
    <div class = "pagetitle">
        <h1>Patient/s or Requestor/s </h1>
        <nav>
            <ol class = "breadcrumb">
                <li class = "breadcrumb-item"><a href = "index.php">Home</a></li>
                <li class = "breadcrumb-item active">Requestor/s</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class = "section">
        <div class = "row">
            <div class = "col-lg-12">
                <form class = "shadow col-lg-6 mx-auto px-5 py-5 card" method="post">
                    <a href = "requestors.php"><i class="bi bi-arrow-left mx-2"></i>Back</a>
                    <h1 class = "modal-title fs-5 text-center fw-bold" id = "exampleModalLabel">Edit
                                                                                                Request</h1>
                    <div class = "container align-items-center">
                        <input type = "hidden" name="id" value="<?=$id?>">
                            <div class = "row mb-3">
                                <label for = "">Name of Requester</label>
                                <div class = "col">
                                    <input name = "fullname" type = "text" class = "form-control"
                                           value="<?=$r['r_name']?>">
                                </div>
                            </div>
                            <div class = "row mb-3">
                                <label for = "">Phone</label>
                                <div class = "col">
                                    <input name = "phone" type = "number" class = "form-control"
                                           value="<?=$r['r_phone']?>">
                                </div>
                            </div>
                            <div class = "row mb-3">
                                <div class = "col-sm-6">
                                    <label for = "">Barangay</label>
                                    <input name = "brgy" type = "text" class = "form-control" value="<?=$r['r_brgy']?>">
                                </div>
                                <div class = "col-sm-6">
                                    <label for = "">Municipality</label>
                                    <select name = "mun" id = "" class = "form-control" readonly>
                                        <option value = "">Select municipality</option>
                                        <?php
                                            $data = mysqli_query ( $con, "select * from municipality order by mun_name ASC" );
                                            if ( mysqli_num_rows ( $data ) > 0 ) {
                                                while ( $m = mysqli_fetch_assoc ( $data ) ) {
                                                    if ( $_SESSION[ 'municipality' ] == $m[ 'mun_name' ] ) {
                                                        ?>
                                                        <option value = "<?= $m[ 'mun_name' ] ?>"
                                                                selected><?= $m[ 'mun_name' ] ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class = "row mb-3">
                                <label for = "">Patient Name</label>
                                <div class = "col">
                                    <input name = "patient" type = "text" class = "form-control"
                                        value="<?=$r['name_of_patient']?>">
                                </div>
                            </div>
                            <div class = "row mb-3">
                                <label for = "">Hospital</label>
                                <div class = "col">
                                    <input name = "hospital" type = "text" class = "form-control"
                                           value="<?=$r['hospital']?>">
                                </div>
                            </div>
                            <div class = "row mb-3">
                                <label for = "">Diagnosis</label>
                                <div class = "col">
                                    <input name = "diagnosis" type = "text" class = "form-control"
                                           value = "<?= $r[ 'hospital' ] ?>">
                                </div>
                            </div>
                            <div class = "row mb-3">
                                <div class = "col-sm-4">
                                    <label for = "">Patient Age</label><input name = "patient_age"
                                                                              type = "text"
                                                                              class = "form-control"
                                                                              value = "<?= $r[ 'age' ] ?>">
                                </div>
                                <div class = "col-sm-8">
                                    <label for = "">Requested Amount </label><input name = "request_amt"
                                                                                    type = "text"
                                                                                    class = "form-control"
                                                                                    value = "<?= $r[ 'amount_being_request' ] ?>">
                                </div>
                            </div>
                            <div class = "row mb-3">
                                <label for = "">Remarks <span style = "font-style: italic">(e.g WALKIN, C/O etc.
		                                                                                        .)</span></label>
                                <div class = "col">
                                    <input name = "remarks" type = "text" class = "form-control"
                                           value = "<?= $r[ 'remarks' ] ?>">
                                </div>
                            </div>
                    </div>
                    <div class = "text-lg-end">
                        <button type = "button" class = "btn btn-secondary btn-sm" data-bs-dismiss = "modal">
                            Close
                        </button>
                        <button type = "submit" class = "btn btn-primary btn-sm" name = "save_edit">Save
                                                                                                       changes
                        </button>
                    </div>
                </form>
            </div>
    </section>
    

</main><!-- End #main -->
<?php
    include "footer.php";
    
    //number conversion in words
    function convertNumberToWords ( $num )
    {
        if ( !is_numeric ( $num ) ) {
            return "Invalid input";
        }
        
        // Define the arrays
        $ones = array (
            0 => "", 1 => "one", 2 => "two", 3 => "three", 4 => "four",
            5 => "five", 6 => "six", 7 => "seven", 8 => "eight", 9 => "nine",
            10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen", 14 => "fourteen",
            15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 18 => "eighteen", 19 => "nineteen"
        );
        
        $tens = array (
            0 => "", 1 => "ten", 2 => "twenty", 3 => "thirty", 4 => "forty",
            5 => "fifty", 6 => "sixty", 7 => "seventy", 8 => "eighty", 9 => "ninety"
        );
        
        $hundreds = array ( "", "thousand", "million", "billion", "trillion" );
        
        if ( $num == 0 ) {
            return "zero";
        }
        
        // Format the number to 2 decimal places and split the number and decimal part
        $num = number_format ( $num, 2, ".", "," );
        $num_arr = explode ( ".", $num );
        $whole_number = $num_arr[ 0 ];
        $decimal_part = $num_arr[ 1 ];
        
        $whole_number_arr = array_reverse ( explode ( ",", $whole_number ) );
        $words = "";
        
        foreach ( $whole_number_arr as $index => $value ) {
            if ( $value > 0 ) {
                $word = convertThreeDigitNumber ( $value, $ones, $tens );
                $words = $word . " " . ( $hundreds[ $index ] ?? "" ) . " " . $words;
            }
        }
        
        $words = trim ( $words );
        
        // Handle the decimal part for cents
        if ( $decimal_part > 0 ) {
            $words .= " and " . convertTwoDigitNumber ( $decimal_part, $ones, $tens ) . " cents";
        }
        
        return $words;
    }
    
    function convertThreeDigitNumber ( $num, $ones, $tens )
    {
        $num = (int)$num; // Cast to integer to ensure proper handling
        $hundred_part = "";
        
        if ( $num > 99 ) {
            $hundred_part = $ones[ (int)( $num / 100 ) ] . " hundred ";
            $num = $num % 100;
        }
        
        return $hundred_part . convertTwoDigitNumber ( $num, $ones, $tens );
    }
    
    function convertTwoDigitNumber ( $num, $ones, $tens )
    {
        $num = (int)$num; // Ensure it's an integer
        if ( $num < 20 ) {
            return $ones[ $num ] ?? ""; // Use null coalescing operator to prevent undefined index warnings
        } else {
            return ( $tens[ (int)( $num / 10 ) ] ?? "" ) . " " . ( $ones[ $num % 10 ] ?? "" );
        }
    }
    
    if ( isset( $_POST[ 'save_edit' ] ) ) {
        $id=$_POST['id'];
        $name = $_POST[ 'fullname' ];
        $phone = $_POST[ 'phone' ];
        $brgy = $_POST[ 'brgy' ];
        $mun = $_POST[ 'mun' ];
        $patient = $_POST[ 'patient' ];
        $hospital = $_POST[ 'hospital' ];
        $p_age = (int)$_POST[ 'patient_age' ];
        $diagnosis = $_POST[ 'diagnosis' ];
        $request_amt = floatval ( $_POST[ 'request_amt' ] );
        $amount_in_words = convertNumberToWords ( $request_amt );
        $remarks = $_POST[ 'remarks' ];
    
        // Prepare statement to update request
        $stmt = $con -> prepare ( "UPDATE `request_tbl` SET
    `r_name` = ?,
    `r_phone` = ?,
    `r_brgy` = ?,
    `r_municipality` = ?,
    `name_of_patient` = ?,
    `age` = ?,
    `hospital` = ?,
    `diagnosis` = ?,
    `amount_being_request` = ?,
    `amount_being_request_in_words` = ?,
    `remarks` = ?,
    `r_date_updated` = current_timestamp(),
    `r_status` = 'pending'
WHERE `r_id` = ?" ); // Include an identifier for the WHERE clause

// Bind parameters: adjust the type string and the number of variables
        $stmt -> bind_param ( "sssssssssssi", $name, $phone, $brgy, $mun, $patient, $p_age, $hospital, $diagnosis,
            $request_amt, $amount_in_words, $remarks, $id ); // Include the id as the last parameter
    
    
        if ( $stmt -> execute () ) {
            echo '<script>alert(" Updated.");window.open("requestors.php", "_self")</script>';
        } else {
            echo '<script>alert("Error creating request: " . $stmt->error);</script>';
        }
    }