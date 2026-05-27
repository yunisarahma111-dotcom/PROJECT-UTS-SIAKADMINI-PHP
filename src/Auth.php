<?php

require_once "../config/database.php";

class Auth{

    public static function login($username, $password){

        global $pdo;

        $stmt = $pdo->prepare("
            SELECT * FROM users
            WHERE username=?
        ");

        $stmt->execute([$username]);

        $user = $stmt->fetch();

        if($user){

            if($password == $user['password_hash']){

                $_SESSION['user_id'] = $user['id'];

                $_SESSION['username'] = $user['username'];

                $_SESSION['role'] = $user['role'];

                return true;
            }
        }

        return false;
    }
}