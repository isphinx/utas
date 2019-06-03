<?php
session_start();
session_destroy();
unset($_SESSION["userid"]);
print_r($_SESSION);
header("Location: ../login.php");