<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Data Peminjaman Ruangan</h1>
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
                        <label for="tujuan">Tujuan Peminjaman</label>
                        <input type="text" name="tujuan" id="tujuan" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="ruangan_id">Lokasi Ruangan</label>
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
                    <div class="mb-3">
                        <label for="biro">Satuan Kerja</label>
                        <select name="biro" id="biro" class="form-control" required>
                        <option value="">-- Pilih Satuan Kerja --</option>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM biro");
                        while($biro = mysqli_fetch_assoc($sql)){
                            echo "<option value='".$biro['id_biro']."'>".$biro['nama_biro']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
            <button type="reset" class="btn btn-success">Reset</button>
        </form>
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
        $pj = $_POST['pj'];
        $biro = $_POST['biro'];

        // Query insert data
        $sql = "INSERT INTO peminjaman_ruangan (mahasiswa_id, ruangan_id, tujuan, tanggal_peminjaman, tanggal_selesai, dosen_id, biro_id) VALUES ('$mahasiswa_id', '$ruangan_id', '$tujuan', '$tanggal_peminjaman', '$tanggal_selesai', '$pj', '$biro')";

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