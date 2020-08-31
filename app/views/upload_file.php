<?php
require '../../start.php';

session_start();

use Controllers\Datas;
use Controllers\Audits;

$arr_file_types = ['unl'];
$target_dir = "uploads/";
$target_file = $target_dir . $_SESSION['user_id'] . "_" . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!(in_array($imageFileType, $arr_file_types))) {
    echo "'Only .unl file formats are allowed'";
    $uploadOk = 0;
    return;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    return;
}

if (!file_exists('uploads')) {
    mkdir('uploads', 0777);
}

if ($uploadOk == 1) {
    move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

    // Upload data to db
    $file = file($target_file);
    $uid = $_SESSION['user_id'];
    foreach ($file as $f) {
        $p = explode("|", $f);
        Datas::add_data($uid, $p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $p[6], $p[7]);
    }
    $msg = "Uploaded a file";
    Audits::add_audit($_SESSION['user_id'], $msg);

    echo "File uploaded successfully.";
} else {
    echo "Sorry, your file could not be uploaded.";
}
