<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Data Peminjaman Ruangan</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="ruangan_id">Ruangan</label>
                    <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                        <option value="">-- Pilih Ruangan --</option>
                    <?php
                    $ruangan_sql = mysqli_query($conn, "SELECT * FROM ruangan");
                    while($ruangan = mysqli_fetch_assoc($ruangan_sql)){
                        echo "<option value='".$ruangan['id_ruangan']."'>".$ruangan['nama_ruangan']."</option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tujuan">Tujuan</label>
                    <input type="text" name="tujuan" id="tujuan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                    <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['tambah'])){
        // Menyiapkan data
        $mahasiswa_id = $_SESSION['id'];
        $ruangan_id = $_POST['ruangan_id'];
        $tujuan = $_POST['tujuan'];
        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
        $tanggal_selesai = $_POST['tanggal_selesai'];

        // Query insert data
        $sql = "INSERT INTO peminjaman_ruangan (mahasiswa_id, ruangan_id, tujuan, tanggal_peminjaman, tanggal_selesai) VALUES ('$mahasiswa_id', '$ruangan_id', '$tujuan', '$tanggal_peminjaman', '$tanggal_selesai')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=peminjaman-ruangan&tambah=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
