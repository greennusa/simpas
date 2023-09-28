<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<h1 class="h3 mb-4 text-gray-800">Detail Peminjaman Barang</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-8">
            <?php
            // Mengambil data berdasarkan ID peminjaman_barang
            $id_peminjaman_barang = $_GET['id'];
            $sql = "SELECT * FROM peminjaman_barang LEFT JOIN barang ON peminjaman_barang.barang_kd = barang.kd_barang LEFT JOIN mahasiswa ON peminjaman_barang.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN biro ON peminjaman_barang.biro_id = biro.id_biro LEFT JOIN dosen ON dosen.id_dosen = peminjaman_barang.dosen_id LEFT JOIN ruangan ON ruangan.id_ruangan = peminjaman_barang.ruangan_id LEFT JOIN gedung ON gedung.id_gedung = ruangan.gedung_id LEFT JOIN user ON peminjaman_barang.user_id = user.id_user WHERE id_peminjaman_barang='$id_peminjaman_barang'";
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
                    <td><?php echo $data['prodi'] == '' ? '-' : $data['prodi'];?></td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <th> : </th>
                    <td><?php echo $data['semester'] == '' ? '-' : $data['semester']; ?></td>
                </tr>
                <tr>
                    <th>Barang</th>
                    <th> : </th>
                    <td><?php echo $data['nama_barang'] == '' ? '-' : $data['nama_barang'];?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <th> : </th>
                    <td><?php echo $data['jumlah_barang'] ?></td>
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
                    <td><?php echo $data['nama_dosen'] == '' ? '-' : $data['nama_dosen'];?></td>
                </tr>
                <tr>
                    <th>Biro</th>
                    <th> : </th>
                    <td><?php echo $data['nama_biro'] == '' ? '-' : $data['nama_biro'];?></td>
                </tr>
                <tr>
                    <th>Ruangan</th>
                    <th> : </th>
                    <td><?php echo $data['nama_ruangan'] == '' ? '-' : $data['nama_ruangan'] .' - '. $data['nama_gedung']; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <th> : </th>
                    <td>
                        <?php if($data['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $data['status'] ?></span>
                        <?php } elseif($data['status'] == "Disapproved") { ?>
                            <span class="badge badge-danger"><?php echo $data['status'] ?></span>
                        <?php } elseif($data['status'] == "Approved") { ?>
                            <span class="badge badge-success"><?php echo $data['status'] ?></span>
                        <?php } else { ?>
                            <span class="badge badge-primary"><?php echo $data['status'] ?></span>
                        <?php } ?>
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
                <?php if($_SESSION['level'] != 'user') { ?>
                <form action="" method="POST">
                    <?php if($data['status'] == "Pending") { ?>
                    <button type="submit" class="btn btn-primary mt-4" name="terima">Terima Peminjaman</button>
                    <button type="submit" class="btn btn-outline-danger mt-4 ml-4" name="tolak">Tolak Peminjaman</button>
                    <?php } ?>
                    <!-- jika status approved tampilkan button returned -->
                    <?php if($data['status'] == "Approved") { ?>
                        <button type="submit" class="btn btn-primary mt-4" name="kembali">Pengembalian</button>
                    <?php } ?>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

<?php

if(isset($_POST['terima'])){
    $new_status ='Approved';
    $id_user = $_SESSION['id'];
    $id_peminjaman_barang = $_GET['id'];

    $conn->begin_transaction();

    try {
        $jumlah_barang_dipinjam = $data['jumlah_barang'];
        $kd_barang = $data['barang_kd'];
        $sql_stok = "SELECT total FROM barang WHERE kd_barang = '$kd_barang'";
        $result_stok = $conn->query($sql_stok);
        $row_stok = $result_stok->fetch_assoc();
        $stok_saat_ini = $row_stok['total'];

        if($new_status == "Approved") {
            if($stok_saat_ini < $jumlah_barang_dipinjam) {
                echo "<script>
                Swal.fire({
                    title: 'Stok Tidak Cukup',
                    text: 'Stok barang tidak cukup untuk memproses peminjaman ini.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                </script>";
                $conn->rollback();
                return;
            }
            $sql_update_stok = "UPDATE barang SET total = total - '$jumlah_barang_dipinjam' WHERE kd_barang = '$kd_barang'";
            $conn->query($sql_update_stok);
        }

        $sql = "UPDATE peminjaman_barang SET status='$new_status', user_id='$id_user' WHERE id_peminjaman_barang='$id_peminjaman_barang'";
        $conn->query($sql);

        $conn->commit();

        echo "<script>
        window.location.href='admin.php?page=peminjaman-barang&edit=true';
        </script>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}

if(isset($_POST['tolak'])){
    $new_status = "Disapproved";
    $id_user = $_SESSION['id'];
    $id_peminjaman_barang = $_GET['id'];

    $sql = "UPDATE peminjaman_barang SET status='$new_status', user_id='$id_user' WHERE id_peminjaman_barang='$id_peminjaman_barang'";
    $conn->query($sql);
    echo "<script>
            window.location.href='admin.php?page=peminjaman-barang&edit=true';
        </script>";
    $conn->close();
}

if(isset($_POST['kembali'])){
    $new_status = "Returned";
    $id_user = $_SESSION['id'];
    $id_peminjaman_barang = $_GET['id'];
    $jumlah_barang_dipinjam = $data['jumlah_barang'];

    $conn->begin_transaction();
    try{
        // Jika status sebelumnya adalah "Approved" dan status baru adalah "Returned", tambah stok kembali
        $sql_update_stok = "UPDATE barang SET total = total + '$jumlah_barang_dipinjam' WHERE kd_barang = '$kd_barang'";
        $conn->query($sql_update_stok);
        
        $sql = "UPDATE peminjaman_barang SET status='$new_status', user_id='$id_user' WHERE id_peminjaman_barang='$id_peminjaman_barang'";
        $conn->query($sql);

        $conn->commit();

        echo "<script>
        window.location.href='admin.php?page=peminjaman-barang&edit=true';
        </script>";
    }catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}

?>

