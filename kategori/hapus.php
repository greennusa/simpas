<?php
    // Mengambil ID kategori dari URL
    $id_kategori = $_GET['id'];

    // Pastikan ID kategori valid atau ada dalam database
    if (!empty($id_kategori) && is_numeric($id_kategori)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM kategori WHERE id_kategori='$id_kategori'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=kategori&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=kategori>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=kategori';
                }
            });
        </script>";
        
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "ID kategori tidak valid.";
    }
?>
