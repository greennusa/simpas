<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Data Barang</h1>

<?php
    $kd_barang = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM barang WHERE kd_barang='$kd_barang'");
    $data = mysqli_fetch_assoc($query);
?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="kd_barang">Kode Barang</label>
                    <input type="text" name="kd_barang" id="kd_barang" class="form-control" value="<?php echo $data['kd_barang'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?php echo $data['nama_barang'] ?>">
                </div>
                <div class="mb-3">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control">
                        <?php
                        $kategori_sql = mysqli_query($conn, "SELECT * FROM kategori");
                        while($kategori = mysqli_fetch_assoc($kategori_sql)){
                            $selected = ($kategori['id_kategori'] == $data['kategori_id']) ? "selected" : "";
                            echo "<option value='".$kategori['id_kategori']."' $selected>".$kategori['nama_kategori']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="merek">Merek</label>
                    <input type="text" name="merek" id="merek" class="form-control" value="<?php echo $data['merek'] ?>">
                </div>
                <div class="mb-3">
                    <label for="spesifikasi">Spesifikasi</label>
                    <input type="text" name="spesifikasi" id="spesifikasi" class="form-control" value="<?php echo $data['spesifikasi'] ?>">
                </div>
                <div class="mb-3">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?php echo $data['lokasi'] ?>">
                </div>
                <div class="mb-3">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-control" value="<?php echo $data['status_barang'] ?>">
                </div>
                <div class="mb-3">
                    <label for="total">Total</label>
                    <input type="number" name="total" id="total" class="form-control" value="<?php echo $data['total'] ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="edit">Edit</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['edit'])){
        // Menangkap input dari form
        $kd_barang = $_POST['kd_barang'];
        $nama_barang = $_POST['nama_barang'];
        $kategori_id = $_POST['kategori_id'];
        $merek = $_POST['merek'];
        $spesifikasi = $_POST['spesifikasi'];
        $lokasi = $_POST['lokasi'];
        $status = $_POST['status'];
        $total = $_POST['total'];

        // Melakukan update data
        $sql = "UPDATE barang SET nama_barang='$nama_barang', kategori_id='$kategori_id', merek='$merek', spesifikasi='$spesifikasi', lokasi='$lokasi', status_barang='$status', total='$total' WHERE kd_barang='$kd_barang'";

        // Eksekusi query
        if(mysqli_query($conn, $sql)){
            echo "<script>
                window.location.href='admin.php?page=barang&edit=true';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>
