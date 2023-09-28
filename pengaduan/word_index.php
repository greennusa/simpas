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
$headers = ["No", "Nama", "Judul", "Isi", "Tanggal Kejadian", "Status"];
foreach ($headers as $header) {
    $table->addCell(500, $cellStyle)->addText($header, $cellStyleBold, $cellStyleCentered);
}

// Fetch data from your database and add it to the table
$no = 1;
$sql = mysqli_query($conn, "SELECT * FROM pengaduan LEFT JOIN mahasiswa ON pengaduan.mahasiswa_id = mahasiswa.id_mahasiswa ORDER BY id_pengaduan DESC");
while ($row = mysqli_fetch_assoc($sql)) {
    $table->addRow();
    $rowData = [
        $no++,
        $row['nama_mahasiswa'] == '' ? '-' : $row['nama_mahasiswa'],
        $row['judul'],
        'Isi', // Modify this to include the actual content of the "Isi" column
        $row['tgl'],
        $row['status'],
    ];
    foreach ($rowData as $data) {
        $table->addCell(500, $cellStyle)->addText($data, [], $cellStyleCentered);
    }
}
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('Data Pengaduan Pelayanan.docx');

// download file
header("Content-Disposition: attachment; filename=Data Pengaduan Pelayanan.docx");
readfile("Data Pengaduan Pelayanan.docx");