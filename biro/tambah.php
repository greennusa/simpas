<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Data Biro</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama">Nama Biro</label>
                    <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                </div>
                <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['tambah'])){
        // Menyiapkan data
        $nama_biro = $_POST['nama'];

        // Query insert data
        $sql = "INSERT INTO biro (nama_biro) VALUES ('$nama_biro')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=biro&tambah=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>