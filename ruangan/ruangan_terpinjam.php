<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Ruangan Terpinjam</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Lokasi</th>
                        <th>Tujuan</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Selesai</th>
                        <th>Penanggung Jawab</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT * FROM peminjaman_ruangan JOIN ruangan ON peminjaman_ruangan.ruangan_id = ruangan.id_ruangan WHERE peminjaman_ruangan.status = 'Approved' AND peminjaman_ruangan.tanggal_selesai <= CURDATE()");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nama_ruangan'] ?></td>
                    <td><?php echo $row['lokasi'] ?></td>
                    <td><?php echo $row['tujuan'] ?></td>
                    <td><?php echo $row['tanggal_peminjaman'] ?></td>
                    <td><?php echo $row['tanggal_selesai'] ?></td>
                    <td><?php echo $row['pj'] ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
