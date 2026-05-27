<?php

require_once "../config/database.php";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="dosen.csv"');

$output = fopen("php://output", "w");

fputcsv($output, [

    'NIDN',
    'Nama',
    'Email',
    'Program Studi',
    'Status'

]);

$stmt = $pdo->query("
    SELECT * FROM dosen
    WHERE deleted_at IS NULL
");

while($d = $stmt->fetch()){

    fputcsv($output, [

        $d['nidn'],
        $d['nama'],
        $d['email'],
        $d['program_studi'],
        $d['status']

    ]);
}

fclose($output);
exit;