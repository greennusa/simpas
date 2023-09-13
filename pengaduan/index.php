<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pengaduan</h1>
    <?php if($_SESSION['level'] == 'mahasiswi') : ?>
        <a href="admin.php?page=tambah-pengaduan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Tambah Data</a>
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
                        <th>Judul</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $id_mahasiswa = $_SESSION['id'];
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE mahasiswa_id = '$id_mahasiswa' ORDER BY id_pengaduan DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['judul'] ?></td>
                    <td><?php echo formatDateIndonesia($row['created_at']) ?></td>
                    <td>
                        <?php if($row['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $row['status'] ?></span>
                        <?php } else if($row['status'] == 'Selesai') { ?>
                            <span class="badge badge-success"><?php echo $row['status'] ?></span>
                        <?php }else{ ?>
                            <span class="badge badge-danger"><?php echo $row['status'] ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="admin.php?page=view-pengaduan&id=<?php echo $row['id_pengaduan'] ?>">View</a>
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
                        <th>Mahasiswa</th>
                        <th>Judul</th>
                        <th>Tanggal Pengaduan</th>
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
                    <td><?php echo $row['nim'] == '' ? '-' : $row['nim']; ?></td>
                    <td><?php echo $row['nama_mahasiswa'] == '' ? '-' : $row['nama_mahasiswa']; ?></td>
                    <td><?php echo $row['judul'] ?></td>
                    <td><?php echo formatDateIndonesia($row['created_at']) ?></td>
                    <td>
                        <?php if($row['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $row['status'] ?></span>
                        <?php } else if($row['status'] == 'Selesai') { ?>
                            <span class="badge badge-success"><?php echo $row['status'] ?></span>
                        <?php }else{ ?>
                            <span class="badge badge-danger"><?php echo $row['status'] ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="admin.php?page=view-pengaduan&id=<?php echo $row['id_pengaduan'] ?>">View</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php } ?>
        </div>
    </div>
</div>