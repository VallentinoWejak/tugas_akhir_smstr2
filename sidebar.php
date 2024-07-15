<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-biohazard"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Covid 19</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        TENTANG COVID
    </div>

    <?php
    session_start();
    $isLoggedIn = isset($_SESSION['email']);
    ?>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo $isLoggedIn ? 'tables_admin.php' : 'tables.php'; ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span>
        </a>
    </li>


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="tentang.php">
            <i class="fas fa-fw fa-cog"></i>
            <span>Tentang Covid 19</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <?php 
    if (isset($_SESSION['email'])) {
        // Jika sudah login, tidak perlu menampilkan menu login
    } else {
        // Jika belum login, tampilkan menu login
    ?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">
                <i class="fas fa-fw fa-user"></i>
                <span>Login Admin</span></a>
        </li>
    <?php } ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>