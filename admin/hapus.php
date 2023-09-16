<?php
    // Mengambil ID user dari URL
    $id_user = $_GET['id'];

    // Pastikan ID user valid atau ada dalam database
    if (!empty($id_user) && is_numeric($id_user)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM user WHERE id_user='$id_user'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=admin&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=admin>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=admin';
                }
            });
        </script>";
        
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "ID user tidak valid.";
    }
?>
