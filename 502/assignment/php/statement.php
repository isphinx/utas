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
                <h3><i class="fa fa-angle-right"></i> Bank Statement</h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <div class="class">
                                <form class="cmxform form-horizontal style-form" method="get"
                                    action="statementPage.php">
                                    <div id="div_from" class="form-group ">
                                        <div class="col-lg-6">
                                            <select name="accountid" id="accountid" class="form-control">
                                                <?php Display_Account($mysql, $_SESSION['userid'])?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="div_peroid" class="form-group ">
                                        <div class="col-lg-6">
                                            <select name="peroid" id="peroid" class="form-control">
                                                <option value="1">one months</option>
                                                <option value="2">three months</option>
                                                <option value="3">six months</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10">
                                            <button class="btn btn-theme" name="submit" type="submit">confirm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
            $("#menu_eStatement").addClass("active");
        });
        $("#footer").load("../html/footer.html");
    });
    </script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>