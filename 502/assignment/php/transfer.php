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

    <?php include "lib/mysql_conn.php";?>

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
                <h3><i class="fa fa-angle-right"></i> Transfer & Pay</h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <div class="form">
                                <form class="cmxform form-horizontal style-form" id="signupForm" method="get"
                                    action="receipt.php">
                                    <div id="div_type" class="form-group ">
                                        <label for=" type" class="control-label col-lg-2"></label>
                                        <div class="col-lg-6">
                                            <select name="type" id="type" class="form-control">
                                                <option value="1">inter-bank</option>
                                                <option value="2">intra-bnak</option>
                                                <option value="3">bill payments</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="div_from" class="form-group ">
                                        <label for="fromaccount" class="control-label col-lg-2">From</label>
                                        <div class="col-lg-6">
                                            <select name="fromaccount" id="fromaccount" class="form-control">
                                                <?php Display_Account($mysql, $_SESSION['userid'])?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="div_bsb" class="form-group ">
                                        <label for="tobsb" class="control-label col-lg-2">To BSB: </label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="itobsb" name="tobsb" type="text"
                                                value="191919" required />

                                            <select name="tobsb" id="stobsb" class="form-control">
                                                <option value="water bill">water bill</option>
                                                <option value="power bill">power bill</option>
                                                <option value="phone bill">phone bill</option>
                                                <option value="NBN bill">NBN bill</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="div_currency" class="form-group ">
                                        <label for="tobsb" class="control-label col-lg-2">Currency: </label>
                                        <div class="col-lg-6">
                                            <select name="currency" id="currency" class="form-control">
                                                <option value="AUD">AUD</option>
                                                <option value="USD">USD</option>
                                                <option value="GBP">GBP</option>
                                                <option value="RMB">RMB</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="div_toaccount" class="form-group ">
                                        <label for="toaccount" class="control-label col-lg-2">To Account
                                            :</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="toaccount" name="toaccount"
                                                type="number" />
                                        </div>
                                    </div>
                                    <div id="div_amount" class="form-group ">
                                        <label for="amount" class="control-label col-lg-2">Amount</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="amount" name="amount" type="number"
                                                step="0.01" required />
                                            <label for="amount" id="exchange"
                                                class="control-label col-lg-2">AUD:</label>
                                        </div>
                                    </div>
                                    <div id="div_purpose" class="form-group ">
                                        <label for="purpose" class="control-label col-lg-2">Purpose</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="purpose" name="purpose" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-theme" name="submit" type="submit">confirm</button>
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
        $("#type").change(function() {
            if (this.value == 1) {
                $("#stobsb").attr('disabled', "true").hide();
                $("#itobsb").removeAttr("disabled").removeAttr('readonly').show().val("191919");
                $("#div_toaccount").show();
                $("#div_purpose").show();
                $("#div_currency").show();
                $("#exchange").show();
            } else if (this.value == 2) {
                $("#stobsb").attr('disabled', "true").hide();
                $("#itobsb").removeAttr("disabled").show().val("181818 (xin bank)").attr('readonly',
                    "true");
                $("#div_toaccount").show();
                $("#div_purpose").show();
                $("#div_currency").show();
                $("#exchange").show();
            } else {
                $("#stobsb").removeAttr("disabled").show();
                $("#itobsb").attr('disabled', "true").hide().removeAttr('readonly');
                $("#div_toaccount").hide();
                $("#div_purpose").hide();
                $("#div_currency").hide();
                $("#exchange").hide();
            }
        });

        $("#amount").change(updateExchange);
        $("#currency").change(updateExchange);
        function updateExchange() {
            if ($("#currency option:selected").val() == "AUD") {
                $("#exchange").html("AUD:" + $("#amount").val() * 1);
            } else if ($("#currency option:selected").val() == "USD") {
                $("#exchange").html("AUD:" + $("#amount").val() * 0.7);
            } else if ($("#currency option:selected").val() == "GBP") {
                $("#exchange").html("AUD:" + $("#amount").val() * 0.5);
            } else if ($("#currency option:selected").val() == "RMB") {
                $("#exchange").html("AUD:" + $("#amount").val() * 4.8);
            }
        };
    });
    </script>
</body>

</html>