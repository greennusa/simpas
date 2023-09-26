<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Data Merek</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <?php
            // Mengambil data berdasarkan ID merek
            $id_merek = $_GET['id'];
            $sql = "SELECT * FROM merek WHERE id_merek='$id_merek'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama">Nama Merek</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama_merek']; ?>" required autofocus>
                </div>
                <input type="hidden" name="id_merek" value="<?php echo $id_merek; ?>">
                <button type="submit" class="btn btn-primary" name="update">Ubah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['update'])){
        // Menyiapkan data
        $id_merek = $_POST['id_merek'];
        $nama_merek = $_POST['nama'];

        // Query update data
        $sql = "UPDATE merek SET nama_merek='$nama_merek' WHERE id_merek='$id_merek'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=merek&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
