<?php
ob_start();
error_reporting(0);
session_start();
include __DIR__ . "/../connection.php";

if (!isset($_SESSION['accnt_id'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query(
    $con,
    "SELECT 
        SUM(CASE WHEN r_status = 'pending' THEN 1 ELSE 0 END) AS total_pending,
        SUM(CASE WHEN r_status = 'approved' THEN 1 ELSE 0 END) AS total_approved,
        SUM(CASE WHEN r_status = 'disapproved' THEN 1 ELSE 0 END) AS total_disapproved,
        SUM(amount_being_request) AS total_requested,
        SUM(CASE WHEN r_status = 'approved' THEN amount_being_request ELSE 0 END) AS total_approved_amount,
        AVG(amount_being_request) AS avg_request_amount
    FROM request_tbl"
);

$analyticsData = [
    'total_pending' => 0,
    'total_approved' => 0,
    'total_disapproved' => 0,
    'total_requested' => 0,
    'total_approved_amount' => 0,
    'avg_request_amount' => 0,
    'top_request_type' => 'None',
    'top_request_type_count' => 0
];

if ($result && $row = mysqli_fetch_assoc($result)) {
    $analyticsData['total_pending'] = $row['total_pending'];
    $analyticsData['total_approved'] = $row['total_approved'];
    $analyticsData['total_disapproved'] = $row['total_disapproved'];
    $analyticsData['total_requested'] = $row['total_requested'];
    $analyticsData['total_approved_amount'] = $row['total_approved_amount'];
    $analyticsData['avg_request_amount'] = $row['avg_request_amount'];
}

$topRequestType = mysqli_query(
    $con,
    "SELECT type_of_assistance, COUNT(*) AS count 
     FROM request_tbl 
     GROUP BY type_of_assistance 
     ORDER BY count DESC 
     LIMIT 1"
);

if ($topRequestType && mysqli_num_rows($topRequestType) > 0) {
    $typeData = mysqli_fetch_assoc($topRequestType);
    $analyticsData['top_request_type'] = $typeData['type_of_assistance'];
    $analyticsData['top_request_type_count'] = $typeData['count'];
}

$municipalityData = [];
$municipalityQuery = mysqli_query(
    $con,
    "SELECT r_municipality, COUNT(*) AS count 
     FROM request_tbl 
     GROUP BY r_municipality 
     ORDER BY count DESC 
     LIMIT 10"
);

if ($municipalityQuery && mysqli_num_rows($municipalityQuery) > 0) {
    while ($row = mysqli_fetch_assoc($municipalityQuery)) {
        $municipalityData[] = $row;
    }
}

$ageDistribution = [
    '0-18' => 0,
    '19-40' => 0,
    '41-60' => 0,
    '61+' => 0
];

$ageResult = mysqli_query(
    $con,
    "SELECT 
        SUM(age <= 18) AS age_0_18,
        SUM(age > 18 AND age <= 40) AS age_19_40,
        SUM(age > 40 AND age <= 60) AS age_41_60,
        SUM(age > 60) AS age_61_plus
    FROM request_tbl"
);

if ($ageResult && $row = mysqli_fetch_assoc($ageResult)) {
    $ageDistribution = [
        '0-18' => $row['age_0_18'],
        '19-40' => $row['age_19_40'],
        '41-60' => $row['age_41_60'],
        '61+' => $row['age_61_plus']
    ];
}

$diagnosisStats = [];
$diagnosisQuery = mysqli_query(
    $con,
    "SELECT diagnosis, COUNT(*) AS count, AVG(amount_being_request) AS avg_amount 
     FROM request_tbl 
     GROUP BY diagnosis 
     ORDER BY count DESC"
);

if ($diagnosisQuery && mysqli_num_rows($diagnosisQuery) > 0) {
    while ($row = mysqli_fetch_assoc($diagnosisQuery)) {
        $diagnosisStats[] = $row;
    }
}

$monthlyExpenditure = array_fill(0, 12, 0);
$expenditureQuery = mysqli_query(
    $con,
    "SELECT MONTH(used_gl) AS month, SUM(amount_being_request) AS total 
     FROM request_tbl 
     WHERE r_status = 'approved' AND used_gl IS NOT NULL 
     GROUP BY MONTH(used_gl)"
);

if ($expenditureQuery && mysqli_num_rows($expenditureQuery) > 0) {
    while ($row = mysqli_fetch_assoc($expenditureQuery)) {
        if ($row['month'] >= 1 && $row['month'] <= 12) {
            $monthlyExpenditure[$row['month'] - 1] = $row['total'];
        }
    }
}

$requestTrends = [];
$months = [];
for ($i = 5; $i >= 0; $i--) {
    $months[] = date('Y-m', strtotime("-$i months"));
}

$placeholders = implode("','", $months);
$trendQuery = mysqli_query(
    $con,
    "SELECT 
        DATE_FORMAT(r_date_requested, '%Y-%m') AS month, 
        COUNT(*) AS count 
    FROM request_tbl 
    WHERE DATE_FORMAT(r_date_requested, '%Y-%m') IN ('$placeholders')
    GROUP BY month"
);

$trendData = [];
if ($trendQuery) {
    while ($row = mysqli_fetch_assoc($trendQuery)) {
        $trendData[$row['month']] = $row['count'];
    }
}

foreach ($months as $month) {
    $requestTrends[] = [
        'month' => date('M Y', strtotime($month)),
        'count' => $trendData[$month] ?? 0
    ];
}

$topMunicipalities = [];
$topMunQuery = mysqli_query(
    $con,
    "SELECT r_municipality, COUNT(*) AS count 
     FROM request_tbl 
     GROUP BY r_municipality 
     ORDER BY count DESC 
     LIMit 5"
);

if ($topMunQuery && mysqli_num_rows($topMunQuery) > 0) {
    while ($row = mysqli_fetch_assoc($topMunQuery)) {
        $topMunicipalities[] = $row;
    }
}

$totalRequests = $analyticsData['total_pending'] + $analyticsData['total_approved'] + $analyticsData['total_disapproved'];
$approvalRate = ($totalRequests > 0) ?
    ($analyticsData['total_approved'] / $totalRequests) * 100 : 0;

$assistanceTypes = [];
$typeQuery = mysqli_query(
    $con,
    "SELECT type_of_assistance, COUNT(*) AS count 
     FROM request_tbl 
     GROUP BY type_of_assistance 
     ORDER BY count DESC 
     LIMIT 5"
);

if ($typeQuery && mysqli_num_rows($typeQuery) > 0) {
    while ($row = mysqli_fetch_assoc($typeQuery)) {
        $assistanceTypes[] = $row;
    }
}
?>
<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Analytics Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Analytics</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Summary Cards -->
            <div class="col-lg-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Applications</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $analyticsData['total_pending'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Approved Applications</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $analyticsData['total_approved'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Disapproved Applications</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $analyticsData['total_disapproved'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Overview -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Expenditure</h5>
                        <div style="height: 300px; position: relative;">
                            <canvas id="expenditureChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Financial Summary</h5>
                        <div class="mb-3">
                            <h6>Total Amount Requested</h6>
                            <h4>₱ <?= number_format($analyticsData['total_requested'], 2) ?></h4>
                        </div>
                        <div class="mb-3">
                            <h6>Total Amount Approved</h6>
                            <h4>₱ <?= number_format($analyticsData['total_approved_amount'], 2) ?></h4>
                        </div>
                        <div class="mb-3">
                            <h6>Average Request Amount</h6>
                            <h4>₱ <?= number_format($analyticsData['avg_request_amount'], 2) ?></h4>
                        </div>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Top Request Type:</strong>
                            <?= $analyticsData['top_request_type'] ?>
                            (<?= $analyticsData['top_request_type_count'] ?> requests)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Municipality Analysis -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Requests by Municipality</h5>
                        <div style="height: 300px; position: relative;">
                            <canvas id="municipalityChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Municipality Performance</h5>
                        <div class="mb-4">
                            <h6>Top Municipalities by Requests</h6>
                            <div class="d-flex flex-wrap mt-3">
                                <?php foreach ($topMunicipalities as $municipality): ?>
                                    <span class="badge bg-primary me-2 mb-2">
                                        <i class="bi bi-geo-alt"></i>
                                        <?= $municipality['r_municipality'] ?>
                                        (<?= $municipality['count'] ?>)
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6>Overall Approval Rate</h6>
                            <div class="progress mt-2" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: <?= $approvalRate ?>%">
                                    <?= number_format($approvalRate, 1) ?>%
                                </div>
                            </div>
                            <small class="text-muted">Based on current data</small>
                        </div>
                        <div class="alert alert-warning mt-4">
                            <i class="bi bi-lightbulb"></i>
                            <strong>Recommendation:</strong> Focus outreach efforts on municipalities with high request
                            volumes.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Request Trends -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Volume Over Time</h5>
                        <div style="height: 300px; position: relative;">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Analysis</h5>
                        <div class="mb-4">
                            <h6>Top Assistance Types</h6>
                            <ul class="list-group">
                                <?php foreach ($assistanceTypes as $type): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $type['type_of_assistance'] ?>
                                        <span class="badge bg-primary rounded-pill"><?= $type['count'] ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Patient Demographics -->
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Age Distribution</h5>
                        <div style="height: 300px; position: relative;">
                            <canvas id="ageChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Patient Statistics</h5>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-success text-white p-3 rounded-circle me-3">
                                        <i class="bi bi-heart-pulse" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Top Diagnosis</h6>
                                        <?php if (!empty($diagnosisStats)): ?>
                                            <h4 class="mb-0"><?= $diagnosisStats[0]['diagnosis'] ?></h4>
                                            <small class="text-muted"><?= $diagnosisStats[0]['count'] ?> cases</small>
                                        <?php else: ?>
                                            <h4 class="mb-0">No data</h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Diagnosis</th>
                                        <th>Count</th>
                                        <th>Avg. Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($diagnosisStats as $diagnosis): ?>
                                        <tr>
                                            <td><?= $diagnosis['diagnosis'] ?></td>
                                            <td><?= $diagnosis['count'] ?></td>
                                            <td>₱ <?= number_format($diagnosis['avg_amount'], 2) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Preload chart data in PHP -->
<script>
    const chartData = {
        expenditure: <?= json_encode(array_map('floatval', $monthlyExpenditure)) ?>,
        municipalities: {
            labels: <?= json_encode(array_column($municipalityData, 'r_municipality')) ?>,
            counts: <?= json_encode(array_column($municipalityData, 'count')) ?>
        },
        trends: {
            labels: <?= json_encode(array_column($requestTrends, 'month')) ?>,
            counts: <?= json_encode(array_column($requestTrends, 'count')) ?>
        },
        ages: {
            labels: <?= json_encode(array_keys($ageDistribution)) ?>,
            counts: <?= json_encode(array_values($ageDistribution)) ?>
        }
    };
</script>

<!-- Load Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Dark mode fixes for analytics page */
    .dark-mode .card {
        background-color: rgba(36, 36, 36, 0.95) !important;
        border: 1px solid #333 !important;
    }

    .dark-mode .card-title {
        color: #e0e0e0 !important;
    }

    .dark-mode .table {
        --bs-table-bg: #1e1e1e;
        --bs-table-color: #e0e0e0;
        --bs-table-border-color: #333;
    }

    .dark-mode .alert {
        background-color: rgba(30, 30, 30, 0.8);
        border-color: #444;
    }

    .dark-mode .list-group-item {
        background-color: #1e1e1e;
        border-color: #333;
        color: #e0e0e0 !important;
    }

    .dark-mode .progress {
        background-color: #333;
    }

    .dark-mode .badge {
        color: white !important;
    }

    /* FIX FOR TABLE HEADER CONTRAST */
    .dark-mode thead.table-primary th {
        background-color: #4154f1 !important;
        color: white !important;
        border-color: #555 !important;
    }

    .dark-mode .table-primary {
        --bs-table-bg: #1e1e1e;
        --bs-table-striped-bg: #222;
        --bs-table-striped-color: #fff;
        --bs-table-active-bg: #2a2a2a;
        --bs-table-active-color: #fff;
        --bs-table-hover-bg: #2a2a2a;
        --bs-table-hover-color: #fff;
        color: #e0e0e0;
        border-color: #444;
    }

    .dark-mode .table-hover tbody tr:hover {
        background-color: #2a2a2a !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check if dark mode is enabled
        const isDarkMode = document.body.classList.contains('dark-mode');

        // Function to initialize charts with dark mode support
        function initChart(elementId, config) {
            const ctx = document.getElementById(elementId).getContext('2d');
            return new Chart(ctx, {
                ...config,
                options: {
                    ...config.options,
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        // Define colors based on dark mode
        const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
        const tickColor = isDarkMode ? '#e0e0e0' : '#666';
        const tooltipBg = isDarkMode ? 'rgba(30, 30, 30, 0.9)' : 'rgba(255, 255, 255, 0.9)';
        const tooltipText = isDarkMode ? '#fff' : '#333';

        // Expenditure Chart
        initChart('expenditureChart', {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Amount Disbursed (₱)',
                    data: chartData.expenditure,
                    backgroundColor: isDarkMode ? 'rgba(86, 156, 214, 0.7)' : 'rgba(37, 99, 235, 0.7)',
                    borderColor: isDarkMode ? 'rgba(86, 156, 214, 1)' : 'rgba(37, 99, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: tooltipBg,
                        titleColor: tooltipText,
                        bodyColor: tooltipText,
                        callbacks: {
                            label: function (context) {
                                return '₱ ' + context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: tickColor },
                        grid: { color: gridColor }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: tickColor,
                            callback: function (value) {
                                return '₱ ' + value.toLocaleString();
                            }
                        },
                        grid: { color: gridColor }
                    }
                }
            }
        });

        // Municipality Chart
        initChart('municipalityChart', {
            type: 'doughnut',
            data: {
                labels: chartData.municipalities.labels,
                datasets: [{
                    data: chartData.municipalities.counts,
                    backgroundColor: [
                        'rgba(37, 99, 235, 0.8)',
                        'rgba(29, 78, 216, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(96, 165, 250, 0.8)',
                        'rgba(147, 197, 253, 0.8)',
                        'rgba(191, 219, 254, 0.8)',
                        'rgba(219, 234, 254, 0.8)',
                        'rgba(239, 246, 255, 0.8)',
                        'rgba(224, 242, 254, 0.8)',
                        'rgba(241, 245, 249, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { color: tickColor }
                    },
                    tooltip: {
                        backgroundColor: tooltipBg,
                        titleColor: tooltipText,
                        bodyColor: tooltipText,
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ${context.raw} requests`;
                            }
                        }
                    }
                }
            }
        });

        // Trend Chart
        initChart('trendChart', {
            type: 'line',
            data: {
                labels: chartData.trends.labels,
                datasets: [{
                    label: 'Requests',
                    data: chartData.trends.counts,
                    borderColor: 'rgba(37, 99, 235, 1)',
                    backgroundColor: isDarkMode ? 'rgba(86, 156, 214, 0.3)' : 'rgba(37, 99, 235, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { color: tickColor }
                    },
                    tooltip: {
                        backgroundColor: tooltipBg,
                        titleColor: tooltipText,
                        bodyColor: tooltipText
                    }
                },
                scales: {
                    x: {
                        ticks: { color: tickColor },
                        grid: { color: gridColor }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: tickColor,
                            precision: 0
                        },
                        grid: { color: gridColor }
                    }
                }
            }
        });

        // Age Distribution Chart
        initChart('ageChart', {
            type: 'pie',
            data: {
                labels: chartData.ages.labels,
                datasets: [{
                    data: chartData.ages.counts,
                    backgroundColor: [
                        'rgba(147, 51, 234, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: tickColor }
                    },
                    tooltip: {
                        backgroundColor: tooltipBg,
                        titleColor: tooltipText,
                        bodyColor: tooltipText,
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ${context.raw} patients`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<?php include "footer.php"; ?>
<?php ob_end_flush(); ?>