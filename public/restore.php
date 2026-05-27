<?php

session_start();

require_once "../config/database.php";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("
    UPDATE dosen
    SET deleted_at = NULL
    WHERE id = ?
");

$stmt->execute([
    $_GET['id']
]);

header("Location: trash.php");
exit;