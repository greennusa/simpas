<?php
function formatDateIndonesia($timestamp) {
    $dateTime = new DateTime($timestamp);
    // $dateTime->setTimezone(new DateTimeZone('Asia/Jakarta')); // Jika perlu
    $formattedDate = $dateTime->format('l, d F Y H:i');
    
    $dayTranslation = [
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu',
        'Sunday'    => 'Minggu',
    ];
    
    $monthTranslation = [
        'January'   => 'Januari',
        'February'  => 'Februari',
        'March'     => 'Maret',
        'April'     => 'April',
        'May'       => 'Mei',
        'June'      => 'Juni',
        'July'      => 'Juli',
        'August'    => 'Agustus',
        'September' => 'September',
        'October'   => 'Oktober',
        'November'  => 'November',
        'December'  => 'Desember',
    ];

    foreach ($dayTranslation as $en => $id) {
        $formattedDate = str_replace($en, $id, $formattedDate);
    }

    foreach ($monthTranslation as $en => $id) {
        $formattedDate = str_replace($en, $id, $formattedDate);
    }

    return $formattedDate;
}
?>

<?php
function formatDateIndonesia2($timestamp) {
    $dateTime = new DateTime($timestamp);
    // $dateTime->setTimezone(new DateTimeZone('Asia/Jakarta')); // Jika perlu
    $formattedDate = $dateTime->format('l, d F Y');
    
    $dayTranslation = [
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu',
        'Sunday'    => 'Minggu',
    ];
    
    $monthTranslation = [
        'January'   => 'Januari',
        'February'  => 'Februari',
        'March'     => 'Maret',
        'April'     => 'April',
        'May'       => 'Mei',
        'June'      => 'Juni',
        'July'      => 'Juli',
        'August'    => 'Agustus',
        'September' => 'September',
        'October'   => 'Oktober',
        'November'  => 'November',
        'December'  => 'Desember',
    ];

    foreach ($dayTranslation as $en => $id) {
        $formattedDate = str_replace($en, $id, $formattedDate);
    }

    foreach ($monthTranslation as $en => $id) {
        $formattedDate = str_replace($en, $id, $formattedDate);
    }

    return $formattedDate;
}
?>

