<!DOCTYPE html>
<html>
<?php include "lib/online_check.php";?>

<head>
    <?php
require "lib/mysql_conn.php";
// print_r($_GET);
if (isset($_GET['upgrade'])) {
    $userid = $_GET['id'];
    $sql = "UPDATE xinbank_user SET type=2 WHERE ID=$userid";
    // echo $sql;
    $mysql->query($sql);
} elseif (isset($_GET['downgrade'])) {
    $userid = $_GET['id'];
    $sql = "UPDATE xinbank_user SET type=1 WHERE ID=$userid";
    // echo $sql;
    $mysql->query($sql);
}
?>
    <meta charset="utf-8">
    <title>Xin Bank</title>

    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet">
</head>

<body>
    <section id="container">
        <!-- TOP BAR CONTENT & NOTIFICATIONS -->
        <header id="header" class="header black-bg"> </header>
        <!-- MAIN SIDEBAR MENU -->
        <?php include "lib/aside.php";?>
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> MANAGEMENT </h3>
                <div class="row">
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i>USERS</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>username</th>
                                        <th>firstname</th>
                                        <th>surname</th>
                                        <th>type</th>
                                        <th>mobile</th>
                                        <th>email</th>
                                        <th>gender</th>
                                        <th>createTime</th>
                                        <th>lastTime</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$sql = "SELECT * FROM xinbank_user";
$result = $mysql->query($sql);
$userids = array();
while ($row = $result->fetch_assoc()) {
    array_push($userids, $row['ID']);
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['firstname'] . "</td>";
    echo "<td>" . $row['surname'] . "</td>";
    echo "<td>" . USER_TYPES[$row['type']] . "</td>";
    echo "<td>" . $row['mobile'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['createTime'] . "</td>";
    echo "<td>" . $row['lastTime'] . "</td>";
    if ($row['type'] == 1) {
        echo "<td><a href=\"manageruser.php?upgrade&id=" . $row['ID'] . "\">";
        echo "<button type=\"button\" class=\"btn btn-theme btn-xs\"><i class=\"fa fa-angle-double-up\"></i> Upgrade</button>";
        echo "</a></td>";
    } elseif ($row['type'] == 2) {
        echo "<td><a href=\"manageruser.php?downgrade&id=" . $row['ID'] . "\">";
        echo "<button type=\"button\" class=\"btn btn-theme04 btn-xs\"><i class=\"fa fa-angle-double-down\"></i> Downgrade</button>";
        echo "</a></td>";
    }

    echo "</tr>";
}
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /col-md-12 -->
                </div>
                <!-- /row -->
            </section>
        </section>
        <!--main content end-->
        <!--footer start-->
        <footer id="footer" class="site-footer"> </footer>
    </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/jquery.nicescroll.js"></script>
    <script src="../lib/common-scripts.js"></script>
    <script>
    $(function() {
        $("#header").load("../html/header.html", null, function() {
            $("#menu_users").addClass("active");
        });
        $("#footer").load("../html/footer.html");
    });
    </script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>