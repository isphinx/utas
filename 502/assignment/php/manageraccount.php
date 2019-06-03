<!DOCTYPE html>
<html>
<?php include "lib/online_check.php";?>

<head>
    <?php
require "lib/mysql_conn.php";
// print_r($_GET);
if (isset($_GET['addaccount'])) {
    $userid = $_GET['id'];
    $accountType = $_GET['type'];
    $balance = $_GET['balance'];
    $sql = "INSERT INTO xinbank_account (userID, type, currency)
            VALUES ($userid, $accountType, $balance);";
    // echo $sql;
    $mysql->query($sql);
} elseif (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM xinbank_account where id=$id;";
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
                <!-- /row -->
                <div class="row">
                    <div class="col-md-12 mt">
                        <div class="content-panel">
                            <table class="table table-hover">
                                <h4><i class="fa fa-angle-right"></i>ACCOUNTS</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>userID</th>
                                        <th>BSB</th>
                                        <th>type</th>
                                        <th>balance</th>
                                        <th>credit</th>
                                        <th>createTime</th>
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
}

$sql = "SELECT * FROM xinbank_account";
$result = $mysql->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['userID'] . "</td>";
    echo "<td>" . $row['BSB'] . "</td>";
    echo "<td>" . ACCOUNT_TYPES[$row['type']] . "</td>";
    echo "<td>" . $row['currency'] . "</td>";
    echo "<td>" . $row['credit'] . "</td>";
    echo "<td>" . $row['createTime'] . "</td>";
    echo "<td><a href=\"manageraccount.php?delete&id=" . $row['ID'] . "\">";
    echo "<button type=\"button\" class=\"btn btn-theme04 btn-xs\"><i class=\"fa fa-minus\"></i> Delete</button>";
    echo "</a></td>";
    echo "</tr>";
}
?>
                                    <tr>
                                        <td>#</td>
                                        <form action="manageraccount.php" method="get">
                                            <td>
                                                <select name="id" class="form-control">
                                                    <?php foreach ($userids as $k => $y) {echo "<option value=\"$y\">$y</option>";}?>
                                                </select>
                                            </td>
                                            <td>181818</td>
                                            <td>
                                                <select name="type" class="form-control">
                                                    <option value="1">saving</option>
                                                    <option value="2">business</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="balance" class="form-control">
                                                    <option value="1000000">1000000</option>
                                                    <option value="100000000">100000000</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button name="addaccount" type="submit" class="btn btn-theme btn-sm">
                                                    <i class="fa fa-plus"></i> Create</button>
                                            </td>
                                        </form>
                                    </tr>
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
            $("#menu_accounts").addClass("active");
        });
        $("#footer").load("../html/footer.html");
    });
    </script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>