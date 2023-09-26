<?php
    // Mengambil ID merek dari URL
    $id_merek = $_GET['id'];

    // Pastikan ID merek valid atau ada dalam database
    if (!empty($id_merek) && is_numeric($id_merek)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM merek WHERE id_merek='$id_merek'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=merek&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=merek>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=merek';
                }
            });
        </script>";
        
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "ID merek tidak valid.";
    }
?>
