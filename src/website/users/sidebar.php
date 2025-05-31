<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <?php
    $current_page = basename($_SERVER['PHP_SELF'], ".php");
    ?>

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'index' ? 'active' : 'collapsed'; ?>" href="dashboard.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if($_SESSION['accnt_type'] == "1"): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'coordinators' ? 'active' : 'collapsed'; ?>" href="coordinators.php">
                <i class="bi bi-person"></i>
                <span>Coordinator/s</span>
            </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'requestors' ? 'active' : 'collapsed'; ?>" href="requestors.php">
                <i class="bi bi-file-arrow-down-fill"></i>
                <span>Requestor/ Patient List</span>
            </a>
        </li>
        <?php if($_SESSION['accnt_type'] == "1"): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'municipality' ? 'active' : 'collapsed'; ?>" href="municipality.php">
                <i class="bi bi-list"></i>
                <span>Municipality</span>
            </a>
        </li>
        <?php if($_SESSION['accnt_type'] == "1"): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'analytics' ? 'active' : 'collapsed'; ?>" href="../users/analytics.php">
                <i class="bi bi-bar-chart"></i>
                <span>Analytics</span>
            </a>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'logout' ? 'active' : 'collapsed'; ?>" href="../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Signout</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
