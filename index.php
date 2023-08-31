<?php
    session_start(); // Memulai session
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    if(isset($_POST['login'])){
        include 'koneksi.php';

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']); // Hashing perlu ditingkatkan
        $level = $_POST['level'];

        if($level == 'mahasiswa'){
            // var_dump($_POST);die;
            $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE nim=? AND password=?");
            $stmt->bind_param("ss", $username, md5($password));
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $stmt = $conn->prepare("SELECT * FROM user WHERE (username=? OR email=?) AND password=?");
            $stmt->bind_param("sss", $username, $username, md5($password));
            $stmt->execute();
            $result = $stmt->get_result();
        }

        $cek = $result->num_rows;

        if($cek > 0){
            $data = $result->fetch_assoc();
            $_SESSION['username'] = $data['username'] ?? $data['nim'];
            $_SESSION['id'] = $data['id_user'] ?? $data['id_mahasiswa'];
            $_SESSION['nama'] = $data['nama'] ?? $data['nama_mahasiswa'];
            $_SESSION['level'] = $level;
            echo "<script>window.location.href='admin.php?login=true';</script>";
        } else {
            echo "<script>alert('Username atau Password Salah!');window.location='index.php';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Simpas">
    <meta name="author" content="GreenNusa Computindo">

    <title>Login - Simpas</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Sweet Alert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body{
            background: url('assets/img/bg_login.png');
            background-size: cover;
        }

        .blue{
            color: #015089;
        }

        .bg-blue{
            background: #015089;
        }
    </style>

</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12 col-md-9">
                <div class="text-center pt-5">
                    <img src="assets/img/unida_logo.png" alt="Logo Unida" width="100px">
                    <h1 class="blue"><strong>WELCOME SARPRAS</strong></h1>
                    <h5 class="blue"><strong>UNIVERSITAS DARUSSALAM GONTOR KAMPUS PUTRI</strong></h6>
                </div>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                        <hr>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Masukkan Email atau Username" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <select name="level" id="level" class="form-control" required>
                                                <option value="">-- Pilih Level --</option>
                                                <option value="super admin">Super Admin</option>
                                                <option value="admin">Admin</option>
                                                <option value="mahasiswa">Mahasiswa</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="login" class="bg-blue btn btn-primary btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center small">
                                        Belum Mempunyai Akun? <a href="register.html">Registrasi Sekarang!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="asset/js/sb-admin-2.min.js"></script>

</body>

</html>