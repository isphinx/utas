<?php
$mysql = new mysqli('localhost', 'test', '123', 'utas');
// print_r($_GET);
if (isset($_GET['check'])) {
    $username = $_GET['username'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    // echo $sql;
    $result = $mysql->query($sql);

    if ($result->num_rows > 0) {
        echo "username exits";
    } else {
        echo "username available";
    }
} elseif (isset($_GET['country'])) {
    $country = $_GET['country'];
    $sql = "SELECT * FROM countries WHERE country='$country'";
    $result = $mysql->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo '<option>';
        echo $row['City'];
        echo '</option>';
    }

} elseif (isset($_GET['cities'])) {
    $cities = $_GET['cities'];
    $sql = "SELECT * FROM countries WHERE City='$cities'";
    // echo $sql;
    $result = $mysql->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo $row['Population'];
    }
}