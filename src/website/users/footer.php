
<!-- ======= Footer ======= -->
<footer id="footer" class="footer" >
    <div class="copyright">
        <strong><a href="https://www.facebook.com/p/Provincial-Health-Office-Laguna-100042049916947/">Laguna Provincial Health Office</a>&nbsp;</strong>&copy; Copyright&nbsp;</span>@
        <a href="https://bit.ly/edsfreelancing" target="_blank"><?=date("Y")?></a>. All Rights Reserved
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.min.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<!--<script src="../assets/js/loader.js"></script>-->
<script type="text/javascript" src="../assets/js/pdfmake.min.js"></script>
<script type="text/javascript" src="../assets/js/html2canvas.min.js"></script>
<script src="../assets/js/error.js"></script>
<script src="../assets/js/main.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.1.0/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/luxon/2.3.1/luxon.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<!--script for table and PST-->

<!--// report of consolidated coordinator per municipality-->
<script>
    $(document).ready(function () {
        var table = $('#manageTableCoordinator').DataTable({
            dom: 'Blftip',
            buttons: [
                {
                    text: 'Export to PDF',
                    action: function (e, dt, button, config) {
                        var data = dt.buttons.exportData();
                        var headers = dt.columns().header().toArray().map(function(header) {
                            return $(header).text();
                        });

                        // Remove the last header (Action column)
                        headers.pop();

                        var body = [];
                        body.push(headers);

                        data.body.forEach(function(row) {
                            var rowData = [];
                            row.pop();
                            row.forEach(function(cell) {
                                rowData.push({ text: cell, alignment: 'left' });
                            });
                            body.push(rowData);
                        });

                        var docDefinition = {
                            content: [
                                { text: 'Province of Laguna Coordinator/s', style: 'title', alignment: 'center' },
                                {
                                    table: {
                                        headerRows: 1,
                                        body: body
                                    },
                                    layout: {
                                        hLineWidth: function(i, node) {
                                            return (i === 1) ? 1 : 0;
                                        },
                                        vLineWidth: function(i, node) {
                                            return 0;
                                        },
                                        hLineColor: function(i, node) {
                                            return (i === 1) ? 'black' : 'white';
                                        }
                                    }
                                }
                            ],
                            styles: {
                                title: {
                                    fontSize: 15,
                                    bold: true,
                                    margin: [0, 0, 0, 10]
                                },
                                tableHeader: {
                                    bold: true,
                                    alignment: 'left'
                                },
                                tableBody: {
                                    fontSize: 12,
                                    bold:false,
                                    alignment: 'left'
                                }

                            },
                            defaultStyle: {
                                alignment: 'left'
                            }
                        };

                        // Apply table header styles
                        for (var i = 0; i < docDefinition.content[1].table.body[0].length; i++) {
                            docDefinition.content[1].table.body[0][i] = { text: docDefinition.content[1].table.body[0][i], style: 'tableHeader' };
                        }

                        pdfMake.createPdf(docDefinition).open();
                    }
                }
            ]
        });
    });
</script>

