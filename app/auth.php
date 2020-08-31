<?php
require '../start.php';

use Controllers\Users;
use Controllers\Audits;

if (isset($_POST['signup'])) {
    $fullname = !empty($_POST['fullname']) ? trim($_POST['fullname']) : null;
    $uname = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pw = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $pw2 = !empty($_POST['password2']) ? trim($_POST['password2']) : null;

    if ($pw != $pw2) {
        header("Location: views/register.php?error=pw");
        return;
    }

    $num = Users::check_if_user_exists($uname);

    if ($num > 0) {
        header("Location: views/register.php?error=username");
        return;
    }

    $user = Users::create_user($fullname, $uname, $pw2, false);

    if ($user) {
        header("Location: ../index.php");
    }
}

if (isset($_POST['login'])) {
    $uname = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pw = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $user = Users::get_user_by_username($uname);

    if ($user == null) {
        header("Location: ../index.php?error=incorrect");
        return;
    } else {
        echo $pw;
        echo $user['password'];
        $validatePw = password_verify($pw, $user['password']);
        if ($validatePw) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['fullname'] = $user['fullname'];

            $msg = "Logged in";
            Audits::add_audit($user['id'], $msg);

            header('Location: views/home.php');
            exit;
        } else {
            header("Location: ../index.php?error=incorrect");
        }
    }
}
