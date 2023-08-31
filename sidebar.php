<?php
    // Ambil nilai 'page' dari URL query string
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
        <div class="sidebar-brand-text mx-3">SIMPAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard Link -->
    <li class="nav-item <?php echo $currentPage === 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Data Master Links -->
    <li class="nav-item <?php echo in_array($currentPage, ['kategori', 'barang', 'ruangan', 'mahasiswa']) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="admin.php?page=kategori">Kategori</a>
                <a class="collapse-item" href="admin.php?page=barang">Barang</a>
                <a class="collapse-item" href="admin.php?page=ruangan">Ruangan</a>
                <a class="collapse-item" href="admin.php?page=mahasiswa">Mahasiswa</a>
            </div>
        </div>
    </li>

    <!-- Pengaduan Link -->
    <li class="nav-item <?php echo $currentPage === 'pengaduan' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php?page=pengaduan">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Pengaduan</span>
        </a>
    </li>

    <!-- Peminjaman Barang Link -->
    <li class="nav-item <?php echo $currentPage === 'peminjaman-barang' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php?page=peminjaman-barang">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Peminjaman Barang</span>
        </a>
    </li>

    <!-- Peminjaman Ruangan Link -->
    <li class="nav-item <?php echo $currentPage === 'peminjaman-ruangan' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php?page=peminjaman-ruangan">
            <i class="fas fa-fw fa-industry"></i>
            <span>Peminjaman Ruangan</span>
        </a>
    </li>

    <!-- User Link -->
    <li class="nav-item <?php echo $currentPage === 'user' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php?page=user">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
