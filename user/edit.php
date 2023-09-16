<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit User</h1>

<?php
    $id_mahasiswa = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
    $data = mysqli_fetch_assoc($sql);
?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <input type="hidden" name="id_mahasiswa" value="<?php echo $data['id_mahasiswa']; ?>">
                <div class="mb-3">
                    <label for="nim">NIM</label>
                    <input type="text" name="nim" id="nim" class="form-control" value="<?php echo $data['nim']; ?>" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="nama_mahasiswa">Nama</label>
                    <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" value="<?php echo $data['nama_mahasiswa']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control" required>
                        <!-- Dynamic dropdown based on the selected semester -->
                        <?php for($i = 1; $i <= 8; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php if($data['semester'] == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="prodi">Prodi</label>
                    <select name="prodi" id="prodi" class="form-control" required>
                        <!-- Dynamic dropdown based on the selected prodi -->
                        <?php
                            $prodi_list = ['Farmasi', 'Gizi', 'Agro', 'Teknik Informatika', 'HES', 'PM', 'PAI', 'TBI', 'PBA', 'IQT', 'AFI', 'MB', 'EI', 'HI', 'ILKOM'];
                            foreach($prodi_list as $prodi_option) {
                        ?>
                            <option value="<?php echo $prodi_option; ?>" <?php if($data['prodi'] == $prodi_option) echo 'selected'; ?>><?php echo $prodi_option; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['update'])){
        $id_mahasiswa = $_POST['id_mahasiswa'];
        $nim = $_POST['nim'];
        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $semester = $_POST['semester'];
        $prodi = $_POST['prodi'];
        $password = !empty($_POST['password']) ? md5($_POST['password']) : $data['password'];

        $sql = "UPDATE mahasiswa SET nim='$nim', nama_mahasiswa='$nama_mahasiswa', semester='$semester', prodi='$prodi', password='$password' WHERE id_mahasiswa='$id_mahasiswa'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=user&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>
