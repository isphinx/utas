<?php
/* NOTE:
You should complete the edit and delete functions for this web site by using this*/

//put the code for checking whether user clicked 'edit' or 'delete' button from list.php
include "session.php";
include "db_conn.php";

// echo "post:";
// print_r($_POST);
// echo "sesson:";
// print_r($_SESSION);
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $url = $_POST["url"];
    $comments = $_POST["comments"];

    $mode = $_POST['submit'];

    if ($_POST['submit'] == 'edit') {
        $sql = "SELECT * FROM guestbook WHERE id=$id AND password='$password'";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {

            $address = "./edit.php?id=$id&name=$name&email=$email&url=$url&comments=$comments&submit=edit";
            header('location: ' . $address);
        } else {
            echo "error password";
        }
    } else if ($_POST['submit'] == 'delete') {
        $sql = "SELECT * FROM guestbook WHERE id=$id AND password='$password'";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $sql = "DELETE FROM guestbook WHERE id=$id";
            //execute the insert query
            // echo $sql;
            $mysqli->query($sql);

            header('location: ./list.php');
        } else {
            echo "error password";
        }
    }
} else if ($_POST['init']) {
    $mode = $_POST['init'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $url = $_POST["url"];
    $comments = $_POST["comments"];
}
?>

<html>

<head>
    <title>Guestbook</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
    <h1>Authentication :</h1>
    [<a href="./list.php">Go Back to list</a>]

    <form action="" method="post">
        <table id="form">
            <tr>
                <!-- you should let the user know which activity (edit or delete) they do-->
                <td colspan="2"> Enter the password to <?php echo $mode; ?> the comment.</td>
            </tr>
            <tr>
                <!-- you should show the ID number of the selected comment in the disabled textfield. Disabled textfield is not clickable-->
                <td class="details">ID</td>
                <td><input name="id" value="<?php echo $_POST['id']; ?>" readonly="true" /></td>
            </tr>
            <tr>
                <!--password field for authenticating-->
                <td class="details">Password</td>
                <td><input name="password" type="password"></td>
            </tr>
            <tr>
                <td class="submit" colspan="2">
                    <?php
echo "<input type=\"hidden\" name=\"name\" value=\"$name\"; ?>";
                    echo "<input type=\"hidden\" name=\"email\" value=\"$email\"; ?>";
                    echo "<input type=\"hidden\" name=\"url\" value=\"$url\"; ?>";
                    echo "<input type=\"hidden\" name=\"comments\" value=\"$comments\"; ?>";
                    ?>
                    <input type="submit" name="submit" value="<?php echo $mode; ?>">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>