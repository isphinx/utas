<!DOCTYPE html>
<html>

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
    register();
}

function register()
{
    $username = $_REQUEST["username"];
    $firstname = $_REQUEST['firstname'];
    $surname = $_REQUEST['surname'];
    $password = $_REQUEST["password"];
    // $type = 1;
    $confirm_password = $_REQUEST["confirm_password"];
    $email = $_REQUEST["email"];
    $mobile = $_REQUEST["mobile"];
    $gender = $_REQUEST["gender"];
    $type = $_REQUEST["type"];
    // lastTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    echo "name: $username <br>";
    echo "pw: $password <br>";
    echo "cpw: $confirm_password <br>";
    echo "email: $email <br>";
    echo "mobile: $mobile <br>";
    echo "gender: $gender <br>";

    include "lib/validation.php";

    if (strlen($username) == 0) {
        echo "$username";
    } elseif ($password != $confirm_password) {
        echo "pw:$password <====> cpw:$confirm_password";
    } elseif (checkpassword($password) != "correct!") {
        $result = checkpassword($password);
        echo "confirmpw:$password === $result";
    } else {
        require "lib/mysql_conn.php";

        $password = PasswordMD5($password);

        echo 'connect successfully<br>';
        $sql = "INSERT INTO xinbank_user (username, firstname, surname, password, mobile, email, gender)
                VALUES ('$username', '$firstname', '$surname', '$password', $mobile, '$email', '$gender')";

        if ($mysql->query($sql) === true) {
            echo "New record created successfully";
            $sql = "SELECT * FROM xinbank_user WHERE username='$username' AND password='$password'";
            $result = $mysql->query($sql);
            $row = $result->fetch_assoc();
            $userid = $row['ID'];
            echo "userid: $userid";
            $sql = "INSERT INTO xinbank_account (userID, type) VALUES ($userid, $type);";
            echo $sql;
            $mysql->query($sql);

            header("Location: login.php");
            exit;
        } else {
            // echo "Error: $sql <br>  $mysql->error";
            // return false;
            // header("Location: login.php");
            echo "register error! ==> $sql";
        }
    }
}
?>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header id="header" class="header black-bg"> </header>
        <!--header end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Register</h3>
                <div class="row mt">
                    <div class="col-lg-10">
                        <div class="form-panel">
                            <div class="form">
                                <form class="cmxform form-horizontal style-form" id="signupForm" method="get"
                                    action="register.php" onsubmit="return validate();">
                                    <div id="div_username" class="form-group ">
                                        <label for=" username" class="control-label col-lg-2">Username</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="username" name="username" type="text"
                                                required />
                                        </div>
                                    </div>
                                    <div id="div_firstname" class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">First name</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="firstname" name="firstname"
                                                type="firstname" />
                                        </div>
                                    </div>
                                    <div id="div_surname" class="form-group ">
                                        <label for="surname" class="control-label col-lg-2">Surname</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="surname" name="surname" type="surname" />
                                        </div>
                                    </div>
                                    <div id="div_password" class="form-group has-warning">
                                        <label for="password" class="control-label col-lg-2">Password</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="password" name="password" type="password"
                                                pattern="^.*(?=.{8,12})(?=.*\d)(?=.*[A-Z]{1,})(?=.*[a-z]{1,})(?=.*[~!#$\(\)]).*$" />
                                            <p class="help-block" id="help_password"></p>
                                        </div>
                                    </div>
                                    <div id="div_confirm_password" class="form-group has-warning">
                                        <label for="confirm_password" class="control-label col-lg-2">Confirm
                                            Password</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="confirm_password" name="confirm_password"
                                                type="password" required />
                                            <p class="help-block" id="help_confirm_password"></p>
                                        </div>
                                    </div>
                                    <div id="div_email" class="form-group ">
                                        <label for="email" class="control-label col-lg-2">Email</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="email" name="email" type="email"
                                                required />
                                        </div>
                                    </div>
                                    <div id="div_mobile" class="form-group ">
                                        <label for="mobile" class="control-label col-lg-2">Mobile</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="mobile" name="mobile" type="text"
                                                required />
                                        </div>
                                    </div>
                                    <div id="div_gender" class="form-group ">
                                        <label for="mobile" class="control-label col-lg-2">Gender</label>
                                        <div class="col-lg-6">
                                            <label>
                                                <input class="radio-inline" type="radio" name="gender" id="gender"
                                                    value="male"> Male
                                                <input class="radio-inline" type="radio" name="gender" id="gender"
                                                    value="female"> Female
                                                <input class="radio-inline" type="radio" name="gender" id="gender"
                                                    value="other" checked> Other
                                            </label>
                                        </div>
                                    </div>
                                    <div id="div_type" class="form-group ">
                                        <label for="type" class="control-label col-lg-2">Account Type</label>
                                        <div class="col-lg-6">
                                            <select name="type" id="" class="form-control">
                                                <option value="1">SAVING</option>
                                                <option value="2">BUSINESS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="div_policy" class="form-group ">
                                        <label for="agree" class="control-label col-lg-2 col-sm-3">Agree to Our
                                            Policy</label>
                                        <div class="col-lg-6 col-sm-9">
                                            <input type="checkbox" style="width: 20px" class="checkbox form-control"
                                                id="agree" name="agree" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-6">
                                            <button class="btn btn-theme" type="submit">submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /form-panel -->
                    </div>
                    <!-- /col-lg-12 -->
                </div>
                <!-- /row -->
            </section>
            <!-- /wrapper -->
        </section>
        <!--main content end-->
        <!--footer start-->
        <footer id="footer" class="site-footer"> </footer>
        <!--footer end-->
    </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script>
    $(function() {
        // $("#side").load("../html/aside.html");
        $("#header").load("../html/header.html");
        $("#footer").load("../html/footer.html");
        // $("#username").get(0).setCustomValidity("please input 3~28 characters");
        // ajax
        $("#password").focusout(function() {
            $.get("lib/validation.php", {
                    password: this.value
                })
                .done(function(data) {
                    $("#div_password").removeClass("has-error");
                    $("#div_password").removeClass("has-success");
                    $("#div_password").removeClass("has-warning");
                    if (data == "correct!") {
                        $("#div_password").addClass("has-success");
                    } else {
                        $("#div_password").addClass("has-error");
                    }
                    $("#help_password").html(data);
                });
        });

        $("#confirm_password").focusout(function() {
            $("#div_confirm_password").removeClass("has-error");
            $("#div_confirm_password").removeClass("has-success");
            $("#div_confirm_password").removeClass("has-warning");
            var p1 = $("#password").val();
            var p2 = $("#confirm_password").val();
            if ($("#confirm_password").val() == $("#password").val()) {
                $("#div_confirm_password").addClass("has-success");
                $("#help_confirm_password").html("correct!");
            } else {
                $("#div_confirm_password").addClass("has-error");
                $("#help_confirm_password").html("It does not match witch password!");
            }

        });

    });

    function validate_normal(thisname, divname) {
        var content = $(thisname).val();
        if (content.length < 4) {
            $(divname).removeClass("has-success");
            $(divname).addClass("has-error");
            $(thisname).focus();
        } else {
            $(divname).removeClass("has-error");
            $(divname).addClass("has-success");
        }
    }

    function validate() {
        if ($("#password").val() != $("#confirm_password").val()) {
            alert("confirm password is not the same with password");
            return false;
        } else if ($("#agree").prop('checked') != true) {
            alert("need to agree policy");
            return false;
        }
    }
    </script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>