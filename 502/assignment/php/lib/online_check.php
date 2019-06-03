<?php

session_start();

if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    echo "true";
    exit;
}

header("Cache-control:no-cache,no-store,must-revalidate");
header("Pragma:no-cache");
header("Expires:0");
// if ($_COOKIE['resetpw_success_v']) {
//     //echo '密码已更改';exit();
//     header("Location: ****");
// }