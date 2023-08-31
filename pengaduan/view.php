<!-- Page Heading -->
<?php require 'date_formatter.php'; ?>
<h1 class="h3 mb-4 text-gray-800">Detail Pengaduan</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-8">
            <?php
            // Mengambil data berdasarkan ID pengaduan
            $id_pengaduan = $_GET['id'];
            $sql = "SELECT * FROM pengaduan JOIN mahasiswa ON pengaduan.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN user ON pengaduan.user_id = user.id_user WHERE id_pengaduan='$id_pengaduan'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>
            <table class="table table-borderless">
                <tr>
                    <th width="20%">NIM</th>
                    <th width="5%"> : </th>
                    <td><?php echo $data['nim'] ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <th> : </th>
                    <td><?php echo $data['nama_mahasiswa'] ?></td>
                </tr>
                <tr>
                    <th>Prodi</th>
                    <th> : </th>
                    <td><?php echo $data['prodi'] ?></td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <th> : </th>
                    <td><?php echo $data['semester'] ?></td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <th> : </th>
                    <td><?php echo $data['judul'] ?></td>
                </tr>
                <tr>
                    <th>Isi</th>
                    <th> : </th>
                    <td><?php echo $data['isi'] ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <th> : </th>
                    <td><?php echo formatDateIndonesia($data['created_at']) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <th> : </th>
                    <td>
                        <?php if($data['status'] == "Pending"){ ?>
                            <span class="badge badge-warning"><?php echo $data['status'] ?></span>
                        <?php } else { ?>
                            <span class="badge badge-success"><?php echo $data['status'] ?></span>
                        <?php } ?>
                    </td>
                </tr>
                <?php if($data['status'] == "Selesai") { ?>
                <tr>
                    <th>Diterima oleh</th>
                    <th> : </th>
                    <td> <?php echo $data['nama'] ?> </td>
                </tr>
                <?php } ?>
                
            </table>

            <?php if($data['status'] == "Pending" && $_SESSION['level'] != 'mahasiswa') { ?>
            <form action="" method="POST">
                <button type="button" class="btn btn-primary" id="updateButton" name="update">Terima Laporan</button>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('updateButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan menerima laporan ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, terima!',
            cancelButtonText: 'Tidak, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user mengklik "Ya, terima", submit form
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = ''; // Action sesuai dengan kebutuhan Anda
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'update';
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>


<?php
    if(isset($_POST['update'])){
        $id_user = $_SESSION['id'];
        // Query update data
        $sql = "UPDATE pengaduan SET status='Selesai', user_id='$id_user' WHERE id_pengaduan='$id_pengaduan'";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            window.location.href='admin.php?page=pengaduan&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
?>
