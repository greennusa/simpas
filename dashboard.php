<?php
    // Menghitung total barang
    $sql_count_items = "SELECT COUNT(*) as total FROM barang";
    $result_count_items = $conn->query($sql_count_items);
    $row_count_items = $result_count_items->fetch_assoc();
    $count_items = $row_count_items['total'];

    // Menghitung Barang yang tersedia dari tabel kolom total di tabel barang dikurangi kolom jumlah_barang di tabel peminjaman_barang dengan status Approved
    $sql_count_available_items = "SELECT SUM(total_available) as total_items
    FROM (
        SELECT (b.total - COALESCE(p.jumlah_barang, 0)) as total_available
        FROM barang b
        LEFT JOIN (
            SELECT barang_kd, SUM(jumlah_barang) as jumlah_barang
            FROM peminjaman_barang
            WHERE status = 'Approved'
            GROUP BY barang_kd
        ) p ON b.kd_barang = p.barang_kd
    ) AS subquery";
    $result_count_available_items = $conn->query($sql_count_available_items);
    $row_count_available_items = $result_count_available_items->fetch_assoc();
    $count_available_items = $row_count_available_items['total_items'];

    // Menghitung jumlah_barang yang dipinjam dari tabel peminjaman_barang dengan status Approved dan tanggal_selesai < tanggal hari ini
    $sql_count_borrowed_items = "SELECT SUM(jumlah_barang) as total_borrowed
    FROM peminjaman_barang
    WHERE status = 'Approved' AND tanggal_selesai > CURDATE()";
    $result_count_borrowed_items = $conn->query($sql_count_borrowed_items);
    $row_count_borrowed_items = $result_count_borrowed_items->fetch_assoc();
    $count_borrowed_items = $row_count_borrowed_items['total_borrowed'];

    // Menghitung total ruangan yang dipinjam dari tabel peminjaman_ruangan dengan status Approved dan tanggal_selesai < tanggal hari ini
    $sql_count_booked_rooms = "SELECT COUNT(*) as total FROM peminjaman_ruangan WHERE status = 'Approved' AND tanggal_selesai <= CURDATE()";
    $result_count_booked_rooms = $conn->query($sql_count_booked_rooms);
    $row_count_booked_rooms = $result_count_booked_rooms->fetch_assoc();
    $count_booked_rooms = $row_count_booked_rooms['total'];

    // Menghitung total pengaduan
    $sql_count_complaints = "SELECT COUNT(*) as total FROM pengaduan";
    $result_count_complaints = $conn->query($sql_count_complaints);
    $row_count_complaints = $result_count_complaints->fetch_assoc();
    $count_complaints = $row_count_complaints['total'];

    // SQL Query to get the monthly count of borrowed items for each year
    $sql_monthly_borrow = "SELECT YEAR(tanggal_peminjaman) as year, MONTH(tanggal_peminjaman) as month, COUNT(*) as count
                            FROM peminjaman_barang
                            WHERE status = 'Approved' OR status = 'Returned'
                            GROUP BY YEAR(tanggal_peminjaman), MONTH(tanggal_peminjaman)
                            ORDER BY YEAR(tanggal_peminjaman), MONTH(tanggal_peminjaman)";
    
    $result_monthly_borrow = $conn->query($sql_monthly_borrow);
    
    $data_chart = [];
    while ($row = $result_monthly_borrow->fetch_assoc()) {
        $year = $row['year'];
        $month = $row['month'];
        $count = $row['count'];
        
        $data_chart[$year][$month] = $count;
    }
    
    $data_chart_json = json_encode($data_chart);

    // SQL Query untuk mendapatkan jumlah pengaduan setiap hari di bulan ini
    $sql_complaints_by_day = "SELECT DAY(created_at) as day, COUNT(*) as count
        FROM pengaduan
        WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())
        GROUP BY DAY(created_at)
        ORDER BY DAY(created_at)";
        $result_complaints_by_day = $conn->query($sql_complaints_by_day);

    $complaints_data = [];
    while ($row = $result_complaints_by_day->fetch_assoc()) {
        $day = $row['day'];
        $count = $row['count'];
        $complaints_data[$day] = $count;
    }
    $shortMonthName = substr(date("F"), 0, 3);  // Ini akan menghasilkan "Jan" jika bulan adalah Januari, "Feb" jika Februari, dst.
    $complaints_data_json = json_encode($complaints_data);

?>

<style>
    .card:hover {
        background: #f5f5f5;
    }
</style>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-4 col-md-6 mb-4">
        <a href="admin.php?page=barang">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary mb-1">Jumlah Data Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_items ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <a href="admin.php?page=barang-tersedia">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-success mb-1">
                                Barang Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_available_items ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <a href="admin.php?page=barang-dipinjam">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning mb-1">
                                Barang Dipinjam</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_borrowed_items ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <a href="admin.php?page=ruangan-terpinjam">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-danger mb-1">
                                Ruangan Terpinjam</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_booked_rooms ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <a href="admin.php?page=pengaduan&data=all">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-info mb-1">
                                Jumlah Pengaduan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_complaints ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Peminjaman Barang</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="peminjamanBarang"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengaduan Pelayanan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pb-2">
                    <canvas id="pengaduanPelayanan"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Parse PHP array to JavaScript array
    var dataChart = JSON.parse('<?php echo $data_chart_json; ?>');
    var labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    var datasets = [];

    for (var year in dataChart) {
        var dataset = {
            label: year,
            data: [],
            fill: false,
            backgroundColor: '#0275d8',
            borderColor: '#0275d8',
        };

        for (var i = 1; i <= 12; i++) {
            dataset.data.push(dataChart[year][i] ? dataChart[year][i] : 0);
        }

        datasets.push(dataset);
    }

    var ctx = document.getElementById('peminjamanBarang').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets,
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>

<script>
    // Parse PHP array ke JavaScript array
    var complaintsData = JSON.parse('<?php echo $complaints_data_json; ?>');
    var monthName = '<?php echo $shortMonthName; ?>'; // Ambil nama bulan dari PHP

    var labels = Array.from({
        length: 31
    }, (_, i) => `${monthName} ${i + 1}`); // Label untuk setiap hari dalam sebulan, ditambahkan prefix nama bulan

    var complaintDataset = {
        label: 'Pengaduan',
        data: [],
        fill: true, // Mengaktifkan fill di bawah garis
        borderColor: '#0275d8', // Anda bisa mengganti warna ini
        backgroundColor: 'rgba(204, 227, 247, 0.5)', // Warna fill dengan opasitas 50%
    };

    for (var i = 1; i <= 31; i++) {
        complaintDataset.data.push(complaintsData[i] ? complaintsData[i] : 0);
    }

    var ctx = document.getElementById('pengaduanPelayanan').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [complaintDataset],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>