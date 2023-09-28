<?php
require_once '../vendor/autoload.php';
include '../koneksi.php';
include '../date_formatter.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Define the table headers
$headers = ["No", "Nama", "Judul", "Isi", "Tanggal Kejadian", "Status"];

// Set headers in the first row
$columnIndex = 1;
foreach ($headers as $header) {
    $sheet->setCellValueByColumnAndRow($columnIndex++, 1, $header);
}

// Fetch data from your database and add it to the spreadsheet
$no = 1;
$rowIndex = 2; // Start from the second row
$sql = mysqli_query($conn, "SELECT * FROM pengaduan LEFT JOIN mahasiswa ON pengaduan.mahasiswa_id = mahasiswa.id_mahasiswa ORDER BY id_pengaduan DESC");
while ($row = mysqli_fetch_assoc($sql)) {
    $columnIndex = 1; // Reset column index for each row
    $rowData = [
        $no++,
        $row['nama_mahasiswa'] == '' ? '-' : $row['nama_mahasiswa'],
        $row['judul'],
        'Isi', // Modify this to include the actual content of the "Isi" column
        $row['tgl'],
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

$writer->save("Data Pengaduan Pelayanan.xlsx");
$file = "Data Pengaduan Pelayanan.xlsx";
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


