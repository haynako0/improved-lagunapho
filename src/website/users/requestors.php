<?php
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
				
				<div class = "card mx-auto">
					<div class = "card-body">
						<h5 class = "card-title">List of Patient/s or Requestor/s
                            <?php if ( $_SESSION[ 'accnt_type' ] == "2" ): ?>
	                            <button onclick = "window.open('requestors.php','_self')"
	                                    class = "btn btn-secondary"> Reload
	                            </button>
								<a class = "float-end btn btn-primary" data-bs-toggle = "modal"
								   data-bs-target = "#newRequest" href = ""> <i class = "bi bi-person-plus"></i> New
								                                                                                 Request</a>
                            <?php endif; ?>
						</h5>
                        <?php if ( $_SESSION[ 'accnt_type' ] == "1" ): ?>
							<form action = "requestors.php" method = "post">
								<div class = "col-lg-12 row mb-2">
									<div class = "col-md-4">
										<label for = "month">Select Date:</label>
										<input type = "month" name = "filter_date" class = "form-control" required>
									</div>
									<div class = "col-md-4 mt-4">
										<button class = "btn btn-primary" type = "submit" name = "get_data">Submit
										</button>
										<button onclick="window.open('requestors.php','_self')"
										        class = "btn btn-secondary"> Reload</button>
									</div>
									<div class = "col-md-4">
                                        <?php
                                            if ( isset( $_POST[ 'filter_date' ] ) ) {
                                                echo 'Selected Date: &nbsp;';
                                                echo '<span class="badge bg-success">' . date ( "Y F", strtotime ( $_POST[ 'filter_date' ] ) ) . '</span>';
                                            }
                                        ?>
									</div>
								</div>
							</form>
                        <?php endif; ?>
						<hr>
						<!-- Table with stripped rows -->
                        <?php if ( $_SESSION[ 'accnt_type' ] == "1" ): ?>
						<table id = "manageTableRequest" class = "table datatable" >
                            <?php endif; ?>
                            <?php if ( $_SESSION[ 'accnt_type' ] == "2" ): ?>
							<table id = "manageTable" class = "table datatable" >
                                <?php endif; ?>
								<thead>
								<tr>
									<th scope = "col">#</th>
									<th scope = "col">DATE</th>
									<th scope = "col">CODE</th>
									<th scope = "col">HOSPITAL</th>
									<th scope = "col">NAME OF REQUESTOR</th>
									<th scope = "col">NAME OF PATIENT</th>
									<th scope = "col">AGE</th>
									<th scope = "col">ADDRESS</th>
									<th scope = "col">DIAGNOSIS</th>
									<th scope = "col">TYPE OF ASSISTANCE</th>
									<th scope = "col">AMOUNT</th>
									<th scope = "col">AMOUNT IN WORDS</th>
									<th scope = "col">REMARKS</th>
									<th scope = "col">USED GL</th>
									<th scope = "col">PAID</th>
									<th scope = "col">STATUS</th>
									<th scope = "col">REQUIREMENTS</th>
									<th scope = "col">COMMENT</th>
									<th scope = "col">ACTION</th>
								</tr>
								</thead>
								<tbody>
                                <?php
                                    if ( $_SESSION[ 'municipality' ] == "Province Laguna" && !isset( $_POST[ 'get_data' ] ) ) {
                                        $get_requester = mysqli_query ( $con, "SELECT * FROM request_tbl ORDER BY r_id ASC" );
                                        if ( mysqli_num_rows ( $get_requester ) > 0 ) {
                                            $u = 0;
                                            while ( $r = mysqli_fetch_assoc ( $get_requester ) ) {
                                                $c = "d-" . $u;
                                                $u ++;
                                                ?>
												<tr>
													<td><?= $r[ 'r_id' ] ?></td>
													<td><?= strtoupper (date ( "F m, Y", strtotime ( $r[ 'r_date_requested' ] ) ))
														?></td>
													<td><?=strtoupper ($r['code'])?></td>
													<td><?=strtoupper ($r['hospital'])?></td>
													<td><?= strtoupper ($r[ 'r_name' ]) ?></td>
													<td><?= strtoupper ($r[ 'name_of_patient' ]) ?></td>
													<td><?= $r[ 'age' ] ?></td>
													<td><?= strtoupper ('BRGY.'. $r[ 'r_brgy' ] .' '. $r[ 'r_municipality' ].', LAGUNA' )?></td>
													<td><?= strtoupper ($r['diagnosis'])?></td>
													<td><?= strtoupper ($r['type_of_assistance'])?></td>
													<td><?= number_format ($r['amount_being_request'],2)?></td>
													<td><?=strtoupper ($r['amount_being_request_in_words'])?></td>
													<td><?=strtoupper ($r['remarks'])?></td>
													<td>
														<?php
															if ($r['used_gl'] == '' || $r['used_gl'] == NULL){
																echo '';
															}else{
                                                               echo  date ( "F d, Y", strtotime ( $r[ 'used_gl' ]
                                                                ) ) ;
															}
															?>
													</td>
													<td><?=number_format ($r['paid'],2)?></td>
													<td><?php
                                                            if ( $r[ 'r_status' ] == 'pending' ) {
                                                                echo '<span class="badge bg-primary">Pending</span>';
                                                            } elseif ( $r[ 'r_status' ] == 'approved' ) {
                                                                echo '<span class="badge bg-success">Approved</span>';
                                                            } else {
                                                                echo '<span class="badge bg-danger">Disapproved</span>';
                                                            }
                                                        ?></td>
													<td>
                                                        <?php
                                                            $get_req = mysqli_query ( $con, "SELECT * FROM r_request_requirements_tbl WHERE r_id='" . $r[ 'r_id' ] . "'" );
                                                            if ( mysqli_num_rows ( $get_req ) > 0 ) {
                                                                $i = 1;
                                                                while ( $req = mysqli_fetch_assoc ( $get_req ) ) {
                                                                    ?>
																	<a href = "<?= $req[ 'path' ] ?>"
																	   target = "_blank"><?= $i ++ ?>
																		. <?= $req[ 'filename' ] ?></a>
																	<br><?= PHP_EOL ?>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo '<span class="text-info italic">No Requirements</span>';
                                                            }
                                                        ?>
													</td>
													<td><?php
                                                            if ( $r[ 'r_comment' ] == NULL ) {
                                                                echo '<span class="text-info" style="font-style: italic">Empty Comment</span>';
                                                            } else {
                                                                echo $r[ 'r_comment' ];
                                                            }
                                                        ?></td>
													<td>
                                                        <?php
                                                            if ( $r[ 'r_status' ] == "disapproved" && $r[ 'r_status' ] != "pending" ) {
                                                                ?>
																<a class = " btn btn-danger disabled"
																   data-bs-toggle = "modal"
																   data-bs-target = "#<?= $c ?>" href = ""> <i
																			class = "bi bi-hand-thumbs-down"></i></a>
                                                                <?php
                                                            } elseif ( $r[ 'r_status' ] == "approved" ) {
                                                                ?>
	                                                            <a href = "guarantee_letter.php?rid=<?=$r['r_id']?>" target="_blank"
	                                                               class="
	                                                            btn btn-success"><i
				                                                            class="bi bi-printer"></i></a>
                                                                <?php
                                                            } else {
                                                                ?>
																<a class = "btn btn-primary"
																   data-bs-toggle = "modal"
																   data-bs-target = "#<?= $c ?>" href = ""> <i
																			class = "bi bi-pencil"></i></a>
                                                                <?php
                                                            }
                                                        ?>
													</td>
												</tr>
												<div class = "modal fade" id =<?= $c ?> tabindex="-1"
												     aria-labelledby = "exampleModalLabel" aria-hidden = "true">
													<div class = "modal-dialog">
														<div class = "modal-content">
															<div class = "modal-header">
																<h1 class = "modal-title fs-5 text-center fw-bold"
																    id = "exampleModalLabel">Update Status</h1>
																<button type = "button" class = "btn-close"
																        data-bs-dismiss = "modal"
																        aria-label = "Close"></button>
															</div>
															<div class = "modal-body modal-lg">
																<div class = "container align-items-center">
																	<form method = "post" id = "updateForm"
																	      action = "requestors.php">
																		<div class = "row mb-3">
																			<label for = "status">Status</label>
																			<div class = "col">
																				<input type = "hidden"
																				       value = "<?= $r[ 'r_id' ] ?>"
																				       name = "r_id">
																				<select name = "stat" id = "status"
																				        class = "form-control" required>
																					<option value = "">Select status
																					</option>
																					<option value = "approved">
																						Approved
																					</option>
																					<option value = "disapproved">
																						Disapproved
																					</option>
																				</select>
																			</div>
																		</div>
																		<div class = "row mb-3" id = "commentBox">
																			<label for = "com">Comment (If approved
																			                   optional)</label>
																			<div class = "col">
																				<textarea name = "comment" id = "com"
																				          class = "form-control"></textarea>
																			</div>
																		</div>
																		<div class = "row mb-3" id = "amountBox">
																			<label for = "amount">Code</label>
																			<div class = "col">
																				<input type = "text"
																				       class = "form-control"
																				       id = "code" name = "code">
																			</div>
																		</div>
																		<div class = "row mb-3" id = "amountBox">
																			<label for = "amount">Proponent</label>
																			<div class = "col">
																				<input type = "text"
																				       class = "form-control"
																				       id = "proponent" name =
																				       "proponent">
																			</div>
																		</div>
																</div>
															</div>
															<div class = "modal-footer">
																<button type = "button"
																        class = "btn btn-secondary btn-sm"
																        data-bs-dismiss = "modal">Close
																</button>
																<button type = "submit" class = "btn btn-primary btn-sm"
																        name = "save_update">Save changes
																</button>
															</div>
															</form>
														</div>
													</div>
												</div>
                                                <?php
                                            }
                                        }
                                    }
                                    elseif ( isset( $_POST[ 'get_data' ] ) && $_SESSION[ 'municipality' ] == "Province Laguna" ) {
                                        $fil = $_POST[ 'filter_date' ];
                                        $get_requester = mysqli_query ( $con, "SELECT *
FROM request_tbl 
WHERE DATE_FORMAT(r_date_requested, '%Y-%m') = '$fil'
ORDER BY r_id ASC;
" );
                                        if ( mysqli_num_rows ( $get_requester ) > 0 ) {
                                            $u = 0;
                                            while ( $r = mysqli_fetch_assoc ( $get_requester ) ) {
                                                $c = "d-" . $u;
                                                $u ++;
                                                ?>
												<tr>
													<td><?= $r[ 'r_id' ] ?></td>
													<td><?= strtoupper ( date ( "F m, Y", strtotime ( $r[ 'r_date_requested' ] ) ) )
                                                        ?></td>
													<td><?= strtoupper ( $r[ 'code' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'hospital' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'r_name' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'name_of_patient' ] ) ?></td>
													<td><?= $r[ 'age' ] ?></td>
													<td><?= strtoupper ( 'BRGY.' . $r[ 'r_brgy' ] . ', ' . $r[ 'r_municipality' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'diagnosis' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'type_of_assistance' ] ) ?></td>
													<td><?= number_format ( $r[ 'amount_being_request' ], 2 ) ?></td>
													<td><?= strtoupper ( $r[ 'amount_being_request_in_words' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'remarks' ] ) ?></td>
													<td>
                                                        <?php
                                                            if ( $r[ 'used_gl' ] == '' || $r[ 'used_gl' ] == NULL ) {
                                                                echo '';
                                                            } else {
                                                                echo date ( "F d, Y", strtotime ( $r[ 'used_gl' ]
                                                                ) );
                                                            }
                                                        ?>
													</td>
													<td><?= number_format ( $r[ 'paid' ], 2 ) ?></td>
													<td><?php
                                                            if ( $r[ 'r_status' ] == 'pending' ) {
                                                                echo '<span class="badge bg-primary">Pending</span>';
                                                            } elseif ( $r[ 'r_status' ] == 'approved' ) {
                                                                echo '<span class="badge bg-success">Approved</span>';
                                                            } else {
                                                                echo '<span class="badge bg-danger">Disapproved</span>';
                                                            }
                                                        ?></td>
													<td>
                                                        <?php
                                                            $get_req = mysqli_query ( $con, "SELECT * FROM r_request_requirements_tbl WHERE r_id='" . $r[ 'r_id' ] . "'" );
                                                            if ( mysqli_num_rows ( $get_req ) > 0 ) {
                                                                $i = 1;
                                                                while ( $req = mysqli_fetch_assoc ( $get_req ) ) {
                                                                    ?>
																	<a href = "<?= $req[ 'path' ] ?>"
																	   target = "_blank"><?= $i ++ ?>
																		. <?= $req[ 'filename' ] ?></a>
																	<br><?= PHP_EOL ?>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo '<span class="text-info italic">No Requirements</span>';
                                                            }
                                                        ?>
													</td>
													<td><?php
                                                            if ( $r[ 'r_comment' ] == NULL ) {
                                                                echo '<span class="text-info" style="font-style: italic">Empty Comment</span>';
                                                            } else {
                                                                echo $r[ 'r_comment' ];
                                                            }
                                                        ?></td>
													<td>
                                                        <?php
                                                            if ( $r[ 'r_status' ] == "disapproved" && $r[ 'r_status' ] != "pending" ) {
                                                                ?>
																<a class = " btn btn-danger disabled"
																   data-bs-toggle = "modal"
																   data-bs-target = "#<?= $c ?>" href = ""> <i
																			class = "bi bi-hand-thumbs-down"></i></a>
                                                                <?php
                                                            } elseif ( $r[ 'r_status' ] == "approved" ) {
                                                                ?>
	                                                            <a href = "guarantee_letter.php?rid=<?= $r[ 'r_id' ]
	                                                            ?>" target="_blank"
	                                                               class = "
	                                                            btn btn-success"><i
				                                                            class = "bi bi-printer"></i></a>
                                                                <?php
                                                            } else {
                                                                ?>
																<a class = "btn btn-primary"
																   data-bs-toggle = "modal"
																   data-bs-target = "#<?= $c ?>" href = ""> <i
																			class = "bi bi-pencil"></i></a>
                                                                <?php
                                                            }
                                                        ?>
													</td>
												</tr>
												<div class = "modal fade" id =<?= $c ?> tabindex="-1"
												     aria-labelledby = "exampleModalLabel" aria-hidden = "true">
													<div class = "modal-dialog">
														<div class = "modal-content">
															<div class = "modal-header">
																<h1 class = "modal-title fs-5 text-center fw-bold"
																    id = "exampleModalLabel">Update Status</h1>
																<button type = "button" class = "btn-close"
																        data-bs-dismiss = "modal"
																        aria-label = "Close"></button>
															</div>
															<div class = "modal-body modal-lg">
																<div class = "container align-items-center">
																	<form method = "post" id = "updateForm"
																	      action = "requestors.php">
																		<div class = "row mb-3">
																			<label for = "">Status</label>
																			<div class = "col">
																				<input type = "hidden"
																				       value = "<?= $r[ 'r_id' ] ?>"
																				       name = "r_id">
																				<select name = "stat" id = "status"
																				        class = "form-control" required>
																					<option value = "">Select status
																					</option>
																					<option value = "approved">
																						Approved
																					</option>
																					<option value = "disapproved">
																						Disapproved
																					</option>
																				</select>
																			</div>
																		</div>
																		<div class = "row mb-3">
																			<label for = "">Comment (If approved
																			                optional)</label>
																			<div class = "col">
																				<textarea name = "comment"
																				          class = "form-control"></textarea>
																			</div>
																		</div>
																		
																		<div class = "row mb-3" id = "amountBox">
																			<label for = "amount">Code</label>
																			<div class = "col">
																				<input type = "text"
																				       class = "form-control"
																				       id = "code" name = "code">
																			</div>
																		</div>
																		<div class = "row mb-3" id = "amountBox">
																			<label for = "amount">Proponent</label>
																			<div class = "col">
																				<input type = "text"
																				       class = "form-control"
																				       id = "proponent" name = "proponent">
																			</div>
																		</div>
																</div>
															</div>
															<div class = "modal-footer">
																<button type = "button"
																        class = "btn btn-secondary btn-sm"
																        data-bs-dismiss = "modal">Close
																</button>
																<button type = "submit" class = "btn btn-primary btn-sm"
																        name = "save_update">Save changes
																</button>
															</div>
															</form>
														</div>
													</div>
												</div>
                                                <?php
                                            }
                                        }
                                    }
                                    else {
                                        $get_requester = mysqli_query ( $con, "SELECT * FROM request_tbl WHERE r_municipality='" . $_SESSION[ 'municipality' ] . "' ORDER BY r_id ASC" );
                                        if ( mysqli_num_rows ( $get_requester ) > 0 ) {
                                        	$m=0;
                                            while ( $r = mysqli_fetch_assoc ( $get_requester ) ) {
                                                $d = "d-" . $m;
                                                $m ++;
                                                ?>
												<tr>
													<td><?= $r[ 'r_id' ] ?></td>
													<td><?= strtoupper ( date ( "F m, Y", strtotime ( $r[ 'r_date_requested' ] ) ) )
                                                        ?></td>
													<td><?= strtoupper ( $r[ 'code' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'hospital' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'r_name' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'name_of_patient' ] ) ?></td>
													<td><?= $r[ 'age' ] ?></td>
													<td><?= strtoupper ( 'BRGY.' . $r[ 'r_brgy' ] . ', ' . $r[ 'r_municipality' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'diagnosis' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'type_of_assistance' ] ) ?></td>
													<td><?= number_format ( $r[ 'amount_being_request' ], 2 ) ?></td>
													<td><?= strtoupper ( $r[ 'amount_being_request_in_words' ] ) ?></td>
													<td><?= strtoupper ( $r[ 'remarks' ] ) ?></td>
													<td>
                                                        <?php
                                                            if ( $r[ 'used_gl' ] == '' || $r[ 'used_gl' ] == NULL ) {
                                                                echo '';
                                                            } else {
                                                                echo date ( "F d, Y", strtotime ( $r[ 'used_gl' ]
                                                                ) );
                                                            }
                                                        ?>
													</td>
													<td><?= number_format ( $r[ 'paid' ], 2 ) ?></td>
													<td><?php
                                                            if ( $r[ 'r_status' ] == 'pending' ) {
                                                                echo '<span class="badge bg-primary">Pending</span>';
                                                            } elseif ( $r[ 'r_status' ] == 'approved' ) {
                                                                echo '<span class="badge bg-success">Approved</span>';
                                                            } else {
                                                                echo '<span class="badge bg-danger">Disapproved</span>';
                                                            }
                                                        ?></td>
													<td>
                                                        <?php
                                                            $get_req = mysqli_query ( $con, "SELECT * FROM r_request_requirements_tbl WHERE r_id='" . $r[ 'r_id' ] . "'" );
                                                            if ( mysqli_num_rows ( $get_req ) > 0 ) {
                                                                $i = 1;
                                                                while ( $req = mysqli_fetch_assoc ( $get_req ) ) {
                                                                    ?>
																	<a href = "<?= $req[ 'path' ] ?>"
																	   target = "_blank"><?= $i ++ ?>
																		. <?= $req[ 'filename' ] ?></a>
																	<br><?= PHP_EOL ?>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo '<span class="text-info italic">No Requirements</span>';
                                                            }
                                                        ?>
													</td>
													<td><?php
                                                            if ( $r[ 'r_comment' ] == NULL ) {
                                                                echo '<span class="text-info" style="font-style: italic">Empty Comment</span>';
                                                            } else {
                                                                echo $r[ 'r_comment' ];
                                                            }
                                                        ?></td>
													<td>
                                                        <?php
                                                            if ( $r[ 'r_status' ] == "pending" ) {
                                                                ?>
	                                                            <a href = "requestors_edit.php?id=<?= $r[ 'r_id' ]
                                                                ?>" class = "btn btn-primary"><i
				                                                            class = "bi bi-pencil"></i></a>
																<a href = "requestors_cancel.php?id=<?= $r[ 'r_id' ]
																?>" class = "btn btn-danger"><i class = "bi bi-trash"></i></a>
                                                                <?php
                                                            } else {
                                                                ?>
	                                                            <a href = "guarantee_letter.php?rid=<?= $r[ 'r_id' ]
	                                                            ?>" target="_blank"
	                                                               class = "
	                                                            btn btn-success"><i
				                                                            class = "bi bi-printer"></i></a>
                                                                <?php
                                                            }
                                                        ?>
													</td>
												</tr>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
								</tbody>
							</table>
							<!-- End Table with stripped rows -->
					
					</div>
				</div>
			
			</div>
		</div>
	</section>
	
	<div class = "modal fade" id = newRequest tabindex = "-1" aria-labelledby = "exampleModalLabel"
	     aria-hidden = "true">
		<div class = "modal-dialog">
			<div class = "modal-content">
				<div class = "modal-header">
					<h1 class = "modal-title fs-5 text-center fw-bold" id = "exampleModalLabel">New Request</h1>
					<button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>
				</div>
				<div class = "modal-body modal-lg">
					<div class = "container align-items-center">
						<form method = "post" action = "requestors.php" enctype = "multipart/form-data">
							<div class = "row mb-3">
								<label for = "">Name of Requestor</label>
								<div class = "col">
									<input name = "fullname" type = "text" class = "form-control" required>
								</div>
							</div>
							<div class = "row mb-3">
								<label for = "">Phone</label>
								<div class = "col">
									<input name = "phone" type = "number" class = "form-control" required>
								</div>
							</div>
							<div class = "row mb-3">
								<div class = "col-sm-6">
									<label for = "">Barangay</label>
									<input name = "brgy" type = "text" class = "form-control" required>
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
									<input name = "patient" type = "text" class = "form-control" required>
								</div>
							</div>
							<div class = "row mb-3">
								<label for = "">Hospital</label>
								<div class = "col">
									<input name = "hospital" type = "text" class = "form-control" required>
								</div>
							</div>
							<div class = "row mb-3">
								<label for = "">Diagnosis</label>
								<div class = "col">
									<input name = "diagnosis" type = "text" class = "form-control" required>
								</div>
							</div>
							<div class = "row mb-3">
								<div class = "col-sm-4">
								<label for = "">Patient Age</label><input name = "patient_age" type = "number" class = "form-control" required>
								</div>
								<div class = "col-sm-8">
									<label for = "">Requested Amount </label><input name = "request_amt" type = "number" class = "form-control" required>
								</div>
							</div>
							<div class = "row mb-3">
								<label for = "assistance">Type of Assistance</label>
								<div class = "col">
									<input name = "assistance" type = "text" class = "form-control"
									       list = "assistanceOptions" required>
									<datalist id = "assistanceOptions">
										<option value = "MEDICINE">
										<option value = "DIALYSIS"">
										<option value = "HOSPITAL BILL">
										<option value = "CT SCAN">
										<option value = "PT REHAB">
										<option value = "LABORATORY AND MEDICAL PROCEDURE">
										<option value = "2D ECHO LABORATORY">
										<option value = "CHEMOTHERAPY">
											<!-- Add more options as needed -->
									</datalist>
								</div>
							</div>
							<div class = "row mb-3">
								<label for = "">Upload Requirements <br><small>(such as medical abstract, hospital bill
								                                               and certificate of indecency and other
								                                               supporting documents.)</small></label>
								<div class = "col">
									<input name = "requirements[]" type = "file" class = "form-control"
									       accept = ".pdf,.png,.jpg" multiple required>
								</div>
							</div>
							<div class = "row mb-3">
								<label for = "">Remarks <span style = "font-style: italic">(e.g WALKIN, C/O etc.
		                                                                                        .)</span></label>
								<div class = "col">
									<input name = "remarks" type = "text" class = "form-control" required>
								</div>
							</div>
					</div>
				</div>
				<div class = "modal-footer">
					<button type = "button" class = "btn btn-secondary btn-sm" data-bs-dismiss = "modal">Close</button>
					<button type = "submit" class = "btn btn-primary btn-sm" name = "save_request">Save changes</button>
				</div>
				</form>
			</div>
		</div>
	</div>
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
    
    if ( isset( $_POST[ 'save_request' ] ) ) {
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
        $assistance = $_POST[ 'assistance' ];
        $remarks = $_POST[ 'remarks' ];
        
        // Prepare statement to insert request
        $stmt = $con -> prepare ( "INSERT INTO `request_tbl` (`r_name`, `r_phone`, `r_brgy`, `r_municipality`, `name_of_patient`, `age`, `hospital`, `diagnosis`,`type_of_assistance`, `amount_being_request`, `amount_being_request_in_words`,`remarks`, `r_date_requested`, `r_date_updated`, `r_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?, current_timestamp(), NULL, 'pending')" );
        $stmt -> bind_param ( "ssssssssssss", $name, $phone, $brgy, $mun, $patient, $p_age, $hospital, $diagnosis,
	        $assistance,
	        $request_amt, $amount_in_words, $remarks );
        
        if ( $stmt -> execute () ) {
            $last_id = mysqli_insert_id ( $con );
            $upload_folder = '../upload/';
            $files = $_FILES[ 'requirements' ];
            $file_count = count ( $files[ 'name' ] );
            
            for ( $i = 0; $i < $file_count; $i ++ ) {
                $filename = basename ( $files[ 'name' ][ $i ] );
                $upload_path = $upload_folder . $filename;
                $tmp_name = $files[ 'tmp_name' ][ $i ];
                
                $extension = pathinfo ( $filename, PATHINFO_EXTENSION );
                $allowed_types = array ( 'pdf', 'docx', 'jpg', 'png' );
                if ( in_array ( $extension, $allowed_types ) ) {
                    if ( move_uploaded_file ( $tmp_name, $upload_path ) ) {
                        $save_req = mysqli_query ( $con, "INSERT INTO `r_request_requirements_tbl` (`r_id`, `filename`, `path`) VALUES ('$last_id', '$filename', '$upload_path')" );
                        if ( !$save_req ) {
                            echo '<script>alert("Error saving file information.")</script>';
                        }
                    } else {
                        echo '<script>alert("File upload error.")</script>';
                    }
                } else {
                    echo '<script>alert("Invalid file type.")</script>';
                }
            }
            echo '<script>alert("Request saved successfully.");window.open("requestors.php", "_self")</script>';
        } else {
            echo '<script>alert("Error creating request: " . $stmt->error);</script>';
        }
    }
    
    //save update
    if ( isset( $_POST[ 'save_update' ] ) ) {
        $rid = $_POST[ 'r_id' ];
        $stat = $_POST[ 'stat' ];
        $code = $_POST['code'];
        $comment = $_POST[ 'comment' ];
        $proponent = $_POST[ 'proponent' ];
        
        $get_amount = mysqli_query ($con,"SELECT * FROM `request_tbl` where r_id='$rid'");
        if(mysqli_num_rows ($get_amount)>0){
        	$n=mysqli_fetch_assoc ($get_amount);
        }
        
        $update = mysqli_query ( $con, "UPDATE `request_tbl` SET `code`='$code',`r_date_updated` = current_timestamp(), `r_status` = '$stat',r_comment='$comment',`paid`='".$n['amount_being_request']."', `proponent`='$proponent' WHERE `request_tbl`.`r_id` = '$rid'" );
        
        if ( $update ) {
            echo '<script>alert("Status updated.");window.open("requestors.php","_self")</script>';
        }
    }
?>
    
