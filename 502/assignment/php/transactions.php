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
                <h3><i class="fa fa-angle-right"></i> Transactions</h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="content-panel">
                            <form class="cmxform form-horizontal style-form" method="get" action="transactions.php">
                                <div class="col-lg-12">
                                    <div id="div_account" class="form-group ">
                                        <div class="col-lg-6">
                                            <select name="accountid" id="accountid" class="form-control">
                                                <?php Display_Account($mysql, $_SESSION['userid'])?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="div_peroid" class="form-group ">
                                        <div class="col-lg-6">
                                            <select name="peroid" id="peroid" class="form-control">
                                                <option value="1">one day</option>
                                                <option value="2">one week</option>
                                                <option value="3">one month</option>
                                                <option value="4">last three months</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10">
                                            <button class="btn btn-theme" name="submit" type="submit">confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <h4><i class="fa fa-angle-right"></i> Transactions</h4>
                            <section id="unseen">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Transactions Detail</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
// print_r($_GET);
if (isset($_GET['submit'])) {
    $accountid = $_GET['accountid'];
    $peroid = $_GET['peroid'];

    // echo Get_Transfer_Accumulation($mysql, $accountid);

    // echo (new DateTime('NOW'))->add(new DateInterval('P1D'))->format('Y-m-d');
    // echo (new DateTime('NOW'))->add(DateInterval::createFromDateString('-1 month'))->format('Y-m-d');
    // echo (new DateTime('NOW'))->add(DateInterval::createFromDateString('-2 month'))->format('Y-m-d');
    // echo (new DateTime('NOW'))->add(DateInterval::createFromDateString('-3 month'))->format('Y-m-d');
    // echo (new DateTime('NOW'))->add(DateInterval::createFromDateString('-6 month'))->format('Y-m-d');
    $enddate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('1 day'))->format('Y-m-d');
    if ($peroid == 1) {
        $begindate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-1 day'))->format('Y-m-d');
    } elseif ($peroid == 2) {
        $begindate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-1 month'))->format('Y-m-d');
    } elseif ($peroid == 3) {
        $begindate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-1 month'))->format('Y-m-d');
    } else {
        $begindate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-3 month'))->format('Y-m-d');
    }
    $sql = "SELECT * FROM xinbank_transactions WHERE (FromaccountID='$accountid' OR toaccountID='$accountid')
            AND transferTime<'$enddate' AND transferTime>'$begindate'";
    // echo $sql;
    $result = $mysql->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['transferTime'] . "</td>";
        echo "<td>(" . TRANSACTION_TYPES[$row['type']] . ") ";
        if ($row['FromaccountID'] == $accountid) {
            echo "transfer to " . $row['toBSB'] . "-" . $row['toaccountID'] . " with " . $row['currency'] . '-' . $row['currencytype'] . "</td>";
            echo "<td><span style=\"color:red\">-</span>" . $row['currency'] . '-' . $row['currencytype'] . "</td>";
        } elseif ($row['toaccountID'] == $accountid) {
            echo "received from" . $row['FromBSB'] . "-" . $row['FromaccountID'] . " with " . $row['currency'] . '-' . $row['currencytype'] . "</td>";
            echo "<td><span style=\"color:green\">+</span>" . $row['currency'] . '-' . $row['currencytype'] . "</td>";
        }
        echo "</tr>";
    }
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
            $("#menu_Transactions").addClass("active");
        });
        $("#footer").load("../html/footer.html");
    });
    </script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>