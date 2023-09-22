<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Data Gedung</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <?php
            // Mengambil data berdasarkan ID gedung
            $id_gedung = $_GET['id'];
            $sql = "SELECT * FROM gedung WHERE id_gedung='$id_gedung'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama">Nama Gedung</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama_gedung']; ?>" required autofocus>
                </div>
                <input type="hidden" name="id_gedung" value="<?php echo $id_gedung; ?>">
                <button type="submit" class="btn btn-primary" name="update">Ubah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['update'])){
        // Menyiapkan data
        $id_gedung = $_POST['id_gedung'];
        $nama_gedung = $_POST['nama'];

        // Query update data
        $sql = "UPDATE gedung SET nama_gedung='$nama_gedung' WHERE id_gedung='$id_gedung'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=gedung&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
