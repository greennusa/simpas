<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Data Peminjaman Barang</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="barang_kd">Barang</label>
                    <select name="barang_kd" id="barang_kd" class="form-control" required>
                        <option value="">-- Pilih Barang --</option>
                    <?php
                    $barang_sql = mysqli_query($conn, "SELECT * FROM barang");
                    while($barang = mysqli_fetch_assoc($barang_sql)){
                        echo "<option value='".$barang['kd_barang']."'>".$barang['nama_barang']."</option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_barang">Jumlah Barang</label>
                    <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required>
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
        $barang_kd = $_POST['barang_kd'];
        $jumlah_barang = $_POST['jumlah_barang'];
        $tujuan = $_POST['tujuan'];
        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
        $tanggal_selesai = $_POST['tanggal_selesai'];

        // Query insert data
        $sql = "INSERT INTO peminjaman_barang (mahasiswa_id, barang_kd, jumlah_barang, tujuan, tanggal_peminjaman, tanggal_selesai) VALUES ('$mahasiswa_id', '$barang_kd', '$jumlah_barang', '$tujuan', '$tanggal_peminjaman', '$tanggal_selesai')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=peminjaman-barang&tambah=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
