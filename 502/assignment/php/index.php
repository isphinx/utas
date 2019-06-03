<!DOCTYPE html>
<html lang="en">

<?php session_start();?>
<?php require "lib/mysql_conn.php";?>

<head>
    <meta charset="utf-8">
    <title>XIN BANK</title>

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
        <!--header start-->
        <header id="header" class="header black-bg"> </header>
        <!--header end-->
        <!--sidebar start-->
        <?php include "lib/aside.php";?>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <div class="row mt mb">
                    <div class="col-lg-12">
                        <h3><i class="fa fa-angle-right"></i> INFORMATION</h3>
                        <br>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="dmbox">
                                <div class="service-icon">
                                    <a class="" href=""><i class="dm-icon fa fa-bitcoin fa-3x"></i></a>
                                </div>
                                <h4>1. Xin Bank-History</h4>
                                <p>hello world!!!</p>
                            </div>
                        </div>
                        <!-- end dmbox -->
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="dmbox">
                                <div class="service-icon">
                                    <a class="" href=""><i class="dm-icon fa fa-pagelines fa-3x"></i></a>
                                </div>
                                <h4>2. Xin Services</h4>
                                <p>service1 service2 service3 service4 service5 service5 service6 service7 service8
                                    service9
                                </p>
                            </div>
                        </div>
                        <!-- end dmbox -->
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="dmbox">
                                <div class="service-icon">
                                    <a class="" href=""><i class="dm-icon fa fa-question fa-3x"></i></a>
                                </div>
                                <h4>3. about</h4>
                                <p>test 1 2 3 test 1 2 3 test 1 2 3 test 1 2 3 test 1 2 3 test 1 2 3 test 1 2 3 test 1 2
                                    3
                                </p>
                            </div>
                        </div>
                        <!-- end dmbox -->
                    </div>
                    <!--  /col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row content-panel">
                    <h2 class="centered">Most Asked Questions</h2>
                    <div class="col-md-10 col-md-offset-1 mt mb">
                        <div class="accordion" id="accordion2">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                        href="faq.html#collapseOne">
                                        <em class="glyphicon glyphicon-chevron-right icon-fixed-width"></em>How to apply
                                        for Xin bank?
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                        <p>need money! need more money!! need a lot money!!! need a great amount of
                                            money!!!!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                        href="faq.html#collapseThree">
                                        <em class="glyphicon glyphicon-chevron-right icon-fixed-width"></em>How to
                                        change color schemes?
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                        <p>need money! need more money!! need a lot money!!! need a great amount of
                                            money!!!!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                        href="faq.html#collapseFive">
                                        <em class="glyphicon glyphicon-chevron-right icon-fixed-width"></em>How Can I
                                        get Support?
                                    </a>
                                </div>
                                <div id="collapseFive" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                        <p>need money! need more money!! need a lot money!!! need a great amount of
                                            money!!!!
                                            ;:c </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion -->
                    </div>
                    <!-- col-md-10 -->
                </div>
                <!--  /row -->
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
    <script src="../lib/jquery.nicescroll.js"></script>
    <script src="../lib/common-scripts.js"></script>
    <script>
    $(function() {
        $("#header").load("../html/header.html", null, function() {
            <?php
if (!isset($_SESSION['userid'])) {
    echo '$("#alogin").show();';
    echo '$("#alogout").hide();';

} else {
    echo '$("#alogout").show();';
    echo '$("#alogin").hide();';
}
?>
        });
        $("#footer").load("../html/footer.html");
    });
    </script>

</body>

</html>