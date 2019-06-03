<aside>
<div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
        <p class="centered"><a href="#"><img src="../img/ui-xin.jpg" class="img-circle" width="80"></a></p>
        <h5 class="centered">Welcome <?php echo (isset($_SESSION['username'])) ? $_SESSION['username'] : "guest"; ?>
        </h5>
        <p class="centered">last login: <?php echo (isset($_SESSION['lasttime'])) ? $_SESSION['lasttime'] : ""; ?></p>

        <?php
if (!isset($_SESSION['usertype'])) {

} elseif ($_SESSION['usertype'] == USER_NORMAL) {
    echo '
        <li class="sub-menu">
            <a id="menu_accounts" href="accounts.php">
                <i class="fa fa-user"></i>
                <span>Account</span>
            </a>
        </li>
        <li class="sub-menu">
            <a id="menu_Transactions" href="transactions.php">
                <i class="fa fa-list"></i>
                <span>Transactions</span>
            </a>
        </li>
        <li class="sub-menu">
            <a id="menu_eStatement" href="statement.php">
                <i class="fa fa-list-alt"></i>
                <span>eStatements </span>
            </a>
        </li>
        <li class="sub-menu">
            <a id="menu_TransferPay" href="transfer.php">
                <i class="fa fa-refresh"></i>
                <span>Transfer & Pay</span>
            </a>
        </li>
        <li>
            <a id="menu_message" href="message.php">
                <i class="fa fa-envelope"></i>
                <span>Message </span>
                <span class="label label-theme pull-right mail-info">2</span>
            </a>
        </li>
    ';

} else {
    echo '
        <li class="sub-menu">
            <a id="menu_users" href="manageruser.php">
                <i class="fa fa-user"></i>
                <span>Manager User</span>
            </a>
        </li>
        <li class="sub-menu">
            <a id="menu_accounts" href="manageraccount.php">
                <i class="fa fa-user"></i>
                <span>Manager Account</span>
            </a>
        </li>
        <li class="sub-menu">
            <a id="menu_Transactions" href="transactions.php">
                <i class="fa fa-list"></i>
                <span>Transactions</span>
            </a>
        </li>
        <li class="sub-menu">
            <a id="menu_Approval" href="approval.php">
                <i class="fa fa-list"></i>
                <span>Approval</span>
            </a>
        </li>
        ';
}
?>
        <li>
            <a id="menu_video" href="assignment.mp4">
                <i class="fa fa-envelope"></i>
                <span>Video </span>
            </a>
        </li>
    </ul>
    <!-- sidebar menu end-->
</div>
</aside>