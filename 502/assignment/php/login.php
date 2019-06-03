<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Xin Bank</title>

    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet">

    <?php
// print_r($_REQUEST);
// echo isset($_REQUEST["username"]);
if (isset($_REQUEST["username"])) {
    login();
}

function login()
{
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    echo "name: $username <br>";
    echo "pw: $password <br>";

    require "lib/mysql_conn.php";
    require "lib/func.php";

    $password = PasswordMD5($password);

    echo 'connect successfully<br>';
    $sql = "SELECT * FROM xinbank_user WHERE username='$username' and password='$password'";

    $result = $mysql->query($sql);
    echo "record_num: $result->num_rows<br>";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userid = $row["ID"];
        $usertype = $row["type"];
        echo "login successfully, user:  $userid <br>";
        session_start();
        $_SESSION["userid"] = $userid;
        $_SESSION["username"] = $row['firstname'] . ' ' . $row['surname'];
        $_SESSION["usertype"] = $usertype;
        $_SESSION["lasttime"] = $row['lastTime'];

        $sql = "UPDATE xinbank_user set lastTime=CURRENT_TIMESTAMP WHERE ID=$userid";
        $mysql->query($sql);
        // $sql = "SELECT * FROM xinbank_user WHERE ID=$userid";
        // $result = $mysql->query($sql);
        // $row = $result->fetch_assoc();

        header("Location: index.php");
        exit;
    } else {
        echo "login error! worng username or password!!!";
        echo $sql;
        return false;
    }
}
?>
</head>

<body>
    <!-- MAIN CONTENT -->
    <div id="login-page">
        <div class="container">
            <form class="form-login" action="login.php">
                <h2 class="form-login-heading">sign in now</h2>
                <div class="login-wrap">
                    <input name="username" type="text" class="form-control" placeholder="User ID" autofocus required>
                    <br>
                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                    <input type="checkbox" value="remember-me"> Remember me.
                    <span class="pull-right">
                        <a data-toggle="modal" href="login.php#myModal"> Forgot Password?</a>
                    </span>
                    <button class="btn btn-theme btn-block" href="index.php" type="submit"><i class="fa fa-lock"></i>
                        SIGN IN</button>
                    <hr>
                    <div class="registration">
                        Don't have an account yet?<br />
                        <a class="" href="register.php">
                            Create an account
                        </a>
                    </div>
                </div>
                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal"
                    class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Forgot Password ?</h4>
                            </div>
                            <div class="modal-body">
                                <p>Enter your e-mail address below to reset your password.</p>
                                <input type="text" name="email" placeholder="Email" autocomplete="off"
                                    class="form-control placeholder-no-fix">
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-theme" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
            </form>
        </div>
    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <!--BACKSTRETCH-->
    <script type="text/javascript" src="../lib/jquery.backstretch.min.js"></script>
    <script>
    $.backstretch("../img/login-bg.jpg", {
        speed: 2000
    });
    </script>
</body>

</html>