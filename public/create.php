<?php

session_start();

require_once "../config/database.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $namaFoto = null;

    if($_FILES['foto']['name']){

        $ext = pathinfo(

            $_FILES['foto']['name'],

            PATHINFO_EXTENSION
        );

        $namaFoto = md5(time()) . "." . $ext;

        move_uploaded_file(

            $_FILES['foto']['tmp_name'],

            "../uploads/" . $namaFoto
        );
    }

    $stmt = $pdo->prepare("
        INSERT INTO dosen(
            nidn,
            nama,
            email,
            program_studi,
            foto,
            status
        )
        VALUES(?,?,?,?,?,?)
    ");

    $stmt->execute([

        $_POST['nidn'],
        $_POST['nama'],
        $_POST['email'],
        $_POST['program_studi'],
        $namaFoto,
        $_POST['status']

    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah Dosen</title>

<link
rel="stylesheet"
href="/siakad-mini/assets/css/style.css">

</head>
<body>

<div class="container">

<h2>Tambah Dosen</h2>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="nidn"
placeholder="NIDN"
required
>

<br><br>

<input
type="text"
name="nama"
placeholder="Nama"
required
>

<br><br>

<input
type="email"
name="email"
placeholder="Email"
required
>

<br><br>

<select name="program_studi" required>

<option value="">
-- Pilih Program Studi --
</option>

<option value="Teknik Informatika">
Teknik Informatika
</option>

<option value="Sistem Informasi">
Sistem Informasi
</option>

<option value="Teknik Komputer">
Teknik Komputer
</option>

<option value="Manajemen Informatika">
Manajemen Informatika
</option>

<option value="Ilmu Komputer">
Ilmu Komputer
</option>

</select>

<br><br>

<input
type="file"
name="foto"
required
>

<br><br>

<select name="status">

<option value="aktif">
Aktif
</option>

<option value="nonaktif">
Nonaktif
</option>

</select>

<br><br>

<button type="submit">
Simpan
</button>

</form>

<br>

<a href="index.php">
Kembali
</a>

</div>

</body>
</html>