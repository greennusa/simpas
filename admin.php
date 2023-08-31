<?php
include 'koneksi.php';
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
    echo "<script>
        alert('Anda harus login dahulu !');
        window.location.href='index.php';
    </script>";
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

    <title>Simpas</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Sweet Alert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'header.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                            
                            switch ($page) {
                                case 'kategori':
                                    include 'kategori/index.php';
                                    break;
                                case 'tambah-kategori':
                                    include 'kategori/tambah.php';
                                    break;
                                case 'edit-kategori':
                                    include 'kategori/edit.php';
                                    break;
                                case 'hapus-kategori':
                                    include 'kategori/hapus.php';
                                    break;
                                case 'barang':
                                    include 'barang/index.php';
                                    break;
                                case 'tambah-barang':
                                    include 'barang/tambah.php';
                                    break;
                                case 'edit-barang':
                                    include 'barang/edit.php';
                                    break;
                                case 'hapus-barang':
                                    include 'barang/hapus.php';
                                    break;
                                case 'ruangan':
                                    include 'ruangan/index.php';
                                    break;
                                case 'tambah-ruangan':
                                    include 'ruangan/tambah.php';
                                    break;
                                case 'edit-ruangan':
                                    include 'ruangan/edit.php';
                                    break;
                                case 'hapus-ruangan':
                                    include 'ruangan/hapus.php';
                                    break;
                                case 'mahasiswa':
                                    include 'mahasiswa/index.php';
                                    break;
                                case 'tambah-mahasiswa':
                                    include 'mahasiswa/tambah.php';
                                    break;
                                case 'edit-mahasiswa':
                                    include 'mahasiswa/edit.php';
                                    break;
                                case 'hapus-mahasiswa':
                                    include 'mahasiswa/hapus.php';
                                    break;
                                case 'user':
                                    include 'user/index.php';
                                    break;
                                case 'tambah-user':
                                    include 'user/tambah.php';
                                    break;
                                case 'edit-user':
                                    include 'user/edit.php';
                                    break;
                                case 'hapus-user':
                                    include 'user/hapus.php';
                                    break;
                                case 'pengaduan':
                                    include 'pengaduan/index.php';
                                    break;
                                case 'tambah-pengaduan':
                                    include 'pengaduan/tambah.php';
                                    break;
                                case 'view-pengaduan':
                                    include 'pengaduan/view.php';
                                    break;
                                case 'peminjaman-barang':
                                    include 'peminjaman_barang/index.php';
                                    break;
                                case 'tambah-peminjaman-barang':
                                    include 'peminjaman_barang/tambah.php';
                                    break;
                                case 'view-peminjaman-barang':
                                    include 'peminjaman_barang/view.php';
                                    break;
                                case 'peminjaman-ruangan':
                                    include 'peminjaman_ruangan/index.php';
                                    break;
                                case 'tambah-peminjaman-ruangan':
                                    include 'peminjaman_ruangan/tambah.php';
                                    break;
                                case 'view-peminjaman-ruangan':
                                    include 'peminjaman_ruangan/view.php';
                                    break;
                                default:
                                    include 'dashboard.php';
                                    break;
                            }
                        } else {
                            include 'dashboard.php';
                        }
                    ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Simpas <?php echo date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>
    <script type="text/javascript">
    // Mengecek apakah ada parameter tertentu di URL
    const urlParams = new URLSearchParams(window.location.search);
    const tambah = urlParams.get('tambah');
    const edit = urlParams.get('edit');
    const del = urlParams.get('delete');
    const login = urlParams.get('login');

    // Fungsi untuk menampilkan Toast
    const showToast = (icon, message) => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: icon,
            title: message
        }).then((result) => {
            // Mengambil URL dan memisahkan parameter-parameter GET
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            params.delete('tambah');
            params.delete('edit');
            params.delete('delete');
            params.delete('login');
            
            // Membangun kembali URL dengan parameter yang tersisa
            const newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?${params.toString()}`;
            
            // Memperbarui URL tanpa me-reload halaman
            window.history.pushState({}, document.title, newUrl);
        });
    }

    // Menampilkan toast berdasarkan parameter di URL
    if (tambah === 'true') {
        showToast('success', 'Data berhasil ditambahkan');
    } else if (edit === 'true') {
        showToast('success', 'Data berhasil diubah');
    } else if (del === 'true') {
        showToast('success', 'Data berhasil dihapus');
    } else if (login === 'true') {
        showToast('success', 'Login Berhasil');
    }
</script>
<script>
    // Pilih semua tombol dengan class "btn-danger", yang berarti itu adalah tombol hapus
    const deleteButtons = document.querySelectorAll('.btn-danger');

    deleteButtons.forEach((button) => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Menghentikan aksi default tombol

            const url = this.getAttribute('href'); // Mengambil URL untuk hapus dari atribut href pada tombol

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; // Jika user mengklik 'Ya, hapus!', arahkan ke URL hapus
                }
            })
        });
    });
</script>

</body>

</html>