<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Peminjaman Ruangan</h1>
    <?php if($_SESSION['level'] == 'mahasiswi') : ?>
        <a href="admin.php?page=tambah-peminjaman-ruangan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Tambah Data</a>
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
                        <th>Ruangan</th>
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
                    $sql = mysqli_query($conn, "SELECT * FROM peminjaman_ruangan JOIN ruangan ON peminjaman_ruangan.ruangan_id = ruangan.id_ruangan WHERE mahasiswa_id = '$id_mahasiswa' ORDER BY id_peminjaman_ruangan DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nama_ruangan'] ?></td>
                    <td><?php echo formatDateIndonesia2($row['tanggal_peminjaman']) ?></td>
                    <td><?php echo formatDateIndonesia2($row['tanggal_selesai']) ?></td>
                    <td><?php echo $row['pj'] == null ? '-' : $row['pj'] ?></td>
                    <td>
                        <?php if($row['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $row['status'] ?></span>
                        <?php } elseif($row['status'] == "Disapproved") { ?>
                            <span class="badge badge-danger"><?php echo $row['status'] ?></span>
                        <?php } else { ?>
                            <span class="badge badge-success"><?php echo $row['status'] ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="admin.php?page=view-peminjaman-ruangan&id=<?php echo $row['id_peminjaman_ruangan'] ?>">View</a>
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
                        <th>Ruangan</th>
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
                    $sql = mysqli_query($conn, "SELECT * FROM peminjaman_ruangan JOIN ruangan ON peminjaman_ruangan.ruangan_id = ruangan.id_ruangan JOIN mahasiswa ON peminjaman_ruangan.mahasiswa_id = mahasiswa.id_mahasiswa ORDER BY peminjaman_ruangan.id_peminjaman_ruangan DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nim'] ?></td>
                    <td><?php echo $row['nama_mahasiswa'] ?></td>
                    <td><?php echo $row['nama_ruangan'] ?></td>
                    <td><?php echo formatDateIndonesia2($row['tanggal_peminjaman']) ?></td>
                    <td><?php echo formatDateIndonesia2($row['tanggal_selesai']) ?></td>
                    <td><?php echo $row['pj'] == null ? '-' : $row['pj'] ?></td>
                    <td>
                        <?php if($row['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $row['status'] ?></span>
                        <?php } elseif($row['status'] == "Disapproved") { ?>
                            <span class="badge badge-danger"><?php echo $row['status'] ?></span>
                        <?php } else { ?>
                            <span class="badge badge-success"><?php echo $row['status'] ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="admin.php?page=view-peminjaman-ruangan&id=<?php echo $row['id_peminjaman_ruangan'] ?>">View</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php } ?>
        </div>
    </div>
</div>