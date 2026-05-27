<?php

session_start();

require_once "../config/database.php";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit;
}

$total = $pdo->query("
SELECT COUNT(*) FROM dosen
WHERE deleted_at IS NULL
")->fetchColumn();

$aktif = $pdo->query("
SELECT COUNT(*) FROM dosen
WHERE status='aktif'
AND deleted_at IS NULL
")->fetchColumn();

$nonaktif = $pdo->query("
SELECT COUNT(*) FROM dosen
WHERE status='nonaktif'
AND deleted_at IS NULL
")->fetchColumn();

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link
rel="stylesheet"
href="/siakad-mini/assets/css/style.css">

</head>
<body>

<h2>Dashboard Statistik</h2>

<div class="stat-box">
<h3>Total Dosen</h3>
<h1><?= $total; ?></h1>
</div>

<div class="stat-box">
<h3>Dosen Aktif</h3>
<h1><?= $aktif; ?></h1>
</div>

<div class="stat-box">
<h3>Dosen Nonaktif</h3>
<h1><?= $nonaktif; ?></h1>
</div>

<br><br>

<a href="index.php">
Kembali
</a>

</body>
</html>