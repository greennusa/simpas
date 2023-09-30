<?php 
include '../koneksi.php';
include '../date_formatter.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman Ruangan</title>
    <!-- CDN CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">    
</head>

<body>
    <h3 class="text-center mb-4" style="margin-top: 110px;">Data Peminjaman Ruangan</h3>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Ruangan</th>
                <th>Tujuan</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Selesai</th>
                <th>Penanggung Jawab</th>
                <th>Satuan Kerja</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT * FROM peminjaman_ruangan LEFT JOIN ruangan ON peminjaman_ruangan.ruangan_id = ruangan.id_ruangan LEFT JOIN mahasiswa ON peminjaman_ruangan.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN gedung ON ruangan.gedung_id = gedung.id_gedung LEFT JOIN biro ON peminjaman_ruangan.biro_id = biro.id_biro LEFT JOIN dosen ON dosen.id_dosen = peminjaman_ruangan.dosen_id ORDER BY peminjaman_ruangan.id_peminjaman_ruangan DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['nim'] == '' ? '-' : $row['nim']; ?></td>
                <td><?php echo $row['nama_mahasiswa'] == '' ? '-' : $row['nama_mahasiswa']; ?></td>
                <td><?php echo $row['nama_ruangan'] == '' ? '-' : $row['nama_ruangan'] .'-'. $row['nama_gedung'];?></td>
                <td><?php echo $row['tujuan'] == '' ? '-' : $row['tujuan'];?></td>
                <td><?php echo formatDateIndonesia2($row['tanggal_peminjaman']) ?></td>
                <td><?php echo formatDateIndonesia2($row['tanggal_selesai']) ?></td>
                <td><?php echo $row['nama_dosen'] == '' ? '-' : $row['nama_dosen']; ?></td>
                <td><?php echo $row['nama_biro'] == '' ? '-' : $row['nama_biro']; ?></td>
                <td><?php echo $row['status'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>