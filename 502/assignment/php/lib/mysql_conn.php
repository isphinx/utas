<?php
//$mysql = new mysqli('localhost', 'xli65', '501186', 'xli65');
$mysql = new mysqli('localhost', 'test', '123', 'utas');

//check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

define('USER_TYPES', ['', 'normal', 'manager', 'root']);
define('ACCOUNT_TYPES', ['', 'saving account', 'business account']);
define('TRANSFER_LIMITS', [0, 10000, 50000]);
define('TRANSACTION_TYPES', ['',
    "TRANS_INTER",
    "TRANS_INTRA",
    "TRANS_BILL",
    "TRANS_INTER_APPROVAL",
    "TRANS_INTRA_APPROVAL",
    "TRANS_BILL_APPROVAL",
    "TRANS_CREDIT_APPROVAL",
    "TRANS_INTER_PENDING",
    "TRANS_INTRA_PENDING",
    "TRANS_BILL_PENDING",
    "TRANS_CREDIT_PENDING",
]);

define("TABLE_USER", "xinbank_user");
define("TABLE_ACCOUNT", "xinbank_account");
define("TABLE_TRANSACTIONS", "xinbank_transcations");
define("TABLE_MESSAGES", "xinbank_messages");

define("TRANS_INTER", 1);
define("TRANS_INTRA", 2);
define("TRANS_BILL", 3);
define("TRANS_INTER_APPROVAL", 4);
define("TRANS_INTRA_APPROVAL", 5);
define("TRANS_BILL_APPROVAL", 6);
define("TRANS_CREDIT_APPROVAL", 7);
define("TRANS_INTER_PENDING", 8);
define("TRANS_INTRA_PENDING", 9);
define("TRANS_BILL_PENDING", 10);
define("TRANS_CREDIT_PENDING", 11);

define("ACCOUNT_SAVING", 1);
define("ACCOUNT_BUSINESS", 2);

define("USER_NORMAL", 1);
define("USER_MANAGE", 2);
define("USER_ROOT", 3);

define("LIMIT_DAY_BUSINESS", 50000);
define("LIMIT_DAY_SAVING", 10000);
define("LIMIT_APPROVE", 25000);

function Get_Balance_By_Accountid($mysql, $accountid, &$usertype)
{
    $sql = "SELECT * FROM xinbank_account WHERE ID=$accountid";
    $result = $mysql->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usertype = $row['type'];
        return $row['currency'];
    } else {
        echo "Get_Balance_By_Accountid - error account ID - $accountid";
    }
    return 0;
}

function Check_Accountid($mysql, $accountid)
{
    $sql = "SELECT * FROM xinbank_account WHERE ID=$accountid";
    $result = $mysql->query($sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        echo "Check_Accountid - error account ID - $accountid";
        return false;
    }
}

function Intra_Transfer($mysql, $fromaccount, $toaccount, $tobsb, $type, $purpose, $amount, $currency)
{
    $sql = "UPDATE xinbank_account SET currency=currency-$amount WHERE ID=$fromaccount";
    if ($mysql->query($sql) !== true) {
        echo "Intra_Transfer deduce error: $sql";
        return false;
    }
    if ($amount > LIMIT_APPROVE) {
        $type += 7;
    } else {
        $sql = "UPDATE xinbank_account SET currency=currency+$amount WHERE ID=$toaccount";
        if ($mysql->query($sql) !== true) {
            echo "Intra_Transfer increase error: $sql";
            return false;
        }
    }
    $sql = "INSERT INTO xinbank_transactions (FromaccountID, toaccountID, toBSB, type, purpose, currency, currencytype)
            values ('$fromaccount', '$toaccount', '$tobsb', $type, '$purpose', $amount,'$currency')";
    if ($mysql->query($sql) !== true) {
        echo "Intra_Transfer transactions error: $sql";
        return false;
    }
    return true;
}

function Inter_Transfer($mysql, $fromaccount, $toaccount, $tobsb, $type, $purpose, $amount, $currency)
{
    $sql = "UPDATE xinbank_account SET currency=currency-$amount WHERE ID=$fromaccount";
    if ($mysql->query($sql) !== true) {
        echo "Inter_Transfer deduce error: $sql";
        return false;
    }
    if ($amount > LIMIT_APPROVE) {
        $type += 7;
    }
    $sql = "INSERT INTO xinbank_transactions (FromaccountID, toaccountID, toBSB, type, purpose, currency, currencytype)
            values ('$fromaccount', '$toaccount', '$tobsb', $type, '$purpose', $amount,'$currency')";
    if ($mysql->query($sql) !== true) {
        echo "Inter_Transfer transactions error: $sql";
        return false;
    }
    return true;
}

function Display_Account($mysql, $userid)
{
    if ($_SESSION['usertype'] == USER_NORMAL) {
        $sql = "SELECT * FROM xinbank_account WHERE userID=$userid";
    } else {
        $sql = "SELECT * FROM xinbank_account";
    }

    // echo $sql;
    $result = $mysql->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['ID'];
        $type = ACCOUNT_TYPES[$row['type']];
        echo "<option value=\"$id\">$id - $type</option>";
    }
}

function Get_Transfer_Accumulation($mysql, $accountid)
{
    $enddate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('1 day'))->format('Y-m-d');
    $begindate = (new DateTime('NOW', timezone_open('Australia/Hobart')))->add(DateInterval::createFromDateString('-1 day'))->format('Y-m-d');

    $sql = "SELECT * FROM xinbank_transactions WHERE FromaccountID='$accountid'
            AND transferTime<'$enddate' AND transferTime>'$begindate'";
    // echo $sql;
    $result = $mysql->query($sql);
    $sum = 0;
    while ($row = $result->fetch_assoc()) {
        $sum += $row['currency'];
    }
    return $sum;
}