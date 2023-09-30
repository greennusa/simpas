<?php
require_once '../vendor/autoload.php';
include '../koneksi.php';
include '../date_formatter.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Define the table headers
$headers = ["No", "NIM", "Nama", "Ruangan", "Tujuan", "Tanggal Peminjaman", "Tanggal Selesai", "Penanggung Jawab", "Satuan Kerja", "Status"];

// Set headers in the first row
$columnIndex = 1;
foreach ($headers as $header) {
    $sheet->setCellValueByColumnAndRow($columnIndex++, 1, $header);
}

// Fetch data from your database and add it to the spreadsheet
$no = 1;
$rowIndex = 2; // Start from the second row
$sql = mysqli_query($conn, "SELECT * FROM peminjaman_ruangan LEFT JOIN ruangan ON peminjaman_ruangan.ruangan_id = ruangan.id_ruangan LEFT JOIN mahasiswa ON peminjaman_ruangan.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN gedung ON ruangan.gedung_id = gedung.id_gedung LEFT JOIN biro ON peminjaman_ruangan.biro_id = biro.id_biro LEFT JOIN dosen ON dosen.id_dosen = peminjaman_ruangan.dosen_id ORDER BY peminjaman_ruangan.id_peminjaman_ruangan DESC");
while ($row = mysqli_fetch_assoc($sql)) {
    $columnIndex = 1; // Reset column index for each row
    $rowData = [
        $no++,
        $row['nim'] == '' ? '-' : $row['nim'],
        $row['nama_mahasiswa'] == '' ? '-' : $row['nama_mahasiswa'],
        $row['nama_ruangan'] == '' ? '-' : $row['nama_ruangan'] . '-' . $row['nama_gedung'],
        $row['tujuan'] == '' ? '-' : $row['tujuan'],
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

// Auto-size columns
foreach (range(1, count($headers)) as $column) {
    $sheet->getColumnDimensionByColumn($column)->setAutoSize(true);
}

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

$writer->save("Data Peminjaman Ruangan.xlsx");
$file = "Data Peminjaman Ruangan.xlsx";
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


