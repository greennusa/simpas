<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang Tersedia</h1>
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
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT b.nama_barang, b.kd_barang, (b.total - COALESCE(p.jumlah_barang, 0)) as jumlah_tersedia
                    FROM barang b
                    LEFT JOIN (
                        SELECT barang_kd, SUM(jumlah_barang) as jumlah_barang
                        FROM peminjaman_barang
                        WHERE status = 'Approved'
                        GROUP BY barang_kd
                    ) p ON b.kd_barang = p.barang_kd");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['kd_barang'] ?></td>
                    <td><?php echo $row['nama_barang'] ?></td>
                    <td><?php echo $row['jumlah_tersedia'] ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
