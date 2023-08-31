<?php
    $id_ruangan = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM ruangan WHERE id_ruangan='$id_ruangan'");
    $data = mysqli_fetch_assoc($sql);
?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Ruangan</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" method="POST">
            <input type="hidden" name="id_ruangan" value="<?php echo $data['id_ruangan']; ?>">
            <div class="mb-3">
                <label for="nama_ruangan">Nama Ruangan</label>
                <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control" value="<?php echo $data['nama_ruangan']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lokasi">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?php echo $data['lokasi']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['update'])){
        $id_ruangan = $_POST['id_ruangan'];
        $nama_ruangan = $_POST['nama_ruangan'];
        $lokasi = $_POST['lokasi'];

        $sql = "UPDATE ruangan SET nama_ruangan='$nama_ruangan', lokasi='$lokasi' WHERE id_ruangan='$id_ruangan'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=ruangan&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
