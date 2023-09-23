<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Data Pengaduan</h1>
<?php
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
?>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" class="form-control" readonly
                            value="<?php echo $data['nama_mahasiswa'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal Kejadian</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Kerusakan">Kerusakan</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <option value="Kenyamanan">Kenyamanan</option>
                            <option value="keamanan">Keamanan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="file" id="file" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi">Isi</label>
                        <textarea name="isi" id="isi" rows="9" class="form-control" required></textarea>
                        <span class="text-danger mt-4">Mohon untuk tidak berkata kasar!</span>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="tambah">Laporkan Pengaduan</button>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['tambah'])){
        // Menyiapkan data
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $id_mahasiswa = $_SESSION['id'];
        $kategori = $_POST['kategori'];
        $tanggal = $_POST['tanggal'];

        // Penanganan file
        $filename = NULL;
        $file_error = 4; // Default value for file error (no file uploaded)

        // Mengecek dan membuat folder jika tidak ada
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        if(!empty($_FILES['file']['name'])){
            $filename = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_error = $_FILES['file']['error'];
            $file_size = $_FILES['file']['size'];
        }

        // Hanya memindahkan file jika tidak ada error
        if ($file_error === 0) {    
            $file_destination = __DIR__ . '/uploads/' . $filename;
            if(!move_uploaded_file($file_tmp, $file_destination)) {
                echo "Gagal memindahkan file.";
                return;
            }
        } elseif ($file_error !== 4) {
            echo "Terjadi kesalahan saat mengunggah file: " . $file_error;
            return;
        }

        // Query insert data
        $sql = "INSERT INTO pengaduan (mahasiswa_id, judul, isi, kategori, file, tgl) VALUES ('$id_mahasiswa', '$judul', '$isi', '$kategori', '$filename', '$tanggal')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='admin.php?page=pengaduan&tambah=true';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
