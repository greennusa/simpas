<?php
    session_start(); // Memulai session
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    if(isset($_POST['login'])){
        include 'koneksi.php';

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']); 
        $level = 'admin';

        $stmt = $conn->prepare("SELECT * FROM user WHERE (username=? OR email=?) AND password=?");
        $stmt->bind_param("sss", $username, $username, md5($password));
        $stmt->execute();
        $result = $stmt->get_result();

        $cek = $result->num_rows;

        if($cek > 0){
            $data = $result->fetch_assoc();
            $_SESSION['username'] = $data['username'];
            $_SESSION['id'] = $data['id_user'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = $level;
            echo "<script>window.location.href='admin.php?login=true';</script>";
        } else {
            echo "<script>var loginFailed = true;</script>";
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

    <title>Login Admin- Simpas</title>

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
                                        <h1 class="h4 mb-4 text-uppercase"><strong>Login Admin</strong></h1>
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
                                        <button type="submit" name="login" class="bg-blue btn btn-primary btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center small">
                                        User? <a href="index.php">Login disini!</a>
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
            if (typeof loginFailed !== 'undefined' && loginFailed) {
                Swal.fire(
                    'Gagal!',
                    'Username atau Password Salah!',
                    'error'
                ).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php';
                    }
                });
            }
        });
    </script>


</body>

</html>