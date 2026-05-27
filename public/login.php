<?php

session_start();

require_once "../src/Auth.php";

$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(Auth::login($username, $password)){

        header("Location: index.php");
        exit;

    } else {

        $error = "Username atau Password Salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>SIAKAD MINI</title>

<link
rel="stylesheet"
href="/siakad-mini/assets/css/style.css">

</head>
<body>

<div class="login-container">

<div class="login-card">

<h1>SISTEM INFORMASI MANAJEMEN DOSEN DAN MATA KULIAH</h1>

<p class="subtitle">
Silahkan Login untuk masuk sistem
</p>

<?php if($error): ?>

<div class="error">
<?= $error; ?>
</div>

<?php endif; ?>

<form method="POST">

<label>Username</label>

<input
type="text"
name="username"
placeholder="Masukkan Username"
required
>

<br><br>

<label>Password</label>

<input
type="password"
name="password"
placeholder="Masukkan Password"
required
>

<br><br>

<button type="submit">
Login
</button>

</form>

</div>

</div>

</body>
</html>