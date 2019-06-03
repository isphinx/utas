<!DOCTYPE html>
<html lang="en">

<?php include "lib/online_check.php";?>
<?php include "lib/mysql_conn.php";?>

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
        <!--header start-->
        <header id="header" class="header black-bg"></header>
        <!--header end-->
        <?php include "lib/aside.php";?>
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <!-- page start-->
                <div class="row mt">
                    <div class="col-sm-9">
                        <section class="panel">
                            <header class="panel-heading wht-bg">
                                <h4 class="gen-case">
                                    Inbox (2)
                                </h4>
                            </header>
                            <div class="panel-body minimal">
                                <div class="mail-option">
                                    <div class="chk-all">
                                        <div class="pull-left mail-checkbox">
                                            <input type="checkbox" class="">
                                        </div>
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" href="#" class="btn mini all">
                                                All
                                            </a>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown"
                                            href="#" class="btn mini tooltips">
                                            <i class=" fa fa-refresh"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group hidden-phone">
                                        <a data-toggle="dropdown" href="#" class="btn mini blue">
                                            Delete
                                        </a>
                                    </div>
                                    <ul class="unstyled inbox-pagination">
                                        <li><span>1-50 of 99</span></li>
                                        <li>
                                            <a class="np-btn" href="#"><i
                                                    class="fa fa-angle-left  pagination-left"></i></a>
                                        </li>
                                        <li>
                                            <a class="np-btn" href="#"><i
                                                    class="fa fa-angle-right pagination-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="table-inbox-wrap ">
                                    <table class="table table-inbox table-hover">
                                        <tbody>
                                            <tr class="unread">
                                                <td class="inbox-small-cells">
                                                    <input type="checkbox" class="mail-checkbox">
                                                </td>
                                                <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                                <td class="view-message  dont-show"><a href="">Xin Bank</a></td>
                                                <td class="view-message "><a href="">Welcome you to join Xin Bank.</a>
                                                </td>
                                                <td class="view-message  inbox-small-cells"><i
                                                        class="fa fa-paperclip"></i></td>
                                                <td class="view-message  text-right">08:10 AM</td>
                                            </tr>
                                            <tr class="unread">
                                                <td class="inbox-small-cells">
                                                    <input type="checkbox" class="mail-checkbox">
                                                </td>
                                                <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                                <td class="view-message dont-show"><a href="">Xin Bank</a></td>
                                                <td class="view-message"><a href="">Guideline of new client.</a></td>
                                                <td class="view-message inbox-small-cells"></td>
                                                <td class="view-message text-right">March 21</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
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
            $("#menu_message").addClass("active");
        });
        $("#footer").load("../html/footer.html");
    });
    </script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>