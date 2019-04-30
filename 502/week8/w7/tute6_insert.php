<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>


    <center>
        <h2>Insert Book Details</h2>
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
if (isset($_REQUEST['submit'])) {
    // print_r($_REQUEST);
    $id = $_REQUEST['id'];
    $author = $_REQUEST['author'];
    $title = $_REQUEST['title'];
    $type = $_REQUEST['type'];
    $year = $_REQUEST['year'];

    $sql = "INSERT INTO KIT502_classics (id, Author, Title, Type, Year) VALUES ($id, '$author', '$title', '$type', '$year')";
    // echo $sql;

    if ($mysqli->query($sql) === true) {
        echo "New record created successfully";
        header("Location: tute6_insert.php");
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

    <form action="tute6_insert.php" method="get">
        <lable>ID: </lable>
        <input type="text" id="id" name="id">
        <br>
        <lable>Author: </lable>
        <input type="text" id="author" name="author">
        <br>
        <lable>Title: </lable>
        <input type="text" id="title" name="title">
        <br>
        <lable>Type: </lable>
        <input type="text" id="type" name="type">
        <br>
        <lable>Year: </lable>
        <input type="text" id="year" name="year">
        <br>
        <input type="submit" name="submit" value="insert">
        <input type="reset" value="reset">
        <br>
        <button type="button" onclick="window.location.href='tute6_main.php'">back to main</button>
    </form>

</body>

</html>