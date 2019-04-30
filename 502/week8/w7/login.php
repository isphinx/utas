<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <?php
// print_r($_REQUEST);

include 'db_conn.php'; //db connection

if (isset($_REQUEST['submit'])) {
    $error = "";
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql = "SELECT * FROM user_w8 WHERE username='$username' and password='$password'";
    // echo $sql;
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['username'] = $username;

        echo "success";
        header('location: tute6_main.php');
    } else {
        $error = "Invalid username";
    }
}

?>
</head>

<body>
    <center>
        <hr>
        <h2>Library Management</h2>
        <hr>
    </center>

    <h1>Please login to the system</h1>

    <h3><?php echo (isset($error)) ? $error : ""; ?></h3>

    <form action="">
        <label for="">Username:</label>
        <input name="username" type="text">
        <br>
        <label for="">Password:</label>
        <input name="password" type="text">
        <input type="submit" name="submit" valure="submit">
        <br>
        <a href="signup.php">Sign Up</a>

    </form>



</body>

</html>