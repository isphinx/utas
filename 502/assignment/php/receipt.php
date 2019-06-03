<!DOCTYPE html>
<html>
<?php include "lib/online_check.php";?>

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
include "lib/mysql_conn.php";

if (isset($_REQUEST['submit'])) {
    // print_r($_REQUEST);
    $fromaccount = $_REQUEST['fromaccount'];
    $type = $_REQUEST['type'];
    $tobsb = $_REQUEST['tobsb'];
    $toaccount = $_REQUEST['toaccount'];
    $amount = $_REQUEST['amount'];
    $purpose = $_REQUEST['purpose'];
    $currency = $_REQUEST['currency'];

    $usertype = 0;
    $from_balance = Get_Balance_By_Accountid($mysql, $fromaccount, $usertype);
    $limitperday = TRANSFER_LIMITS[$usertype];

    $Accumulation = Get_Transfer_Accumulation($mysql, $fromaccount);

    if ($Accumulation + $amount > $limitperday) {
        $result = "Your Amount exceeded the limit!($Accumulation+$amount>$limitperday)";
    } elseif ($from_balance >= $amount) {
        if ($type == TRANS_INTRA) {
            if (Check_Accountid($mysql, $toaccount)) {
                $result = Intra_Transfer($mysql, $fromaccount, $toaccount, $tobsb, $type, $purpose, $amount, $currency);
            } else {
                $result = "Account ID: $toaccount is not exist";
            }
        } elseif ($type == TRANS_INTER) {
            $result = Inter_Transfer($mysql, $fromaccount, $toaccount, $tobsb, $type, $purpose, $amount, $currency);
        } elseif ($type == TRANS_BILL) {
            $result = Inter_Transfer($mysql, $fromaccount, $toaccount, $tobsb, $type, $tobsb, $amount, $currency);
        }
    } else {
        $result = "Your balance is insufficient!($amount>$from_balance)";
    }
}
?>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header id="header" class="header black-bg"> </header>
        <!--header end-->
        <!-- MAIN SIDEBAR MENU -->
        <?php include "lib/aside.php";?>
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> Receipt</h3>
                <div class="row mt ">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="showback profile-text centered">
                            <h3>
                                <?php
echo ($result === true) ? '<i class="fa fa-check-circle"></i>Your transfer has been submitted' : '<span style="color:red"><i class="fa fa-times-circle">' . $result . '</i></span>';
?>
                            </h3>
                            <div class="right-divider centered">
                                <br>
                                <h4><?php echo ($result === true) ? $amount : 0; ?></h4>
                                <h6>Amount</h6>
                                <br>
                                <h4><?php echo ($result === true) ? $fromaccount : 0; ?></h4>
                                <h6>From</h6>
                                <br>
                                <h4><?php echo ($result === true) ? $tobsb . $toaccount : 0; ?></h4>
                                <h6>To</h6>
                                <br>
                                <h4><?php echo date('Y-m-d H:m:s', time()); ?></h4>
                                <h6>Time</h6>
                            </div>
                        </div>
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
    <script src="../lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/jquery.nicescroll.js"></script>
    <script src="../lib/common-scripts.js"></script>
    <script>
    $(function() {
        $("#header").load("../html/header.html", null, function() {
            $("#menu_TransferPay").addClass("active");
        });
        $("#footer").load("../html/footer.html");
        // $("#username").get(0).setCustomValidity("please input 3~28 characters");
        $("#stobsb").attr('disabled', "true").hide();
    });
    </script>
</body>

</html>