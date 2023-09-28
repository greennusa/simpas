<?php
require_once '../vendor/autoload.php';
include '../koneksi.php';
include '../date_formatter.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Define the table headers
$headers = ["No", "NIM", "Nama", "Barang", "Jumlah", "Tujuan", "Tanggal Peminjaman", "Tanggal Selesai", "Penanggung Jawab", "Biro", "Status"];

// Set headers in the first row
$columnIndex = 1;
foreach ($headers as $header) {
    $sheet->setCellValueByColumnAndRow($columnIndex++, 1, $header);
}

// Fetch data from your database and add it to the spreadsheet
$no = 1;
$rowIndex = 2; // Start from the second row
$sql = mysqli_query($conn, "SELECT * FROM peminjaman_barang LEFT JOIN barang ON peminjaman_barang.barang_kd = barang.kd_barang LEFT JOIN mahasiswa ON peminjaman_barang.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN biro ON peminjaman_barang.biro_id = biro.id_biro LEFT JOIN dosen ON dosen.id_dosen = peminjaman_barang.dosen_id ORDER BY peminjaman_barang.id_peminjaman_barang DESC");
while ($row = mysqli_fetch_assoc($sql)) {
    $columnIndex = 1; // Reset column index for each row
    $rowData = [
        $no++,
        $row['nim'] == '' ? '-' : $row['nim'],
        $row['nama_mahasiswa'] == '' ? '-' : $row['nama_mahasiswa'],
        $row['nama_barang'] == '' ? '-' : $row['nama_barang'],
        $row['jumlah_barang'],
        $row['tujuan'],
        formatDateIndonesia2($row['tanggal_peminjaman']),
        formatDateIndonesia2($row['tanggal_selesai']),
        $row['nama_dosen'] == '' ? '-' : $row['nama_dosen'],
        $row['nama_biro'] == '' ? '-' : $row['nama_biro'],
        $row['status'],
    ];

    foreach ($rowData as $data) {
        $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $data);
    }

    $rowIndex++;
}

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

$writer->save("Data Peminjaman Barang.xlsx");
$file = "Data Peminjaman Barang.xlsx";
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$file\"");
header("Content-Transfer-Encoding: binary");
header("Expires: 0");
header("Cache-Control: must-revalidate");
header("Pragma: public");
header("Content-Length: " . filesize($file));
ob_clean();
flush();
readfile($file);
exit;


