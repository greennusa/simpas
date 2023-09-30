<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Data Satuan Kerja</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <?php
            // Mengambil data berdasarkan ID biro
            $id_biro = $_GET['id'];
            $sql = "SELECT * FROM biro WHERE id_biro='$id_biro'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama">Nama Satuan Kerja</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama_biro']; ?>" required autofocus>
                </div>
                <input type="hidden" name="id_biro" value="<?php echo $id_biro; ?>">
                <button type="submit" class="btn btn-primary" name="update">Ubah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['update'])){
        // Menyiapkan data
        $id_biro = $_POST['id_biro'];
        $nama_biro = $_POST['nama'];

        // Query update data
        $sql = "UPDATE biro SET nama_biro='$nama_biro' WHERE id_biro='$id_biro'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=satuan-kerja&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
