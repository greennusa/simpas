<?php
    $id_ruangan = $_GET['id'];
    if (!empty($id_ruangan) && is_numeric($id_ruangan)) {
        $sql = "DELETE FROM ruangan WHERE id_ruangan='$id_ruangan'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=ruangan&delete=true';
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Hapus data gagal. " . $conn->error . "',
                showConfirmButton: false,
                timer: 3000,
                didClose: () => {
                    window.location.href = 'admin.php?page=ruangan';
                }
            });
            </script>";
        }
    } else {
        echo "ID ruangan tidak valid.";
    }
?>
