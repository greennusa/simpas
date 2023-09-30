<?php
require_once '../vendor/autoload.php';
include '../koneksi.php';
include '../date_formatter.php';

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

/* Note: any element you append to a document must reside inside of a Section. */

// Adding an empty Section to the document...
$section = $phpWord->addSection();

// Create a table
$table = $section->addTable();
$table->addRow();
$cellStyle = ['borderSize' => 6];
$cellStyleCentered = ['align' => 'center'];
$cellStyleBold = ['bold' => true];

// Add table headers
$headers = ["No", "NIM", "Nama", "Barang", "Jumlah", "Tujuan", "Tanggal Peminjaman", "Tanggal Selesai", "Penanggung Jawab", "Satuan Kerja", "Status"];
foreach ($headers as $header) {
    $table->addCell(500, $cellStyle)->addText($header, $cellStyleBold, $cellStyleCentered);
}

// Fetch data from your database and add it to the table
$no = 1;
$sql = mysqli_query($conn, "SELECT * FROM peminjaman_barang LEFT JOIN barang ON peminjaman_barang.barang_kd = barang.kd_barang LEFT JOIN mahasiswa ON peminjaman_barang.mahasiswa_id = mahasiswa.id_mahasiswa LEFT JOIN biro ON peminjaman_barang.biro_id = biro.id_biro LEFT JOIN dosen ON dosen.id_dosen = peminjaman_barang.dosen_id ORDER BY peminjaman_barang.id_peminjaman_barang DESC");
while ($row = mysqli_fetch_assoc($sql)) {
    $table->addRow();
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
        $table->addCell(500, $cellStyle)->addText($data, [], $cellStyleCentered);
    }
}
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('Data Peminjaman Ruangan.docx');

// download file
header("Content-Disposition: attachment; filename=Data Peminjaman Ruangan.docx");
readfile("Data Peminjaman Ruangan.docx");