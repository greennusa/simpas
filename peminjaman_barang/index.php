<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Peminjaman Barang</h1>
    <?php if($_SESSION['level'] == 'mahasiswi') : ?>
        <a href="admin.php?page=tambah-peminjaman-barang" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Tambah Data</a>
    <?php endif ?>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <?php if($_SESSION['level'] == 'mahasiswi') { ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Tujuan</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Selesai</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $id_mahasiswa = $_SESSION['id'];
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT * FROM peminjaman_barang LEFT JOIN barang ON peminjaman_barang.barang_kd = barang.kd_barang WHERE mahasiswa_id = '$id_mahasiswa' ORDER BY id_peminjaman_barang DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nama_barang'] == '' ? '-' : $row['nama_barang']; ?></td>
                    <td><?php echo $row['jumlah_barang'] ?></td>
                    <td><?php echo $row['tujuan'] ?></td>
                    <td><?php echo formatDateIndonesia2($row['tanggal_peminjaman']) ?></td>
                    <td><?php echo formatDateIndonesia2($row['tanggal_selesai']) ?></td>
                    <td><?php echo $row['pj'] ?></td>
                    <td>
                        <?php if($row['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $row['status'] ?></span>
                        <?php } elseif($row['status'] == "Disapproved") { ?>
                            <span class="badge badge-danger"><?php echo $row['status'] ?></span>
                        <?php } elseif($row['status'] == "Approved") { ?>
                            <span class="badge badge-success"><?php echo $row['status'] ?></span>
                        <?php } else { ?>
                            <span class="badge badge-primary"><?php echo $row['status'] ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="admin.php?page=view-peminjaman-barang&id=<?php echo $row['id_peminjaman_barang'] ?>">View</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php }else{ ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Tujuan</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Selesai</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT * FROM peminjaman_barang LEFT JOIN barang ON peminjaman_barang.barang_kd = barang.kd_barang LEFT JOIN mahasiswa ON peminjaman_barang.mahasiswa_id = mahasiswa.id_mahasiswa ORDER BY peminjaman_barang.id_peminjaman_barang DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nim'] == '' ? '-' : $row['nim']; ?></td>
                    <td><?php echo $row['nama_mahasiswa'] == '' ? '-' : $row['nama_mahasiswa']; ?></td>
                    <td><?php echo $row['nama_barang'] == '' ? '-' : $row['nama_barang']; ?></td>
                    <td><?php echo $row['jumlah_barang'] ?></td>
                    <td><?php echo $row['tujuan'] ?></td>
                    <td><?php echo formatDateIndonesia2($row['tanggal_peminjaman']) ?></td>
                    <td><?php echo formatDateIndonesia2($row['tanggal_selesai']) ?></td>
                    <td><?php echo $row['pj'] ?></td>
                    <td>
                        <?php if($row['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $row['status'] ?></span>
                        <?php } elseif($row['status'] == "Disapproved") { ?>
                            <span class="badge badge-danger"><?php echo $row['status'] ?></span>
                        <?php } elseif($row['status'] == "Approved") { ?>
                            <span class="badge badge-success"><?php echo $row['status'] ?></span>
                        <?php } else { ?>
                            <span class="badge badge-primary"><?php echo $row['status'] ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="admin.php?page=view-peminjaman-barang&id=<?php echo $row['id_peminjaman_barang'] ?>">View</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php } ?>
        </div>
    </div>
</div>