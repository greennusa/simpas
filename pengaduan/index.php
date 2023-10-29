<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pengaduan</h1>
    <?php if($_SESSION['level'] == 'user') : ?>
        <a href="admin.php?page=tambah-pengaduan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Tambah Data</a>
    <?php else: ?>
        <div>
            <a href="pengaduan/print_index.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm"> Export PDF</a>
            <a href="pengaduan/excel_index.php" target="_blank" class="mx-2 d-none d-sm-inline-block btn btn-sm btn-outline-success shadow-sm"> Export Excel</a>
            <a href="pengaduan/word_index.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"> Export Word</a>
        </div>
    <?php endif ?>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <?php if($_SESSION['level'] == 'user') { ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>File</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Tanggal Kejadian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $id_mahasiswa = $_SESSION['id'];
                    $no = 1;
                    if(isset($_GET['data']) && $_GET['data'] == 'all'){
                        $sql = mysqli_query($conn, "SELECT * FROM pengaduan ORDER BY id_pengaduan DESC");
                    } else {
                        $sql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE mahasiswa_id = '$id_mahasiswa' ORDER BY id_pengaduan DESC");
                    }
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <?php if($row['file'] != null) { ?>
                        <td><img src="pengaduan/uploads/<?php echo $row['file'] ?>" alt="Gambar" width="200px"></td>
                    <?php }else{ ?>
                        <td>-</td>
                    <?php } ?>
                    <td><?php echo $row['judul'] ?></td>
                    <td><?php echo $row['isi'] ?></td>
                    <td><?php echo $row['tgl'] ?></td>
                    <td>
                        <?php if($row['status'] == "Pending" || $row['status'] == "Rejected"){ ?>
                            <span class="badge badge-danger"><?php echo $row['status'] ?></span>
                        <?php } else if($row['status'] == 'On Progress') { ?>
                            <span class="badge badge-warning"><?php echo $row['status'] ?></span>
                        <?php }else{ ?>
                            <span class="badge badge-success"><?php echo $row['status'] ?></span>
                        <?php } ?>
                    </td>
                    <!-- <td><a class="btn btn-sm btn-outline-success" target="_blank" href="pengaduan/print_view.php?id=<?php echo $row['id_pengaduan'] ?>">Print</a></td> -->
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php }else{ ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>File</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Tanggal Kejadian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT * FROM pengaduan LEFT JOIN mahasiswa ON pengaduan.mahasiswa_id = mahasiswa.id_mahasiswa ORDER BY id_pengaduan DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nama_mahasiswa'] == '' ? '-' : $row['nama_mahasiswa']; ?></td>
                    <?php if($row['file'] != null) { ?>
                        <td><img src="pengaduan/uploads/<?php echo $row['file'] ?>" alt="Gambar" width="200px"></td>
                    <?php }else{ ?>
                        <td>-</td>
                    <?php } ?>
                    <td><?php echo $row['judul'] ?></td>
                    <td>Isi</td>
                    <td><?php echo $row['tgl'] ?></td>
                    <td>
                        <?php if($row['status'] == "Pending" || $row['status'] == "Rejected"){ ?>
                            <span class="badge badge-danger"><?php echo $row['status'] ?></span>
                        <?php } else if($row['status'] == 'On Progress') { ?>
                            <span class="badge badge-warning"><?php echo $row['status'] ?></span>
                        <?php }else{ ?>
                            <span class="badge badge-success"><?php echo $row['status'] ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($row['status'] == 'Pending'): ?>
                        <form action="" method="POST">
                            <input type="hidden" name="id_pengaduan" value="<?php echo $row['id_pengaduan'] ?>">
                            <button type="submit" class="btn btn-primary btn-sm" name="progress" onclick="return confirm('Apakah Anda yakin ingin menerima laporan ini?')">Terima Laporan</button>
                        </form>
                        <?php elseif($row['status'] == 'On Progress'): ?>
                            <form action="" method="POST">
                            <input type="hidden" name="id_pengaduan" value="<?php echo $row['id_pengaduan'] ?>">
                            <button type="submit" class="btn btn-primary btn-sm" name="selesai" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan laporan ini?')">Selesai</button>
                            <button type="submit" class="btn btn-outline-danger btn-sm" name="tolak" onclick="return confirm('Apakah Anda yakin ingin menolak laporan ini?')">Tolak Laporan</button>
                        </form>
                        <?php else: ?>
                            
                        <?php endif ?>
                        <!-- <a class="btn btn-sm btn-outline-success" target="_blank" href="pengaduan/print_view.php?id=<?php echo $row['id_pengaduan'] ?>">Print</a> -->
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php } ?>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['progress'])){
        $id_user = $_SESSION['id'];
        $status = 'On Progress';
        $id_pengaduan = $_POST['id_pengaduan'];
        // Query update data
        $sql = "UPDATE pengaduan SET status='$status', user_id='$id_user' WHERE id_pengaduan='$id_pengaduan'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=pengaduan&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }

    if(isset($_POST['selesai'])){
        $id_user = $_SESSION['id'];
        $status = 'Finish';
        $id_pengaduan = $_POST['id_pengaduan'];
        // Query update data
        $sql = "UPDATE pengaduan SET status='$status', user_id='$id_user' WHERE id_pengaduan='$id_pengaduan'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=pengaduan&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }

    if(isset($_POST['tolak'])){
        $id_user = $_SESSION['id'];
        $status = 'Rejected';
        $id_pengaduan = $_POST['id_pengaduan'];
        // Query update data
        $sql = "UPDATE pengaduan SET status='$status', user_id='$id_user' WHERE id_pengaduan='$id_pengaduan'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=pengaduan&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>