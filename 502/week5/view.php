<html>

<head>

</head>

<body>

    <?php
require "../mysql_conn.php";
echo 'connect successfully<br>';

$sql = "select * from users";

$result = $mysql->query($sql);
echo "record_num: $result->num_rows<br>";
if ($result->num_rows > 0) {
    echo "<table><tr></tr>";
    echo " <table>
<th>ID</th> <th>username</th> <th>password</th> <th>mobile</th> <th>email</th> <th>gender</th> ";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["mobile"] . "</td>";
        echo "<td>" . $row["gender"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "empty table";
}
$mysql->close();

?>
</body>

</html>