<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Data Dosen</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <?php
            // Mengambil data berdasarkan ID dosen
            $id_dosen = $_GET['id'];
            $sql = "SELECT * FROM dosen WHERE id_dosen='$id_dosen'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nik">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control" value="<?php echo $data['nik']; ?>" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="nama">Nama Dosen</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama_dosen']; ?>" required>
                </div>
                <input type="hidden" name="id_dosen" value="<?php echo $id_dosen; ?>">
                <button type="submit" class="btn btn-primary" name="update">Ubah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['update'])){
        // Menyiapkan data
        $id_dosen = $_POST['id_dosen'];
        $nik = $_POST['nik'];
        $nama_dosen = $_POST['nama'];

        // Query update data
        $sql = "UPDATE dosen SET nik = '$nik', nama_dosen='$nama_dosen' WHERE id_dosen='$id_dosen'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=dosen&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
