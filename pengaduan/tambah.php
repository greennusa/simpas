<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Data Pengaduan</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="isi">Isi</label>
                    <textarea name="isi" id="isi" rows="8" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['tambah'])){
        // Menyiapkan data
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $id_mahasiswa = $_SESSION['id'];
        // Query insert data
        $sql = "INSERT INTO pengaduan (mahasiswa_id, judul, isi) VALUES ('$id_mahasiswa', '$judul', '$isi')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=pengaduan&tambah=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>