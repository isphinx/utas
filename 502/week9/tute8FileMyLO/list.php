<?php
//database connection
include "db_conn.php";
?>
<html>

<head>
    <title>Guestbook list</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
    <h1>Guest Book</h1>
    [<a href="form.php">Add Comments</a>]

    <?php
//query for retreiving all the items from the guestbook table (order by the recent items)
$list_query = "SELECT * FROM guestbook ORDER BY ID DESC";
//execute the query 'list_query'
$result = $mysqli->query($list_query);

//covert the above result into array (associative array)
//keys of the array are the column name
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //extract the values
    $id = $row['ID'];
    $name = $row['name'];
    $email = $row['email'];
    $url = $row['url'];
    $comments = $row['comments'];
    $updated_time = $row['updated_time'];

    //printing out with table
    ?>
    <br>
    <table id="list">
        <tr>
            <td class="title">ID</td>
            <td><?php echo $id; ?></td>
            <td class="title">Uploaded Date</td>
            <td><?php echo $updated_time; ?></td>
        </tr>
        <tr>
            <td class="title">Name</td>
            <td><?php echo $name; ?></td>
            <td class="title">Email</td>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <td class="title">Homepage</td>
            <td colspan="3"><?php echo $url; ?></td>
        </tr>
        <tr>
            <td class="title">Comments</td>
            <td colspan="3"><?php echo nl2br($comments); ?></td>
        </tr>
        <tr>
            <!-- the below form is for the editing and deleting comments-->
            <td id="function" colspan="4">
                <form action="auth_form.php" name="authform" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="url" value="<?php echo $url; ?>">
                    <input type="hidden" name="comments" value="<?php echo $comments; ?>">
                    <input type="hidden" name="updated_time" value="<?php echo $updated_time; ?>">
                    <input type="submit" name="init" value="edit">
                    <input type="submit" name="init" value="delete">
                </form>
            </td>
        </tr>
    </table>
    <?php
}
?>
</body>

</html>