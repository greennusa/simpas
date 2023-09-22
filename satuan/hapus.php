<?php
    // Mengambil ID satuan dari URL
    $id_satuan = $_GET['id'];

    // Pastikan ID satuan valid atau ada dalam database
    if (!empty($id_satuan) && is_numeric($id_satuan)) {
        
        // Query untuk menghapus data
        $sql = "DELETE FROM satuan WHERE id_satuan='$id_satuan'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=satuan&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. Error: ". $conn->error . "',
                footer: '<a href=admin.php?page=satuan>Kembali</a>',
                showConfirmButton: false,
                timer: 5000, // Dialog akan menutup setelah 5 detik
                didClose: () => {
                    // Redirect setelah dialog menutup
                    window.location.href = 'admin.php?page=satuan';
                }
            });
        </script>";
        
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "ID satuan tidak valid.";
    }
?>
