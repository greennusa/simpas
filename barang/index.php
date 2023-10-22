<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
    <?php if($_SESSION['level'] == 'admin'): ?>
    <a href="admin.php?page=tambah-barang" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tambah Data</a>
    <?php endif; ?>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        <th>Spesifikasi</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT * FROM barang LEFT JOIN kategori ON barang.kategori_id = kategori.id_kategori LEFT JOIN merek ON barang.merek_id = merek.id_merek LEFT JOIN satuan ON satuan.id_satuan = barang.satuan_id ORDER BY kd_barang DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['kd_barang'] ?></td>
                    <td><?php echo $row['nama_barang'] ?></td>
                    <td><?php echo $row['nama_kategori'] == '' ? '-' : $row['nama_kategori']; ?></td>
                    <td><?php echo $row['nama_merek'] == '' ? '-' : $row['nama_merek']; ?></td>
                    <td><?php echo $row['spesifikasi'] ?></td>
                    <td><?php echo $row['lokasi'] ?></td>
                    <td><?php echo $row['status_barang'] ?></td>
                    <td><?php echo $row['total'] ?></td>
                    <td><?php echo $row['nama_satuan'] == '' ? '-' : $row['nama_satuan']; ?></td>
                    <?php if($_SESSION['level'] == 'admin'): ?>
                    <td>
                        <a class="btn btn-sm btn-warning" href="admin.php?page=edit-barang&id=<?php echo $row['kd_barang'] ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="admin.php?page=hapus-barang&id=<?php echo $row['kd_barang'] ?>">Hapus</a>
                    </td>
                    <?php else: ?>
                        <td>
                        <a class="btn btn-sm btn-primary" href="admin.php?page=tambah-peminjaman-barang">Pinjam</a>
                        </td>
                    <?php endif ?>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
