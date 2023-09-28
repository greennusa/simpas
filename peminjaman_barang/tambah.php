<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Data Peminjaman Barang</h1>
<?php
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
?>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" class="form-control" readonly
                            value="<?php echo $data['nim'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nama">Nama Peminjam</label>
                        <input type="text" id="nama" class="form-control" readonly
                            value="<?php echo $data['nama_mahasiswa'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="pj">Penanggung Jawab</label>
                        <select name="pj" id="pj" class="form-control" required>
                        <option value="">-- Pilih Penanggung Jawab --</option>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM dosen");
                            while($dosen = mysqli_fetch_assoc($sql)){
                                echo "<option value='".$dosen['id_dosen']."'>".$dosen['nama_dosen']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="biro">Biro</label>
                        <select name="biro" id="biro" class="form-control" required>
                        <option value="">-- Pilih Biro --</option>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM biro");
                        while($biro = mysqli_fetch_assoc($sql)){
                            echo "<option value='".$biro['id_biro']."'>".$biro['nama_biro']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ruangan_id">Ruangan</label>
                        <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                            <option value="">-- Pilih Ruangan --</option>
                            <?php
                    $ruangan_sql = mysqli_query($conn, "SELECT * FROM ruangan JOIN gedung ON ruangan.gedung_id = gedung.id_gedung");
                    while($ruangan = mysqli_fetch_assoc($ruangan_sql)){
                        echo "<option value='".$ruangan['id_ruangan']."'>".$ruangan['nama_ruangan']." - ".$ruangan['nama_gedung']."</option>";
                    }
                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
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
                        <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                    </div>
                    
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            <button type="reset" class="btn btn-success">Reset</button>
        </form>
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
        $pj = $_POST['pj'];
        $biro = $_POST['biro'];
        $ruangan = $_POST['ruangan_id'];

        // Query insert data
        $sql = "INSERT INTO peminjaman_barang (mahasiswa_id, barang_kd, jumlah_barang, tujuan, tanggal_peminjaman, tanggal_selesai, dosen_id, biro_id, ruangan_id) VALUES ('$mahasiswa_id', '$barang_kd', '$jumlah_barang', '$tujuan', '$tanggal_peminjaman', '$tanggal_selesai', '$pj', '$biro', '$ruangan')";

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