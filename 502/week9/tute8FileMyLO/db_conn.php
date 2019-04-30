<?php
//connect to mysql
// $mysqli = new mysqli('localhost', 'xli65', '501186', 'xli65');
$mysqli = new mysqli('localhost', 'test', '123', 'utas');

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}