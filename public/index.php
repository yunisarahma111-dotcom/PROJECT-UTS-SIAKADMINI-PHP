<?php

session_start();

require_once "../config/database.php";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit;
}

$cari = $_GET['cari'] ?? '';

$halaman = $_GET['halaman'] ?? 1;

$batas = 5;

$mulai = ($halaman - 1) * $batas;

$stmt = $pdo->prepare("
    SELECT * FROM dosen
    WHERE deleted_at IS NULL
    AND nama LIKE ?
    LIMIT $mulai, $batas
");

$stmt->execute([
    "%$cari%"
]);

$data = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>

<title>Data Dosen</title>

<link
rel="stylesheet"
href="/siakad-mini/assets/css/style.css">

</head>
<body>

<div class="container">

<h2>DATA DOSEN</h2>

<p>
Login sebagai:
<?= $_SESSION['username']; ?>
</p>

<div class="menu">

<a href="logout.php">
Logout
</a>

<a href="trash.php">
Trash
</a>

<a href="dashboard.php">
Dashboard
</a>

<a href="export.php">
Export CSV
</a>

<?php if($_SESSION['role'] == 'admin'): ?>

<a href="create.php">
Tambah Dosen
</a>

<?php endif; ?>

</div>

<form method="GET">

<input
type="text"
name="cari"
placeholder="Cari nama dosen"
value="<?= $cari; ?>"
>

<br><br>

<button type="submit">
Cari
</button>

</form>

<br>

<table>

<tr>

<th>NIDN</th>
<th>Nama</th>
<th>Email</th>
<th>Program Studi</th>
<th>Foto</th>
<th>Status</th>
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
<?= $d['email']; ?>
</td>

<td>
<?= $d['program_studi']; ?>
</td>

<td>

<?php if($d['foto'] != null): ?>

<img
src="/siakad-mini/uploads/<?= $d['foto']; ?>"
width="80"
height="80"
style="object-fit:cover; border-radius:10px;">

<?php else: ?>

Tidak ada foto

<?php endif; ?>

</td>

<td>
<?= $d['status']; ?>
</td>

<td>

<a href="edit.php?id=<?= $d['id']; ?>">
Edit
</a>

<?php if($_SESSION['role'] == 'admin'): ?>

<a href="delete.php?id=<?= $d['id']; ?>">
Hapus
</a>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="?halaman=1">1</a>
<a href="?halaman=2">2</a>
<a href="?halaman=3">3</a>

</div>

</body>
</html>