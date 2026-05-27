<?php

session_start();

require_once "../config/database.php";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT * FROM dosen
    WHERE id = ?
");

$stmt->execute([
    $_GET['id']
]);

$dosen = $stmt->fetch();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $update = $pdo->prepare("
        UPDATE dosen
        SET
            nidn = ?,
            nama = ?,
            email = ?,
            program_studi = ?,
            status = ?
        WHERE id = ?
    ");

    $update->execute([

        $_POST['nidn'],
        $_POST['nama'],
        $_POST['email'],
        $_POST['program_studi'],
        $_POST['status'],
        $_GET['id']

    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Dosen</title>

<link
rel="stylesheet"
href="/siakad-mini/assets/css/style.css">

</head>
<body>

<div class="container">

<h2>🌸 Edit Dosen 🌸</h2>

<form method="POST">

<input
type="text"
name="nidn"
value="<?= $dosen['nidn']; ?>"
required
>

<br><br>

<input
type="text"
name="nama"
value="<?= $dosen['nama']; ?>"
required
>

<br><br>

<input
type="email"
name="email"
value="<?= $dosen['email']; ?>"
required
>

<br><br>

<select name="program_studi" required>

<option value="Teknik Informatika"
<?= $dosen['program_studi'] == 'Teknik Informatika' ? 'selected' : ''; ?>>
Teknik Informatika
</option>

<option value="Teknik Mesin"
<?= $dosen['program_studi'] == 'Teknik Mesin' ? 'selected' : ''; ?>>
Teknik Mesin
</option>

<option value="Teknik Sipil"
<?= $dosen['program_studi'] == 'Teknik Sipil' ? 'selected' : ''; ?>>
Teknik Sipil
</option>

<option value="Manajemen Informatika"
<?= $dosen['program_studi'] == 'Manajemen Informatika' ? 'selected' : ''; ?>>
Manajemen Informatika
</option>

<option value="Sistem Informasi"
<?= $dosen['program_studi'] == 'Sistem Informasi' ? 'selected' : ''; ?>>
Sistem Informasi
</option>

<option value="Teknik Elektro"
<?= $dosen['program_studi'] == 'Teknik Elektro' ? 'selected' : ''; ?>>
Teknik Elektro
</option>

</select>

<br><br>

<select name="status" required>

<option value="aktif"
<?= $dosen['status'] == 'aktif' ? 'selected' : ''; ?>>
Aktif
</option>

<option value="nonaktif"
<?= $dosen['status'] == 'nonaktif' ? 'selected' : ''; ?>>
Nonaktif
</option>

</select>

<br><br>

<button type="submit">
Update
</button>

</form>

<br>

<a href="index.php">
Kembali
</a>

</div>

</body>
</html>