<?php
$Password = "Renovatio5";
$error = "";

if ($Password == "") {
    $error .= "* Please type the password" . "<br>";
} elseif (strlen($Password) < 6 && strlen($Password) > 8) {
//if the password is under 6 and over 8 characters
    $error .= "* The password must be 6-8 characters" . "<br>";
} elseif (!preg_match("#[0-9]+#", $Password)) {
//if the password does not include any number
    $error .= "* Password must include at least one number!<br>";
} elseif (!preg_match("#[a-z]+#", $Password)) {
//if the password does not include any letter
    $error .= "* Password must include at least one lowercase letter!<br>";
} elseif (!preg_match("#[A-Z]+#", $Password)) {
//if the password does not include any uppercase letter
    $error .= "* Password must include at least one uppercase letter!<br>";
// } elseif (!preg_match("#[~!@#]+#", $Password)) {
} elseif (!preg_match("#[~!@\#]+#", $Password)) {
//if the password does not include any special character
    $error .= "* Password must include at least one special character!<br>";
}

echo $error;
echo '<br>';

$a = 10.5;
$str1 = "Hello ";
$sum = $a + $str1;
print("$a + $str1 = $sum<br>");

$str1 = "10Hello ";
$sum = $a + $str1;
print("$a + $str1 = $sum<br>");