<h1>Sign In</h1>

<h2>Database & PHP</h2>

<form action="FORM2.php" method="POST">
    <p> Username: <input name="username" type="text" required=""></p>
    <p> Password: <input name="password" type="text" required></p>
    <p> Email: <input name="email" type="text" required></p>
    <p> Mobile: <input name="mobile" type="text" required></p>
    <p> Gender: <input name="gender" type="text" required></p>

    <button>SUBMIT</button>
</form>

<?php

$Username = $_REQUEST["username"];
$Password = $_REQUEST["password"];
$Email = $_REQUEST["email"];
$Mobile = $_REQUEST["mobile"];
$Gender = $_REQUEST["gender"];

if ($Username != "") {
    echo "name $Username <br>";
    echo "password $Password <br>";
    echo "email $Email <br>";
    echo "mobile $Mobile <br>";
    echo "gender $Gender <br>";

    echo "dsfdsfdfdsfsf";
    $mysql = new mysqli('localhost', 'laurasr', '447184', 'laurasr');
    echo "4r2523" . $mysql;

    if ($mysql->connect_error) {
        echo "dsfdsf";

    }
    echo 'successfull <br>';
    $sql = "INSERT INTO users (username,password,mobile,email,gender)
        VALUES ('$Username','$Password','$Email','$Mobile','$Gender')";
    if ($mysql->query($sql) === true) {
        echo "You have successfull registered your account";

    } else {
        echo $sql . $mysql->error;
    }

}
?>