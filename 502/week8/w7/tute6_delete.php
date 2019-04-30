<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>

    <center>
        <h2>Delete Book Details</h2>
    </center>
    <?php
include 'db_conn.php'; //db connection

$sql = "select * from KIT502_classics";

$result = $mysqli->query($sql);
// echo "record_num: $result->num_rows<br>";
if ($result->num_rows > 0) {
    echo "<table><tr></tr>";
    echo " <table>
<th>ID</th> <th>AUTHOR</th> <th>TITLE</th> <th>TYPE</th> <th>YEAR</th>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["Author"] . "</td>";
        echo "<td>" . $row["Title"] . "</td>";
        echo "<td>" . $row["Type"] . "</td>";
        echo "<td>" . $row["Year"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "empty table";
}

// insert function
if (isset($_REQUEST['id'])) {
    // print_r($_REQUEST);
    $id = $_REQUEST['id'];

    $sql = "DELETE FROM KIT502_classics WHERE id='$id'";
    // echo $sql;

    if ($mysqli->query($sql) === true) {
        // echo "New record created successfully";
        header("Location: tute6_delete.php");
        exit;
    } else {
        // echo "Error: $sql <br>  $mysql->error";
        // return false;
        // header("Location: login.php");
        echo "register error! ==> $sql";
    }
}

$mysqli->close();
?>

<form action="tute6_delete.php" method="get">
    <label for="">ID: </label>
    <input type="text" id="id" name='id'>
    <br>
    <input type="submit" value="delete">
    <input type="reset" value="reset">
    <br>
    <button type="button" onclick="window.location.href='tute6_main.php'">back to main</button>
</form>

</body>

</html>