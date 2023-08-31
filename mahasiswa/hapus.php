<?php
    // Mengambil ID mahasiswa dari URL
    $id_mahasiswa = $_GET['id'];

    // Pastikan ID mahasiswa valid atau ada dalam database
    if (!empty($id_mahasiswa) && is_numeric($id_mahasiswa)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=mahasiswa&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=mahasiswa>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=mahasiswa';
                }
            });
        </script>";
        
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "ID mahasiswa tidak valid.";
    }
?>
