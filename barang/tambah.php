<?php
    // Menyiapkan format kode barang
    $query = "SELECT max(kd_barang) as maxKode FROM barang";
    $hasil = mysqli_query($conn, $query);
    $data  = mysqli_fetch_array($hasil);
    $kodeBarang = $data['maxKode'];

    $noUrut = (int) substr($kodeBarang, 4, 4);
    $noUrut++;

    $char = "BRG-";
    $kodeBarang = $char . sprintf("%04s", $noUrut);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Data Barang</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="kd_barang">Kode Barang</label>
                    <input type="text" name="kd_barang" id="kd_barang" class="form-control" required value="<?php echo $kodeBarang ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori_sql = mysqli_query($conn, "SELECT * FROM kategori");
                    while($kategori = mysqli_fetch_assoc($kategori_sql)){
                        echo "<option value='".$kategori['id_kategori']."'>".$kategori['nama_kategori']."</option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="merek">Merek</label>
                    <input type="text" name="merek" id="merek" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="spesifikasi">Spesifikasi</label>
                    <input type="text" name="spesifikasi" id="spesifikasi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="total">Total</label>
                    <input type="number" name="total" id="total" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['tambah'])){
        // Menyiapkan data
        $kd_barang = $_POST['kd_barang'];
        $nama_barang = $_POST['nama_barang'];
        $kategori_id = $_POST['kategori_id'];
        $merek = $_POST['merek'];
        $spesifikasi = $_POST['spesifikasi'];
        $lokasi = $_POST['lokasi'];
        $status = $_POST['status'];
        $total = $_POST['total'];

        // Query insert data
        $sql = "INSERT INTO barang (kd_barang, nama_barang, kategori_id, merek, spesifikasi, lokasi, status_barang, total) VALUES ('$kd_barang', '$nama_barang', '$kategori_id', '$merek', '$spesifikasi', '$lokasi', '$status', '$total')";

        // Eksekusi query
        if(mysqli_query($conn, $sql)){
            echo "<script>
                window.location.href='admin.php?page=barang&tambah=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>
