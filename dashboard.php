<?php
    // Menghitung total barang
    $sql_count_items = "SELECT COUNT(*) as total FROM barang";
    $result_count_items = $conn->query($sql_count_items);
    $row_count_items = $result_count_items->fetch_assoc();
    $count_items = $row_count_items['total'];


    // Menghitung total barang yang dipinjam
    $sql_count_borrowed_items = "SELECT COUNT(*) as total FROM peminjaman_barang WHERE status='Approved'";
    $result_count_borrowed_items = $conn->query($sql_count_borrowed_items);
    $row_count_borrowed_items = $result_count_borrowed_items->fetch_assoc();
    $count_borrowed_items = $row_count_borrowed_items['total'];

    // Menghitung total ruangan yang terpinjam
    $sql_count_booked_rooms = "SELECT COUNT(*) as total FROM peminjaman_ruangan WHERE status='Approved'";
    $result_count_booked_rooms = $conn->query($sql_count_booked_rooms);
    $row_count_booked_rooms = $result_count_booked_rooms->fetch_assoc();
    $count_booked_rooms = $row_count_booked_rooms['total'];

    // Menghitung total pengaduan
    $sql_count_complaints = "SELECT COUNT(*) as total FROM pengaduan";
    $result_count_complaints = $conn->query($sql_count_complaints);
    $row_count_complaints = $result_count_complaints->fetch_assoc();
    $count_complaints = $row_count_complaints['total'];
?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Barang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_items ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Barang Terpinjam</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_borrowed_items ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Ruangan Terpinjam</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_booked_rooms ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Jumlah Pengaduan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_complaints ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

</div>