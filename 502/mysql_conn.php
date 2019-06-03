<?php
//$mysql = new mysqli('localhost', 'xli65', '501186', 'xli65');
$mysql = new mysqli('localhost', 'test', '123', 'utas');

//check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// function execsql($mysql, $sql)
// {
//     if ($mysql->query($sql) !== true) {
//         echo "error: $sql <br>" . $mysql->error;
//     }
// }