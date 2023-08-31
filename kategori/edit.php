<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Data Kategori</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <?php
            // Mengambil data berdasarkan ID kategori
            $id_kategori = $_GET['id'];
            $sql = "SELECT * FROM kategori WHERE id_kategori='$id_kategori'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama_kategori']; ?>" required autofocus>
                </div>
                <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>">
                <button type="submit" class="btn btn-primary" name="update">Ubah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['update'])){
        // Menyiapkan data
        $id_kategori = $_POST['id_kategori'];
        $nama_kategori = $_POST['nama'];

        // Query update data
        $sql = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=kategori&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
