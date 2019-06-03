<?php
require "func.php";

// print_r($_REQUEST);
if (isset($_REQUEST['password'])) {
    echo checkpassword($_REQUEST['password']);
}

if (isset($_REQUEST['usertype'])) {
}
