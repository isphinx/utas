<!DOCTYPE html>
<html>

<head>
    <?php
// print_r($_REQUEST);

include 'db_conn.php'; //db connection

if (isset($_REQUEST['submit'])) {
    $error = "";
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $repassword = $_REQUEST['repassword'];

    //comment validation
    if ($password != $repassword) {
        $error .= "retype password error";
    }

    if ($error == "") {
        $sql = "INSERT INTO user_w8 (username, password, access) VALUES ('$username', '$password', 0);";
        echo $sql;
        $mysqli->query($sql);

        header('location: login.php');
    } else {
        $error = "";
    }
    echo $error;
}

?>
</head>

<body>
    <center>
        <hr>
        <h2>Sign Up</h2>
        <hr>
    </center>

    <form action="" method="get">
        <table>
            <tr>
                <td> <label for="">Username:</label> </td>
                <td> <input name="username" type="text"> </td>
            </tr>
            <tr>
                <td> <label for="">Password:</label> </td>
                <td> <input name="password" type="text"> </td>
            </tr>
            <tr>
                <td> <label for="">Retype Password:</label> </td>
                <td> <input name="repassword" type="text"> </td>
            </tr>
            <tr>
                <td> <a href="tute6_main.php">Back to main page</a> </td>
                <td> <input type="submit" name="submit" valure="submit"> </td>
            </tr>
        </table>

    </form>

</body>

</html>