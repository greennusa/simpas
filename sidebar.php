<?php
    // Ambil nilai 'page' dari URL query string
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-left d-none d-md-inline mt-4 ml-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <div class="sidebar-card d-none d-lg-flex">
        <div class="flex">
            <img class="sidebar-card-illustration mb-2" src="assets/img/pp.png">
            <p class="text-center mb-2 text-capitalize">
                Logged in as <?php echo $_SESSION['level'] ?>
            </p>
        </div>

    </div>
    
    <!-- Dashboard Link -->
    <li class="nav-item <?php echo $currentPage === 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php">
            <span>Dashboard</span>
        </a>
    </li>
    <?php if($_SESSION['level'] == 'admin'): ?>
    <!-- Data Master Links -->
    <li
        class="nav-item <?php echo in_array($currentPage, ['satuan', 'gedung', 'biro', 'kategori', 'barang', 'ruangan', 'user', 'dosen']) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="admin.php?page=satuan">Satuan</a>
                <a class="collapse-item" href="admin.php?page=gedung">Gedung</a>
                <a class="collapse-item" href="admin.php?page=satuan-kerja">Satuan Kerja</a>
                <a class="collapse-item" href="admin.php?page=merek">Merek</a>
                <a class="collapse-item" href="admin.php?page=kategori">Kategori</a>
                <a class="collapse-item" href="admin.php?page=barang">Barang</a>
                <a class="collapse-item" href="admin.php?page=ruangan">Ruangan</a>
                <a class="collapse-item" href="admin.php?page=dosen">Dosen</a>
                <a class="collapse-item" href="admin.php?page=user">User</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Peminjaman Ruangan Link -->
    <li class="nav-item <?php echo $currentPage === 'peminjaman-ruangan' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php?page=peminjaman-ruangan">
            <span>Peminjaman Ruangan</span>
        </a>
    </li>

    <!-- Peminjaman Barang Link -->
    <li class="nav-item <?php echo $currentPage === 'peminjaman-barang' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php?page=peminjaman-barang">
            <span>Peminjaman Barang</span>
        </a>
    </li>

    <!-- Pengaduan Link -->
    <li class="nav-item <?php echo $currentPage === 'pengaduan' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php?page=pengaduan">
            <span>Pengaduan Pelayanan</span>
        </a>
    </li>

    <?php if($_SESSION['level'] == 'admin'): ?>
    <!-- User Link -->
    <li class="nav-item <?php echo $currentPage === 'admin' ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php?page=admin">
            <span>Admin</span>
        </a>
    </li>
    <?php endif; ?>
    <!-- Logout menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <span>Logout</span>
            <i class="fas fa-fw fa-sign-out-alt"></i>

        </a>
    </li>

</ul>