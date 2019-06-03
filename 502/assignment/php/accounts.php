<!DOCTYPE html>
<html>
<?php include "lib/online_check.php";?>
<?php
require "lib/mysql_conn.php";

if (isset($_GET['applycredit'])) {
    $id = $_GET['id'];
    $amount = ($_GET['type'] == 1) ? 50 : 100;

    $sql = "UPDATE xinbank_account SET credit=$amount, currency=currency-$amount WHERE id=$id and currency>=$amount";
    // echo $sql;
    if ($mysql->query($sql) !== true || mysqli_affected_rows($mysql) != 1) {
        echo "accounts.php error: $sql == affected:" . mysqli_affected_rows($mysql);
        if (mysqli_affected_rows($mysql) == 0) {
            echo "   insufficient";
        }
    } else {
        $sql = "INSERT INTO xinbank_transactions (FromaccountID, toaccountID, toBSB, type, currency, purpose)
            values ('$id', '', 'Fee of Credit Application', '" . TRANS_CREDIT_PENDING . "', $amount, 'credit apply')";
        if ($mysql->query($sql) !== true) {
            echo "accounts.php error: $sql";
        }
    }
    // echo $mysql->query($sql);
    // echo mysqli_affected_rows($mysql);
}
?>

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
                <h3><i class="fa fa-angle-right"></i> Accounts </h3>
                <div class="col-md-12 mt">
                    <div class="content-panel">
                        <table class="table table-hover">
                            <h4><i class="fa fa-angle-right"></i>
                                <?php echo $_SESSION['username'] . '-' . $_SESSION['userid']; ?></h4>
                            <hr>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Account number</th>
                                    <th>Balance(au$)</th>
                                    <th>credit</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

$userid = $_SESSION['userid'];
$sql = "SELECT * FROM xinbank_account WHERE userID=$userid";
$result = $mysql->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td></td>";
    echo "<td>" . ACCOUNT_TYPES[$row['type']] . "</td>";
    echo "<td>" . $row['BSB'] . '-' . $row['ID'] . "</td>";
    echo "<td>" . $row['currency'] . "</td>";
    echo "<td>" . max(0, $row['credit']) . "</td>";
    if ($row['credit'] == -1) {
        echo "<td><a href=\"accounts.php?applycredit&id=" . $row['ID'] . "&type=" . $row['type'] . "\">";
        echo "<button type=\"button\" class=\"btn btn-theme btn-xs\"><i class=\"fa fa-credit-card\"></i> Apply Credit</button>";
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