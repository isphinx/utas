<html>

<head>
    <?php
$mysql = new mysqli('localhost', 'test', '123', 'utas');

// print_r($_GET);
if (isset($_GET['submit'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    $sql = "INSERT INTO users (username, password, mobile, email, gender)
            VALUES('$username', '$password', '111', 'eee@c.c', 'male')";
    // echo $sql;
    $mysql->query($sql);
}
?>

</head>

<body>
    <form action="t2.php" method="get">
        <label for="">Username:</label>
        <input name="username" id="username" type="text">
        <label id="result" for=""></label>
        <br>
        <label for="">Password:</label>
        <input name="password" id="password" type="text">
        <br>
        <input name="submit" type="submit">
    </form>

    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
    $("#username").change(function() {
        $.get("check.php", {
                username: this.value,
                check:0
            })
            .done(function(data) {
                $("#result").html(data);
            });
    });
    </script>
</body>

</html>