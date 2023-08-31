<?php
    // Mengambil kode barang dari URL
    $kd_barang = $_GET['id'];

    // Pastikan kode barang valid atau ada dalam database
    if (!empty($kd_barang)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM barang WHERE kd_barang='$kd_barang'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=barang&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=barang>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=barang';
                }
            });
        </script>";
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "Kode barang tidak valid.";
    }
?>
