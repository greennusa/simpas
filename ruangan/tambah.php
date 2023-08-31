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
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['tambah'])){
        $nama_ruangan = $_POST['nama_ruangan'];
        $lokasi = $_POST['lokasi'];

        $sql = "INSERT INTO ruangan (nama_ruangan, lokasi) VALUES ('$nama_ruangan', '$lokasi')";

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