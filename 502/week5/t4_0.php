<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    function validate() {
        if ($("#name").val() == "") {
            alert("Please enter your full name.");
            return false;
        } else if ($("#password").val() == "") {
            alert("Please enter your password.");
            return false;
        } else if ($("#confirm_password").val() == "") {
            alert("Plase re-type the password.");
            return false;
        } else if ($("#password").val() != $("#confirm_password").val()) {
            alert("Password does not match." + $("#password").val() + $("#confirm_password").val());
            alert($("password").val() + "   " + $("#confirm_password").val());
            return false;
        } else if ($("#email").val() == "") {
            alert("Please enter your email address.");
            return false;
        } else if ($("#mobile").val() == "") {
            alert("Please enter your mobile number.");
            return false;
        }
    }
    </script>
</head>

<body>
    <form method="GET" action="" onsubmit="return validate();">

        <label for="">Username:</label><br>
        <input id="name" name="name" type="text"><br><br>
        <label for="">Password:</label><br>
        <input id="password" name="password" type="text"><br><br>
        <label for="">Confirm password:</label><br>
        <input id="confirm_password" name="confirm_password" type="text"><br><br>
        <label for="">Email:</label><br>
        <input id="email" name="email" type="text"><br><br>
        <label for="">Mobile:</label><br>
        <input id="mobile" name="mobile" type="text"><br><br>

        <label for="">Gender(optional):</label><br>
        Male<input name="gender" value="male" type="radio">
        Female<input name="gender" value="female" type="radio">
        Other<input name="gender" value="other" type="radio">

        <br><br>
        <button>Submit</button>

    </form>
    <a href="view.php">all users</a><br><br>

    <?php

if (count($_REQUEST) > 0) {
    $name = $_REQUEST['name'];
    $password = $_REQUEST['password'];
    $email = $_REQUEST['email'];
    $mobile = $_REQUEST['mobile'];
    $gender = $_REQUEST['gender'];

    echo "name: $name  <br>";
    echo "password: $password <br>";
    echo "email: $email <br>";
    echo "mobile: $mobile <br>";
    echo "gender: $gender <br>";

    require "../mysql_conn.php";

    echo 'connect successfully<br>';
    $sql = "INSERT INTO users (username, password, mobile, email, gender)
                VALUES ('$name', '$password', $mobile, '$email', '$gender')";

    if ($mysql->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: $sql <br>  $mysql->error";
    }
}

?>

</body>

</html>