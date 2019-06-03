<?php
$password = "kit502";
$md5password = md5($password+"fdsfdsf");
echo "Password: $password<br>";
echo "Encrypted Password: $md5password<br>";

$password = "Kit502";
$md5password = md5($password);
echo "Password: $password<br>";
echo "Encrypted Password: $md5password<br>";

$password = "kit502";
$md5password = md5($password);
$sha1password = sha1($password);
$cryptpassword = crypt($password, "");
$crypt2password = crypt($password, "salt");
echo "Password: $password<br>";
echo "Encrypted Password MD5: $md5password<br>";
echo "Encrypted Password SHA1: $sha1password<br>";
echo "Encrypted hash from crypt(): $cryptpassword<br>";
echo "Encrypted hash from crypt() with salt: $crypt2password<br>";
