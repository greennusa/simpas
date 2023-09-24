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
            // Mengambil data berdasarkan ID pengaduan
            $id_pengaduan = $_GET['id'];
            $sql = "SELECT * FROM pengaduan LEFT JOIN mahasiswa ON pengaduan.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN user ON pengaduan.user_id = user.id_user WHERE id_pengaduan='$id_pengaduan'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>
    <table class="table table-borderless">
        <tr>
            <th width="20%">NIM</th>
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
        <!-- kategori -->
        <tr>
            <th>Kategori</th>
            <th> : </th>
            <td><?php echo $data['kategori'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Kejadian</th>
            <th> : </th>
            <td><?php echo $data['tgl'] ?></td>
        </tr>
        <tr>
            <th>Judul</th>
            <th> : </th>
            <td><?php echo $data['judul'] ?></td>
        </tr>
        <tr>
            <th>Isi</th>
            <th> : </th>
            <td><?php echo $data['isi'] ?></td>
        </tr>
        <!-- tampilkan gambar jika tidak null -->
        <?php if($data['file'] != null) { ?>
        <tr>
            <th>File</th>
            <th> : </th>
            <td><img src="uploads/<?php echo $data['file'] ?>" alt="Gambar" width="100px"></td>
        </tr>
        <?php } ?>
        <tr>
            <th>Tanggal</th>
            <th> : </th>
            <td><?php echo formatDateIndonesia($data['created_at']) ?></td>
        </tr>

        <tr>
            <th>Status</th>
            <th> : </th>
            <td>
                <?php echo $data['status'] ?>
            </td>
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