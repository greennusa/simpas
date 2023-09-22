<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Ruangan</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama_ruangan">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="gedung_id">Gedung</label>
                    <select name="gedung_id" id="gedung_id" class="form-control" required>
                        <option value="">-- Pilih Gedung --</option>
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM gedung");
                    while($gedung = mysqli_fetch_assoc($sql)){
                        echo "<option value='".$gedung['id_gedung']."'>".$gedung['nama_gedung']."</option>";
                    }
                    ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['tambah'])){
        $nama_ruangan = $_POST['nama_ruangan'];
        $gedung_id = $_POST['gedung_id'];

        $sql = "INSERT INTO ruangan (nama_ruangan, gedung_id) VALUES ('$nama_ruangan', '$gedung_id')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=ruangan&tambah=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>