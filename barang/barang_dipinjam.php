<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang Dipinjam</h1>
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
                        <th>Tujuan</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Selesai</th>
                        <th>Jumlah Barang Dipinjam</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT b.nama_barang, b.kd_barang, pb.jumlah_barang, pb.tanggal_peminjaman, pb.tanggal_selesai, pb.tujuan
                    FROM peminjaman_barang pb
                    INNER JOIN barang b ON pb.barang_kd = b.kd_barang
                    WHERE pb.status = 'Approved' AND pb.tanggal_selesai > CURDATE()");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['kd_barang'] ?></td>
                    <td><?php echo $row['nama_barang'] ?></td>
                    <td><?php echo $row['tujuan'] ?></td>
                    <td><?php echo $row['tanggal_peminjaman'] ?></td>
                    <td><?php echo $row['tanggal_selesai'] ?></td>
                    <td><?php echo $row['jumlah_barang'] ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
