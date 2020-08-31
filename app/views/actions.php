<?php
require '../../start.php';

session_start();

use Controllers\Datas;
use Controllers\Users;
use Controllers\Audits;

if (isset($_POST['data_id'])) {
    Datas::delete($_POST['data_id']);

    $msg = "Deleted data";
    Audits::add_audit($_SESSION['user_id'], $msg);

    echo "Record deleted successfully.";
}

if (isset($_POST['user_id'])) {
    Users::delete($_POST['user_id']);

    $msg = "Deleted a user";
    Audits::add_audit($_SESSION['user_id'], $msg);

    echo "User deleted successfully.";
}
