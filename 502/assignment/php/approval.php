<!DOCTYPE html>
<html lang="en">

<?php require "lib/online_check.php";?>
<?php require "lib/mysql_conn.php";?>

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
    <link href="../css/table-responsive.css" rel="stylesheet">

</head>

<body>
    <section id="container">
        <!--header start-->
        <header id="header" class="header black-bg"> </header>
        <!--header end-->
        <?php include "lib/aside.php";?>
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> APPROVAL</h3>
                <div class="row mt">
                    <div class="col-lg-12">


                        <div class="content-panel">

                            <h4><i class="fa fa-angle-right"></i> Transactions for being approved</h4>

                            <section id="unseen">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Transactions Detail</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
// print_r($_GET);
if (isset($_GET['approval'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM xinbank_transactions WHERE id=$id";
    $result = $mysql->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['type'] == TRANS_INTRA_PENDING) {
            $sql = "UPDATE xinbank_account SET currency=currency+" . $row['currency'] . " WHERE id=" . $row['toaccountID'];
            if ($mysql->query($sql) !== true) {
                echo "approval.php error: $sql";
            }
        }
        $sql = "UPDATE xinbank_transactions SET type=type-4 WHERE id=$id";
        if ($mysql->query($sql) !== true) {
            echo "approval.php error: $sql";
        }
    }
}

$sql = "SELECT * FROM xinbank_transactions WHERE type>=" . TRANS_INTER_PENDING;

$result = $mysql->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['transferTime'] . "</td>";
    echo "<td>transfer from " . $row['FromBSB'] . "-" . $row['FromaccountID'] . " to " .
        $row['toBSB'] . "-" . $row['toaccountID'] . " with " . $row['currency'] . "</td>";
    echo "<td>" . $row['currency'] . "</td>";
    echo "<td><a href=\"approval.php?approval&id=" . $row['ID'] . "\">";
    echo "<button type=\"button\" class=\"btn btn-theme btn-xs\"><i class=\"fa fa-angle-double-up\"></i> Approval</button>";
    echo "<td></a>";
    echo "</tr>";
}

?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <!-- /content-panel -->
                    </div>
                    <!-- /col-lg-4 -->
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
    <script src="../lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/jquery.nicescroll.js"></script>
    <script src="../lib/common-scripts.js"></script>
    <script>
    $(function() {
        $("#header").load("../html/header.html", null, function() {
            $("#menu_Approval").addClass("active");
        });
        $("#footer").load("../html/footer.html");
    });
    </script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>