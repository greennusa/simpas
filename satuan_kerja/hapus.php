<?php
    // Mengambil ID biro dari URL
    $id_biro = $_GET['id'];

    // Pastikan ID biro valid atau ada dalam database
    if (!empty($id_biro) && is_numeric($id_biro)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM biro WHERE id_biro='$id_biro'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=satuan-kerja&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=satuan-kerja>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=satuan-kerja';
                }
            });
        </script>";
        
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "ID biro tidak valid.";
    }
?>
