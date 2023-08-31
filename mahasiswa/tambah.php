<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Mahasiswa</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nim">NIM</label>
                    <input type="text" name="nim" id="nim" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="nama_mahasiswa">Nama Mahasiswa</label>
                    <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control" required>
                        <option value="">-- Pilih Semester --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="prodi">Prodi</label>
                    <select name="prodi" id="prodi" class="form-control" required>
                        <option value="">-- Pilih Prodi --</option>
                        <option value="Farmasi">Farmasi</option>
                        <option value="Gizi">Gizi</option>
                        <option value="Agro">Agro</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="HES">HES</option>
                        <option value="PM">PM</option>
                        <option value="PAI">PAI</option>
                        <option value="TBI">TBI</option>
                        <option value="PBA">PBA</option>
                        <option value="IQT">IQT</option>
                        <option value="AFI">AFI</option>
                        <option value="MB">MB</option>
                        <option value="EI">EI</option>
                        <option value="HI">HI</option>
                        <option value="ILKOM">ILKOM</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['tambah'])){
        $nim = $_POST['nim'];
        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $semester = $_POST['semester'];
        $prodi = $_POST['prodi'];
        $password = md5($_POST['password']); // Simplified password hashing

        $sql = "INSERT INTO mahasiswa (nim, nama_mahasiswa, semester, prodi, password) VALUES ('$nim', '$nama_mahasiswa', '$semester', '$prodi', '$password')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=mahasiswa&tambah=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>