<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<h1 class="h3 mb-4 text-gray-800">Detail Pengaduan</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-8">
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
                    <td><img src="pengaduan/uploads/<?php echo $data['file'] ?>" alt="Gambar" width="200px"></td>
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
                        <?php if($data['status'] == "Pending"){ ?>
                        <span class="badge badge-warning"><?php echo $data['status'] ?></span>
                        <?php } else { ?>
                        <span class="badge badge-success"><?php echo $data['status'] ?></span>
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
                <?php if($data['status'] == "Pending" && $_SESSION['level'] != 'mahasiswi') { ?>
                <form action="" method="POST">
                    <tr>
                        <th>Ubah Status</th>
                        <th> : </th>
                        <td>
                            <select name="new_status" class="form-control">
                                <option value="Selesai">Selesai</option>
                                <option value="Ditolak">Tolak</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-4" id="updateButtonPengaduan"
                                name="update">Ubah Status</button>
                        </td>
                    </tr>
                </form>
                <?php } ?>
            </table>

        </div>
    </div>
</div>
<?php
    if(isset($_POST['update'])){
        $id_user = $_SESSION['id'];
        $status = $_POST['new_status'];
        // Query update data
        $sql = "UPDATE pengaduan SET status='$status', user_id='$id_user' WHERE id_pengaduan='$id_pengaduan'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=pengaduan&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>