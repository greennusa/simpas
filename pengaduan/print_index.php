<?php 
include '../koneksi.php';
include '../date_formatter.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan</title>
    <!-- CDN CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h3 class="text-center mb-4">Data Pengaduan</h3>
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
                <td><img src="uploads/<?php echo $row['file'] ?>" alt="Gambar" width="100px"></td>
                <?php }else{ ?>
                <td>-</td>
                <?php } ?>
                <td><?php echo $row['judul'] ?></td>
                <td>Isi</td>
                <td><?php echo $row['tgl'] ?></td>
                <td>
                <?php echo $row['status'] ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>