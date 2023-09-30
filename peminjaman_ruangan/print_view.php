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
<?php
    // Mengambil data berdasarkan ID peminjaman_ruangan
    $id_peminjaman_ruangan = $_GET['id'];
    $sql = "SELECT * FROM peminjaman_ruangan LEFT JOIN ruangan ON peminjaman_ruangan.ruangan_id = ruangan.id_ruangan LEFT JOIN mahasiswa ON peminjaman_ruangan.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN gedung ON ruangan.gedung_id = gedung.id_gedung LEFT JOIN biro ON peminjaman_ruangan.biro_id = biro.id_biro LEFT JOIN dosen ON dosen.id_dosen = peminjaman_ruangan.dosen_id LEFT JOIN user ON peminjaman_ruangan.user_id = user.id_user WHERE id_peminjaman_ruangan='$id_peminjaman_ruangan'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    ?>
    <table class="table table-borderless">
        <tr>
            <th width="30%">NIM</th>
            <th width="5%"> : </th>
            <td><?php echo $data['nim'] == '' ? '-' : $data['nim']; ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <th> : </th>
            <td><?php echo $data['nama_mahasiswa'] == '' ? '-' : $data['nama_mahasiswa']; ?></td>
        </tr>
        <tr>
            <th>Prodi</th>
            <th> : </th>
            <td><?php echo $data['prodi'] == '' ? '-' : $data['prodi']; ?></td>
        </tr>
        <tr>
            <th>Semester</th>
            <th> : </th>
            <td><?php echo $data['semester'] == '' ? '-' : $data['semester']; ?></td>
        </tr>
        <tr>
            <th>Ruangan</th>
            <th> : </th>
            <td><?php echo $data['nama_ruangan'] == '' ? '-' : $data['nama_ruangan'] .' - '. $data['nama_gedung']; ?></td>
        </tr>
        <tr>
            <th>Tujuan Peminjaman</th>
            <th> : </th>
            <td><?php echo $data['tujuan'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Peminjaman</th>
            <th> : </th>
            <td><?php echo formatDateIndonesia2($data['tanggal_peminjaman']) ?></td>
        </tr>
        <tr>
            <th>Tanggal Selesai</th>
            <th> : </th>
            <td><?php echo formatDateIndonesia2($data['tanggal_selesai']) ?></td>
        </tr>
        <tr>
            <th>Penanggung Jawab</th>
            <th> : </th>
            <td><?php echo $data['nama_dosen'] == '' ? '-' : $data['nama_dosen']; ?></td>
        </tr>
        <tr>
            <th>Satuan Kerja</th>
            <th> : </th>
            <td><?php echo $data['nama_biro'] == '' ? '-' : $data['nama_biro']; ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <th> : </th>
            <td><?php echo $data['status'] ?></td>
        </tr>
        <?php if($data['status'] != "Pending") { ?>
        <tr>
            <th>Diverifikasi oleh</th>
            <th> : </th>
            <td> <?php echo $data['nama'] ?> </td>
        </tr>
        <?php } ?>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>