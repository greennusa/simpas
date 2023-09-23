<?php
    // Mengambil ID dosen dari URL
    $id_dosen = $_GET['id'];

    // Pastikan ID dosen valid atau ada dalam database
    if (!empty($id_dosen) && is_numeric($id_dosen)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM dosen WHERE id_dosen='$id_dosen'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=dosen&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=dosen>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=dosen';
                }
            });
        </script>";
        
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "ID dosen tidak valid.";
    }
?>
