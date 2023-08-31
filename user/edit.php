<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit User</h1>

<?php
    $id_user = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id_user='$id_user'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="<?php echo $data['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control"
                        value="<?php echo $data['username']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="level">Level</label>
                    <select name="level" id="level" class="form-control" required>
                        <option value="super admin" <?php if ($data['level'] == 'super admin') echo 'selected'; ?>>Super
                            Admin</option>
                        <option value="admin" <?php if ($data['level'] == 'admin') echo 'selected'; ?>>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>
</div>

<?php
    if (isset($_POST['update'])) {
        $id_user = $_POST['id_user'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $level = $_POST['level'];
        $password = !empty($_POST['password']) ? md5($_POST['password']) : $data['password'];
        
        $sql = "UPDATE user SET nama='$nama', email='$email', username='$username', level='$level', password='$password' WHERE id_user='$id_user'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='admin.php?page=user&edit=true';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>