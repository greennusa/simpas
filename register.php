<?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    if(isset($_POST['daftar'])){
        include 'koneksi.php';
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $semester = $_POST['semester'];
        $prodi = $_POST['prodi'];
        $password = $_POST['password'];

        // Cek apakah NIM sudah terdaftar
        $check_stmt = $conn->prepare("SELECT nim FROM mahasiswa WHERE nim = ?");
        $check_stmt->bind_param("s", $nim);
        $check_stmt->execute();
        $check_stmt->store_result();

        if($check_stmt->num_rows > 0){
            echo "<script>var nimExist = true;</script>";
        } else {
            // Insert data
            $stmt = $conn->prepare("INSERT INTO mahasiswa(nim, nama_mahasiswa, semester, prodi, password) VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss", $nim, $nama, $semester, $prodi, md5($password));
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "<script>var success = true;</script>";
            } else {
                echo "<script>var success = false;</script>";
            }
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
    <link href='assets/img/unida_logo.png' rel='shortcut icon'>

    <title>Register - Simpas</title>

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
            background: url('assets/img/bg_login.png') rgba(238, 238, 238, 0.52);
            background-size: cover;
            background-blend-mode: multiply;
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
            <div class="col-xl-6 col-lg-8 col-md-9">
                <div class="text-center pt-5">
                    <img src="assets/img/unida_logo.png" alt="Logo Unida" width="100px">
                    <h3 class="blue"><strong>WELCOME SARPRAS</strong></h3>
                    <h5 class="blue"><strong>UNIVERSITAS DARUSSALAM GONTOR KAMPUS PUTRI</strong></h6>
                </div>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4 text-uppercase"><strong>Registrasi Akun</strong></h1>
                                        <hr>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input name="nama" type="text" class="form-control"
                                                id="nama"placeholder="Masukkan Nama Lengkap" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <input name="nim" type="text" class="form-control"
                                                id="nim"placeholder="Masukkan NIM" required>
                                        </div>
                                        <div class="form-group">
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
                                        <div class="form-group">
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
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <button type="submit" name="daftar" class="bg-blue btn btn-primary btn-block">Daftar</button>
                                    </form>
                                    <hr>
                                    <div class="text-center small">
                                        Sudah Punya Akun? <a href="index.php">Login!</a>
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
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(){
            if (typeof success !== 'undefined') {
                if (success) {
                    Swal.fire(
                        'Berhasil!',
                        'Akun berhasil dibuat. Silakan login',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php";
                        }
                    });
                } else {
                    Swal.fire(
                        'Gagal!',
                        'Akun gagal dibuat.',
                        'error'
                    );
                }
            }

            if (typeof nimExist !== 'undefined') {
                if (nimExist) {
                    Swal.fire(
                        'Gagal!',
                        'NIM sudah terdaftar.',
                        'error'
                    );
                }
            }
        });
    </script>



</body>

</html>