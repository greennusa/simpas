<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
    <a href="admin.php?page=tambah-barang" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tambah Data</a>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT barang.*, kategori.nama_kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.id_kategori");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['kd_barang'] ?></td>
                    <td><?php echo $row['nama_barang'] ?></td>
                    <td><?php echo $row['nama_kategori'] ?></td>
                    <td><?php echo $row['merek'] ?></td>
                    <td><?php echo $row['spesifikasi'] ?></td>
                    <td><?php echo $row['lokasi'] ?></td>
                    <td><?php echo $row['status_barang'] ?></td>
                    <td><?php echo $row['total'] ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="admin.php?page=edit-barang&id=<?php echo $row['kd_barang'] ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="admin.php?page=hapus-barang&id=<?php echo $row['kd_barang'] ?>">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
