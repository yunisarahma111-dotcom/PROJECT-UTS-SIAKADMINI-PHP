<?php

session_start();

require_once "../config/database.php";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("
    SELECT * FROM dosen
    WHERE deleted_at IS NOT NULL
");

$data = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Trash Dosen</title>
</head>
<body>

<h2>Data Sampah Dosen</h2>

<a href="index.php">
    Kembali
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>NIDN</th>
    <th>Nama</th>
    <th>Aksi</th>
</tr>

<?php foreach($data as $d): ?>

<tr>

    <td>
        <?= $d['nidn']; ?>
    </td>

    <td>
        <?= $d['nama']; ?>
    </td>

    <td>

        <a href="restore.php?id=<?= $d['id']; ?>">
            Restore
        </a>

    </td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>