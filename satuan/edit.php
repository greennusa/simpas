<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Data Satuan</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <?php
            // Mengambil data berdasarkan ID Satuan
            $id_satuan = $_GET['id'];
            $sql = "SELECT * FROM satuan WHERE id_satuan='$id_satuan'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama">Nama Satuan</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama_satuan']; ?>" required autofocus>
                </div>
                <input type="hidden" name="id_satuan" value="<?php echo $id_satuan; ?>">
                <button type="submit" class="btn btn-primary" name="update">Ubah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['update'])){
        // Menyiapkan data
        $id_satuan = $_POST['id_satuan'];
        $nama_satuan = $_POST['nama'];

        // Query update data
        $sql = "UPDATE satuan SET nama_satuan='$nama_satuan' WHERE id_satuan='$id_satuan'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=satuan&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
