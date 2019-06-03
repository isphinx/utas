<!DOCTYPE html>
<html lang="en">

<?php require "lib/online_check.php";?>
<?php
require "lib/mysql_conn.php";

$accountid = $_REQUEST['accountid'];
$peroid = $_GET['peroid'];

$sql = "select * from xinbank_user where id=" . $_SESSION['userid'];
$result = $mysql->query($sql);
if ($result->num_rows == 0) {
    echo "statement error:$sql";
}
$user = $result->fetch_assoc();

$sql = "select * from xinbank_account where id=$accountid";
$result = $mysql->query($sql);
if ($result->num_rows == 0) {
    echo "statement error:$sql";
}
$account = $result->fetch_assoc();

$enddate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('1 day'))->format('Y-m-d');
if ($peroid == 1) {
    $begindate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-1 month'))->format('Y-m-d');
    $begindate2 = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-1 month'))->format('d M Y');
} elseif ($peroid == 2) {
    $begindate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-3 month'))->format('Y-m-d');
    $begindate2 = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-3 month'))->format('d M Y');
} else {
    $begindate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-6 month'))->format('Y-m-d');
    $begindate2 = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-6 month'))->format('d M Y');
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
            <!-- /row -->
            <section class="wrapper site-min-height">
                <!-- <h3><i class="fa fa-angle-right"></i> Bank Statement</h3> -->
                <div class="row ">
                    <!-- /col-md-4 -->
                    <div class="col-md-6 col-md-offset-4 goright profile-text">
                        <br>
                        <h3>XIN SECURITY BANK ADVANTAGE STATEMENT</h3>
                        <h4> <?php echo $begindate2 . " to " . date('d M Y'); ?>
                        </h4>
                    </div>
                    <!-- /col-md-4 -->
                    <div class="col-md-2 goleft">
                        <div class="profile-pic">
                            <p><img src="../img/logo-xin.png" class="img-circle"></p>
                        </div>
                    </div>
                    <!-- /col-md-4 -->
                </div>
                <div class="row ">
                    <div class="col-md-3 profile-text centered">
                        <div class="right-divider hidden-sm hidden-xs">
                            <h4><?php echo $user['username']; ?></h4>
                            <h6>USERNAME</h6>
                            <h4>Mr <?php echo $user['surname']; ?></h4>
                            <h6>GIVENAME</h6>
                            <h4><?php echo $user['firstname']; ?></h4>
                            <h6>SURNAME</h6>
                        </div>
                    </div>
                    <div class="col-md-3 profile-text centered">
                        <div class="right-divider hidden-sm hidden-xs">
                            <h4>181-818</h4>
                            <h6>Branch Number (BSB)</h6>
                            <h4><?php echo substr_replace($account['ID'], '-', 3, 0); ?></h4>
                            <h6>Account Number</h6>
                            <h4><?php echo $user['mobile']; ?></h4>
                            <h6>Mobile</h6>
                        </div>
                    </div>
                    <div class="col-md-3 profile-text centered">
                        <div class="right-divider hidden-sm hidden-xs">
                            <h4><?php echo $user['email']; ?></h4>
                            <h6>Email</h6>
                            <h4><?php echo $user['gender']; ?></h4>
                            <h6>Gender</h6>
                            <h4><?php echo $user['createTime']; ?></h4>
                            <h6>Create Time</h6>
                        </div>
                    </div>
                    <div class="col-md-3 centered">
                        <div class="col-sm-6">
                            <h1><i class="fa fa-money"></i></h1>
                            <h3>$<?php echo $account['currency']; ?></h3>
                            <h6>BALANCE</h6>
                        </div>
                        <div class="col-sm-6">
                            <h1><i class="fa fa-trophy"></i></h1>
                            <h3>50</h3>
                            <h6>CREDITS</h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <h4><i class="fa fa-angle-right"></i> Transactions Details</h4>
                        <section id="unseen">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Date</th>
                                        <th>Transactions Detail</th>
                                        <th>Withdrawals ($)</th>
                                        <th>Deposits ($)</th>
                                        <th>Purpose</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
// print_r($_GET);
if (isset($_GET['submit'])) {
    $accountid = $_GET['accountid'];
    $sql = "SELECT * FROM xinbank_transactions WHERE (FromaccountID='$accountid' OR toaccountID='$accountid')
            AND transferTime<'$enddate' AND transferTime>'$begindate'";
    $result = $mysql->query($sql);
    $totalwithdrawal = 0;
    $totaldeposits = 0;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['transferTime'] . "</td>";
        echo "<td>(" . TRANSACTION_TYPES[$row['type']] . ") ";
        $amount = number_format($row['currency']);
        if ($row['FromaccountID'] == $accountid) {
            $totalwithdrawal += $row['currency'];
            echo "transfer to " . $row['toBSB'] . "-" . $row['toaccountID'] . " with " . $amount . "</td>";
            echo "<td>" . $amount . "</td></td><td>";
        } elseif ($row['toaccountID'] == $accountid) {
            $totaldeposits += $row['currency'];
            echo "received from" . $row['FromBSB'] . "-" . $row['FromaccountID'] . " with " . $amount . "</td>";
            echo "<td></td><td>" . $amount . "</td>";
        }
        echo "<td>" . $row['purpose'] . "</td>";
        echo "<td>" . $row['currency'] . '-' . $row['currencytype'] . "</td>";

        echo "</tr>";
    }
}
?>
                                </tbody>
                                <tfoot>
                                    <td><b> TOTALS AT END</b></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>$<?php echo number_format($totalwithdrawal); ?></b></td>
                                    <td><b>$<?php echo number_format($totaldeposits); ?></b></td>
                                    <td></td>
                                    <td></td>
                                </tfoot>
                            </table>
                        </section>
                    </div>
                </div>
                <!-- /row -->
                <!-- /container -->
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
            $("#menu_eStatement").addClass("active");
        });
        $("#footer").load("../html/footer.html");
    });
    </script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>