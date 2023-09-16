<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Admin</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
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
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO user (nama, email, username, password) VALUES ('$nama', '$email', '$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='admin.php?page=admin&tambah=true';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>