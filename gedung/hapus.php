<?php
    // Mengambil ID gedung dari URL
    $id_gedung = $_GET['id'];

    // Pastikan ID gedung valid atau ada dalam database
    if (!empty($id_gedung) && is_numeric($id_gedung)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM gedung WHERE id_gedung='$id_gedung'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=gedung&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=gedung>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=gedung';
                }
            });
        </script>";
        
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "ID gedung tidak valid.";
    }
?>
