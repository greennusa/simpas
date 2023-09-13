<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<h1 class="h3 mb-4 text-gray-800">Detail Peminjaman Ruangan</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-8">
            <?php
            // Mengambil data berdasarkan ID peminjaman_ruangan
            $id_peminjaman_ruangan = $_GET['id'];
            $sql = "SELECT * FROM peminjaman_ruangan LEFT JOIN ruangan ON peminjaman_ruangan.ruangan_id = ruangan.id_ruangan LEFT JOIN mahasiswa ON peminjaman_ruangan.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN user ON peminjaman_ruangan.user_id = user.id_user WHERE id_peminjaman_ruangan='$id_peminjaman_ruangan'";
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
                    <td><?php echo $data['nama_ruangan'] == '' ? '-' : $data['nama_ruangan']; ?></td>
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
                    <td><?php echo $data['pj'] ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <th> : </th>
                    <td>
                        <?php if($data['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $data['status'] ?></span>
                        <?php } elseif($data['status'] == "Disapproved") { ?>
                            <span class="badge badge-danger"><?php echo $data['status'] ?></span>
                        <?php } else { ?>
                            <span class="badge badge-success"><?php echo $data['status'] ?></span>
                        <?php } ?>
                    </td>
                </tr>
                <?php if($data['status'] == "Approved") { ?>
                <tr>
                    <th>Diverifikasi oleh</th>
                    <th> : </th>
                    <td> <?php echo $data['nama'] ?> </td>
                </tr>
                <?php } ?>
                <?php if($_SESSION['level'] != 'mahasiswi') { ?>
                <form action="" method="POST">
                <tr>
                    <th>Ubah Status</th>
                    <th> : </th>
                    <td>
                        <select name="new_status" class="form-control">
                            <option value="Approved" <?php if($data['status'] == "Approved") echo "selected"; ?>>Approved</option>
                            <option value="Disapproved" <?php if($data['status'] == "Disapproved") echo "selected"; ?>>Disapproved</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-4" id="updateButtonruangan" name="update_status">Ubah Status</button>
                    </td>
                </tr>
                </form>
                <?php } ?>
                
            </table>
        </div>
    </div>
</div>

<?php

if(isset($_POST['update_status'])){
    $new_status = $_POST['new_status'];
    $id_user = $_SESSION['id'];
    $pj = $_POST['pj'];

    // Query update data
    $sql = "UPDATE peminjaman_ruangan SET status='$new_status', user_id='$id_user' WHERE id_peminjaman_ruangan='$id_peminjaman_ruangan'";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        window.location.href='admin.php?page=peminjaman-ruangan&edit=true';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    

    $conn->close();
}

?>

