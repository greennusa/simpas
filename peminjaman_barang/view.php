<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<h1 class="h3 mb-4 text-gray-800">Detail Peminjaman Barang</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-8">
            <?php
            // Mengambil data berdasarkan ID peminjaman_barang
            $id_peminjaman_barang = $_GET['id'];
            $sql = "SELECT * FROM peminjaman_barang JOIN barang ON peminjaman_barang.barang_kd = barang.kd_barang JOIN mahasiswa ON peminjaman_barang.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN user ON peminjaman_barang.user_id = user.id_user WHERE id_peminjaman_barang='$id_peminjaman_barang'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>
            <table class="table table-borderless">
                <tr>
                    <th width="30%">NIM</th>
                    <th width="5%"> : </th>
                    <td><?php echo $data['nim'] ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <th> : </th>
                    <td><?php echo $data['nama_mahasiswa'] ?></td>
                </tr>
                <tr>
                    <th>Prodi</th>
                    <th> : </th>
                    <td><?php echo $data['prodi'] ?></td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <th> : </th>
                    <td><?php echo $data['semester'] ?></td>
                </tr>
                <tr>
                    <th>Barang</th>
                    <th> : </th>
                    <td><?php echo $data['nama_barang'] ?></td>
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
                <?php if($data['status'] == "Approved") { ?>
                <tr>
                    <th>Diterima oleh</th>
                    <th> : </th>
                    <td> <?php echo $data['nama'] ?> </td>
                </tr>
                <?php } ?>
                <?php if($_SESSION['level'] != 'mahasiswi') { ?>
                    <?php if($data['status'] != 'Returned'){ ?>
                <form action="" method="POST">
                <tr>
                    <th>Ubah Status</th>
                    <th> : </th>
                    <td>
                            <select name="new_status" class="form-control">
                                <option value="Approved" <?php if($data['status'] == "Approved") echo "selected"; ?>>Approved</option>
                                <option value="Disapproved" <?php if($data['status'] == "Disapproved") echo "selected"; ?>>Disapproved</option>
                                <?php if($data['status'] != 'Pending' && $data['status'] != 'Disapproved'){ ?>
                                    <option value="Returned" <?php if($data['status'] == "Returned") echo "selected"; ?>>Returned</option>
                                <?php } ?>
                            </select>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <th>Penanggung Jawab</th>
                    <th> : </th>
                    <td>
                        <!-- jika status returned input pj menjadi readonly -->
                        <input type="text" name="pj" class="form-control" value="<?php echo $data['pj'] ?>" <?php if($data['status'] == "Returned") echo "readonly"; ?>>
                        <button type="submit" class="btn btn-primary mt-4" id="updateButtonBarang" name="update_status">Ubah Status</button>
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
    $previous_status = $data['status'];  // Menangkap status sebelumnya
    $id_user = $_SESSION['id'];
    $pj = $_POST['pj'];
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

        if($new_status == "Returned") {
            // Jika status sebelumnya adalah "Approved" dan status baru adalah "Returned", tambah stok kembali
            if($previous_status == "Approved") {
                $sql_update_stok = "UPDATE barang SET total = total + '$jumlah_barang_dipinjam' WHERE kd_barang = '$kd_barang'";
                $conn->query($sql_update_stok);
            }
        }

        // Jika status sebelumnya adalah "Approved" dan status baru adalah "Disapproved", tambah stok
        if($previous_status == "Approved" && $new_status == "Disapproved") {
            $sql_update_stok = "UPDATE barang SET total = total + '$jumlah_barang_dipinjam' WHERE kd_barang = '$kd_barang'";
            $conn->query($sql_update_stok);
        }

        $sql = "UPDATE peminjaman_barang SET status='$new_status', user_id='$id_user', pj='$pj' WHERE id_peminjaman_barang='$id_peminjaman_barang'";
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

?>

