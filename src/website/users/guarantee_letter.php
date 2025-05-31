<?php
    include "../connection.php";
    
    if ( isset( $_GET[ 'rid' ] ) ) {
        $id = $_GET[ 'rid' ];
        $date = date ( 'Y-m-d' ); // Changed to Y-m-d for a proper date format
        
        // First, check the current value of used_gl
        $checkQuery = mysqli_query ( $con, "SELECT used_gl FROM request_tbl WHERE r_id='$id'" );
        
        if ( $checkQuery ) {
            $s = mysqli_fetch_assoc ( $checkQuery );
            
            // Check if used_gl is empty
            if ( empty( $row[ 'used_gl' ] ) ) {
                // Update used_gl if it is empty
                $update = mysqli_query ( $con, "UPDATE request_tbl SET used_gl='$date' WHERE r_id='$id'" );
                
                // Check if the update was successful
                if ( $update ) {
                    // Retrieve the updated data
                    $data = mysqli_query ( $con, "SELECT * FROM request_tbl WHERE r_id='$id'" );
                    
                    if ( mysqli_num_rows ( $data ) > 0 ) {
                        $d = mysqli_fetch_assoc ( $data );
                    } else {
                        echo "No data found for the given ID.";
                    }
                } else {
                    echo "Error updating record: " . mysqli_error ( $con );
                }
            } else {
                echo "";
            }
        } else {
            echo "Error checking used_gl: " . mysqli_error ( $con );
        }
    }
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<title>Guarantee Letter</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0 auto;
			padding: 20px;
			width: 80%;
			color: #000;
		}
		
		.header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
			color: grey;
		}
		
		.header img {
			width: 120px;
			height: auto;
			opacity: 50%;
		}
		
		.header-content {
			text-align: center;
		}
		
		.header-content h2, .header-content h3 {
			margin: 0;
		}
		
		.header-content p {
			margin: 5px 0;
		}
		
		.program-info {
			text-align: center;
			font-weight: bold;
			margin-top: 30px;
			margin-bottom: 20px;
			font-size: 18px;
		}
		
		.reference-number {
			text-align: right;
			font-weight: bold;
			margin-top: -20px;
			margin-bottom: 20px;
			font-size: 18px;
		}
		
		.letter-header {
			text-align: center;
			margin-bottom: 20px;
		}
		
		.letter-header h1 {
			font-size: 20px;
			margin-bottom: 0;
		}
		
		.letter-body {
			margin-top: 20px;
		}
		
		.table {
			width: 100%;
			margin-top: 20px;
			border-collapse: collapse;
		}
		
		.table th, .table td {
			border: 1px solid #000;
			padding: 8px;
			text-align: center;
		}
		
		.table th {
			background-color: #f0f0f0;
		}
		
		.not-for-sale {
			font-size: 70px;
			font-family: arial, sans-serif;
			text-align: center;
			margin-top: -40px;
			font-weight: bold;
			color: rgba(0, 0, 0, 0.1);
			transform: rotate(-45deg);
		}
		
		.footer {
			text-align: center;
			margin-top: 100px;
		}
		.footer img{
			opacity: 50%;
		}
		
		.footer-text {
			font-size: 8px;
			font-style: italic;
			font-weight: bold;
			color: grey;
		}
	</style>
	
</head>
<body onload="window.print()">
<div class = "header">
	<img src = "../assets/img/doh.jpg" alt = "Left Logo"> <!-- Replace with actual image path -->
	<div class = "header-content">
		<p style="font-size: 15px">Republic of the Philippines</p>
		<p style="font-size: 15px">Department of Health</p>
		<p style="font-size: 15px"><strong>REGIONAL OFFICE IV-A</strong></p>
		<p style = "font-size: 15px;font-style: italic"><strong>CALABARZON</strong></p>
		<p style="font-size: 10px">QMMC Compound, Project 4, Quezon City <br>
		Trunk line: (02) 990-4032 / Direct Line: (02) 440-3551 / 440-3372 <br>
		Email Add: chd4a_doh_calabarzon@yahoo.com</p>
	</div>
	<img src = "../assets/img/bagongpilipinas.png" alt = "Right Logo"> <!-- Replace with actual image path -->
</div>

<div class = "program-info">
	MEDICAL ASSISTANCE PROGRAM
	<hr style="border: 2px solid black">
</div>
<div class = "reference-number">
	<p><?=strtoupper ($d['code'])?></p>
</div>

<div class = "letter-header">
	<h1>GUARANTEE LETTER <br><strong><?=date('m/d/y')?></strong></h1>
</div>

<div class = "letter-body">
	<p>Respectfully referred to <b><?=strtoupper ($d['hospital'])?></b> the herein attached approved request of
		<strong><?=strtoupper ($d['name_of_patient'])?>,
	   <?=$d['age']?>,</strong> from <b><?=strtoupper ($d['r_municipality'])?> </b>for the assistance below:</p>
	
	<table class = "table">
		<tr>
			<td>TYPE OF ASSISTANCE</td>
			<td>AMOUNT</td>
		</tr>
		<tr>
			<td style="padding-top:20px;"><b><?=strtoupper ($d['type_of_assistance'])?></b></td>
			<td style = "padding-top:20px;"><b><?=number_format ($d['amount_being_request'],2)?></b></td>
		</tr>
		<tr >
			<td style="border:none;padding-top: 20px; text-align: left; padding-left: 100px;
			"> Total Amount: </td>
			<td style = "border:none;padding-top: 20px"><b><?= number_format ( $d[ 'amount_being_request' ], 2 ) ?></b></td>
		</tr>
	</table>
	
	<div class = "not-for-sale">
		NOT FOR SALE
	</div>
	
	<p><strong>Amount in words: <?=strtoupper ($d['amount_being_request_in_words'])?></strong></p>
	<p><strong>PROPONENT: <br><?=strtoupper ($d['proponent'])?></strong></p>
	<p style="margin-top: 50px"> Non-convertible to cash,<br> Valid with attached hospital bill</p>
</div>


<div class = "footer">
	<img src = "../assets/img/allforhealth.jpg" alt = "Right Logo" style="width: auto;height:50px">
	<hr style="padding: 1px; border-left: transparent; border-right: transparent">
	<p class = "footer-text">
		“Ang paninigarilyo o paglanghap ng usok nito ay agad na nagdudulot ng paglapot ng dugo at
	                         pagkipot ng mga ugat na maaaring magdulot ng atake sa puso.” - U.S. Department of Health
	                         and Human Services 2011</p>
</div>
</body>
</html>
