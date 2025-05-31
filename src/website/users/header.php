<?php
$output ="";
include "../connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add this script in your header.php file right after opening <head> tag -->
    <script>
    // Immediately check dark mode state before page renders
    (function() {
        const isDark = localStorage.getItem('darkMode') === 'enabled';
        if (isDark) {
        document.documentElement.classList.add('dark-mode');
        // Update moon icon to sun immediately
        const darkModeIcon = document.getElementById('darkModeBtn')?.querySelector('i');
        if (darkModeIcon) {
            darkModeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
        }
        }
    })();
    </script>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo strtoupper($_SESSION['type_name'])?>&nbsp;Dashboard | Laguna Provincial Health Office</title>

    <!-- Favicons -->
    <link href="../assets/img/lpho.jpg" rel="icon">

    <!-- Google Fonts -->
    <link href="../assets/font/font1.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <script type="text/javascript" src="../assets/js/charts.js"></script>
    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/custom-charts.js"></script>

    <!--    online assets-->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css" rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <?php
    // Run your SQL query
    $sql = "SELECT 
    SUM(paid) AS total_allocated_amount,
    CASE 
        WHEN EXTRACT(MONTH FROM r_date_updated) = 1 THEN 'January'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 2 THEN 'February'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 3 THEN 'March'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 4 THEN 'April'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 5 THEN 'May'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 6 THEN 'June'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 7 THEN 'July'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 8 THEN 'August'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 9 THEN 'September'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 10 THEN 'October'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 11 THEN 'November'
        WHEN EXTRACT(MONTH FROM r_date_updated) = 12 THEN 'December'
    END AS updated_month_name
FROM 
    request_tbl
WHERE
    EXTRACT(YEAR FROM r_date_updated) = EXTRACT(YEAR FROM CURRENT_DATE)
GROUP BY 
    EXTRACT(MONTH FROM r_date_updated)";


    $result = $con->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }else{
        echo "No Data";
    }
    ?>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            <?php
            if (!empty($data)) {
            ?>
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Expenditure'],
                <?php
                foreach($data as $row) {
                    echo "['" . $row['updated_month_name'] . "', " . $row['total_allocated_amount'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Expenditure',
                height: 350,
                chartArea: {width: '50%'},
                hAxis: {
                    title: 'Months',
                    titleTextStyle: {color: '#333', bold: true},
                },
                vAxis: {
                    title: 'Amount',
                    format: 'Php #,###',
                    titleTextStyle: {color: '#333', bold: true},
                },
                colors: ['#4154f1']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('reportsChart'));
            chart.draw(data, options);
            <?php
            } else {
            echo "document.getElementById('reportsChart').innerHTML = 'No data available';";
        }
            ?>
        }
    </script>
	

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="dashboard.php" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Laguna Provincial Health Office</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        <div class="search-bar">
            <span style="font-size: 18px"><strong>Record Management System </strong> |</span> <span class="badge bg-success text-light" style="font-weight: lighter"><?php echo strtoupper($_SESSION['type_name'])?></span>
        </div><!-- End Search Bar -->
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="../assets/img/user_1.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?=$_SESSION['fullname']?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?=$_SESSION['fullname']?></h6>
                        <span class="badge bg-success"><?=strtoupper($_SESSION['type_name'])?></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <?php if($_SESSION['accnt_type'] == "1"): ?>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="profile.php">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header-->