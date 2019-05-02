<!DOCTYPE html>
<?php
include "session.php"
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <center>
        <hr>
        <h2>Library Management</h2>
        <hr>
    </center>

    <h3>Welcome <?php echo $_SESSION['username']; ?></h3>
    <a href="logout.php">Logout</a>

    <?php
if (isset($_SESSION['access_type']) && $_SESSION['access_type'] == 2) {
    echo "
    <form action=\"./tute6_insert.php\">
        <input type=\"submit\" value=\"Insert\">
    </form>
    <form action=\"./tute6_update.php\">
        <input type=\"submit\" value=\"Update\">
    </form>
    <form action=\"./tute6_delete.php\">
        <input type=\"submit\" value=\"Delete\">
    </form>
    ";

}
?>
    <form action="./tute6_search.php">
        <input type="submit" value="Search">
    </form>


</body>

</html>