<!--//report for requestor-->
<script>
	$ ( document ).ready ( function () {
		var table = $ ( '#manageTableRequest' ).DataTable ( {
			scrollX : true,
			dom : 'Blftip' ,
			buttons : [
				{
					text : 'Export to PDF' ,
					action : function ( e , dt , button , config ) {
						var data = dt.buttons.exportData ();
						var headers = [ 'DATE' , 'CODE' , 'HOSPITAL' , 'NAME OF PATIENT' , 'AGE' ,
							'ADDRESS' , 'DIAGNOSIS' , 'TYPE OF ASSISTANCE' , 'AMOUNT' , 'AMOUNT IN WORDS' , 'REMARKS' ,
							'USED GL' , 'PAID' ];
						
						var body = [];
						body.push ( headers );
						
						data.body.forEach ( function ( row ) {
							var rowData = [
								row[ 1 ] ,  // DATE
								row[ 2 ] ,  // CODE
								row[ 3 ] ,  // HOSPITAL
								row[ 5 ] ,  // NAME OF PATIENT
								row[ 6 ] ,  // AGE
								row[ 7 ] ,  // ADDRESS
								row[ 8 ] ,  // DIAGNOSIS
								row[ 9 ] ,  // TYPE OF ASSISTANCE
								row[ 10 ] , // AMOUNT
								row[ 11 ] , // AMOUNT IN WORDS
								row[ 12 ] , // REMARKS
								row[ 13 ] , // USED GL
								row[ 14 ]  // PAID
							];
							body.push ( rowData );
						} );
						
						// Get the current date in a readable format
						var currentDate = new Date ();
						var formattedDate = currentDate.toLocaleDateString ( 'en-US' , {
							year : 'numeric' ,
							month : 'long' ,
							day : 'numeric'
						} );
						
						var docDefinition = {
							pageOrientation : 'landscape' , // Set PDF orientation to landscape
							pageSize : 'A4' ,
							content : [
								{
									text : 'List of Requester - as of ' + formattedDate ,
									style : 'title' ,
									fontSize : '12' ,
									alignment : 'center'
								} ,
								{
									table : {
										headerRows : 1 ,
										body : body
									} ,
									layout : {
										hLineWidth : function ( i , node ) {
											return ( i === 1 ) ? 1 : 0;
										} ,
										vLineWidth : function ( i , node ) {
											return 0;
										} ,
										hLineColor : function ( i , node ) {
											return ( i === 1 ) ? 'black' : 'white';
										}
									}
								}
							] ,
							styles : {
								title : {
									fontSize : 15 ,
									bold : true ,
									margin : [ 0 , 0 , 0 , 10 ]
								} ,
								tableHeader : {
									bold : true ,
									fontSize : 8 , // Header font size set to 8
									alignment : 'left'
								} ,
								tableBody : {
									fontSize : 8 , // Body font size set to 8
									bold : false ,
									alignment : 'left'
								}
							} ,
							defaultStyle : {
								fontSize : 8 , // Default font size set to 8 for all content
								alignment : 'left'
							} ,
							// Page Breaks: Automatically create new pages if the content overflows
							pageBreakBefore : function ( currentNode , followingNodesOnPage , nodesOnNextPage , previousNodesOnPage ) {
								return currentNode.startPosition.top + currentNode.height > 700;
							}
						};
						
						// Apply table header styles
						for ( var i = 0 ; i < docDefinition.content[ 1 ].table.body[ 0 ].length ; i ++ ) {
							docDefinition.content[ 1 ].table.body[ 0 ][ i ] = {
								text : docDefinition.content[ 1 ].table.body[ 0 ][ i ] ,
								style : 'tableHeader'
							};
						}
						
						pdfMake.createPdf ( docDefinition ).open ();
					}
				},
				{
					text : 'Export to Excel' ,
					action : function ( e , dt , button , config ) {
						var data = dt.buttons.exportData ();
						var headers = [ 'DATE' , 'CODE' , 'HOSPITAL' , 'NAME OF PATIENT' , 'AGE' ,
							'ADDRESS' , 'DIAGNOSIS' , 'TYPE OF ASSISTANCE' , 'AMOUNT' , 'AMOUNT IN WORDS' , 'REMARKS' ,
							'USED GL' , 'PAID' ];
						
						var body = [];
						body.push ( headers );
						
						data.body.forEach ( function ( row ) {
							var rowData = [
								row[ 1 ] ,  // DATE
								row[ 2 ] ,  // CODE
								row[ 3 ] ,  // HOSPITAL
								row[ 5 ] ,  // NAME OF PATIENT
								row[ 6 ] ,  // AGE
								row[ 7 ] ,  // ADDRESS
								row[ 8 ] ,  // DIAGNOSIS
								row[ 9 ] ,  // TYPE OF ASSISTANCE
								row[ 10 ] , // AMOUNT
								row[ 11 ] , // AMOUNT IN WORDS
								row[ 12 ] , // REMARKS
								row[ 13 ] , // USED GL
								row[ 14 ]  // PAID
							];
							body.push ( rowData );
						} );
						
						// Get the current date and format it for the header
						var currentDate = new Date ();
						var year = currentDate.getFullYear ();
						var month = ( currentDate.getMonth () + 1 ).toString ().padStart ( 2 , '0' ); // MM format
						var rowCount = body.length - 1; // Exclude header row
						var monthNames = [ "JANUARY" , "FEBRUARY" , "MARCH" , "APRIL" , "MAY" , "JUNE" , "JULY" , "AUGUST" , "SEPTEMBER" , "OCTOBER" , "NOVEMBER" , "DECEMBER" ];
						var monthName = monthNames[ currentDate.getMonth () ]; // Full month name
						var day = currentDate.getDate ();
						
						// Create the custom header
						var customHeader = `ORS # ${ year }-${ month }-${ rowCount } ${ monthName } ${ day }, ${ year }`;
						
						// Create the workbook
						var wb = XLSX.utils.book_new ();
						
						// Add the custom header as the first row
						var headerRow = [ customHeader ];
						var wsData = [ headerRow ].concat ( body ); // Combine custom header with the rest of the data
						
						var ws = XLSX.utils.aoa_to_sheet ( wsData );
						XLSX.utils.book_append_sheet ( wb , ws , 'Requests' );
						
						// Adjust column widths based on content length
						const colWidths = [];
						
						// Set widths based on maximum length of data in each column
						for ( let i = 0 ; i < headers.length ; i ++ ) {
							let maxWidth = headers[ i ].length; // Start with header length
							for ( let j = 1 ; j < wsData.length ; j ++ ) { // Start from row 1 to skip the header
								if ( wsData[ j ][ i ] && wsData[ j ][ i ].toString ().length > maxWidth ) {
									maxWidth = wsData[ j ][ i ].toString ().length; // Update maxWidth if data is longer
								}
							}
							colWidths[ i ] = { wpx : maxWidth * 10 }; // 10 pixels per character, adjust as needed
						}
						
						ws[ '!cols' ] = colWidths; // Set the column widths
						
						// Apply styles to custom header
						ws[ 'A1' ] = {
							v : customHeader ,
							s : { font : { bold : true } , alignment : { horizontal : "left" } }
						};
						
						// Set header styles for column labels
						for ( let i = 0 ; i < headers.length ; i ++ ) {
							const cellAddress = XLSX.utils.encode_cell ( { r : 1 , c : i } ); // Row index 1 for the header
							ws[ cellAddress ] = {
								v : headers[ i ] ,
								s : {
									font : { bold : true } , border : {
										top : { style : 'thin' , color : 'black' } ,
										bottom : { style : 'thin' , color : 'black' } ,
										left : { style : 'thin' , color : 'black' } ,
										right : { style : 'thin' , color : 'black' }
									}
								}
							};
						}
						
						// Apply border to all data cells
						for ( let r = 2 ; r < wsData.length ; r ++ ) { // Start from row 2 to skip header
							for ( let c = 0 ; c < wsData[ r ].length ; c ++ ) {
								const cellAddress = XLSX.utils.encode_cell ( { r : r , c : c } );
								ws[ cellAddress ] = {
									v : wsData[ r ][ c ] ,
									s : {
										border : {
											top : { style : 'thin' , color : 'black' } ,
											bottom : { style : 'thin' , color : 'black' } ,
											left : { style : 'thin' , color : 'black' } ,
											right : { style : 'thin' , color : 'black' }
										}
									}
								};
							}
						}
						
						// Save the Excel file
						XLSX.writeFile ( wb , 'Requests.xlsx' );
					}
				}
			]
		} );
	} );
</script>

<script>
    $(document).ready(function () {
        $('#manageTable').DataTable({
		        scrollX : true
        });
    });
</script>

<?php include '../includes/utilities_button.php'; ?>

</body>

</html>
