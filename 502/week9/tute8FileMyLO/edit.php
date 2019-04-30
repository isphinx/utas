<?php
//database connection
include "db_conn.php";

if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "submit") {
    //setting the error message
    $error = "";
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $url = $_REQUEST['url'];
    $comments = $_REQUEST['comments'];

    //email validation
    if ($email == "") {
        $error .= "* Please type your email address" . "<br>";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        //if the email is not proper in format
        $error .= "* Please type the correct format of email address" . "<br>";
    }

    //comment validation
    if ($comments == "") {
        $error .= "* Please type the comments" . "<br>";
    }

    if ($error == "") {
        //encrypt password
        //Escapes special characters in a string for use in an SQL statement
        $comments = $mysqli->real_escape_string($comments);
        //query for inserting
        $sql = "UPDATE guestbook SET name='$name', email='$email', url='$url', comments='$comments' WHERE id=$id;";
        //execute the insert query
        echo $sql;
        $mysqli->query($sql);
        //automatically go to list.php
        header('location: ./list.php');
    } else {
        echo $error;
    }
} else {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $url = $_REQUEST['url'];
    $comments = $_REQUEST['comments'];
}
?>

<html>

<head>
    <title>Guestbook</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>

    <h1>Guest Book</h1>
    [<a href="list.php">Back to the list</a>]

    <!--form for inserting the comments in the guestbook-->
    <form action="" method="post">

        <table id="form">
            <!--row for name field (required field).-->
            <tr>
                <td class="label">* ID</td>
                <td><input type="text" name="id" value="<?php echo $id; ?>" readonly="true"/></td>
            </tr>

            <!--row for password field (required field). This password is for editing and deleting the comment-->
            <tr>
                <td class="label">* Name</td>
                <td><input name="name" type="name" value="<?php echo $name; ?>"></td>
            </tr>

            <!--row for email field (required field).-->
            <tr>
                <td class="label">* Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>

            <!--row for homepage field (optional field).-->
            <tr>
                <td class="label">Homepage</td>
                <td><input type="text" name="url" value="<?php echo $url; ?>"></td>
            </tr>

            <!--row for comments field (required field).-->
            <tr>
                <td class="label">* Comments</td>
                <td><textarea name="comments" cols="50" rows="10"><?php echo $comments; ?></textarea></td>
            </tr>

            <!--row for submit button.-->
            <tr>
                <td colspan="2" id="submit"><input type="submit" name="submit" value="submit"></td>
            </tr>

            <!--show error message if there is any.-->
            <tr>
                <td colspan="2">
                    <?php
if (isset($error)) {
    echo $error;
} else {
    echo "* Theses fields must be filled <br> ";
}

?></td>
            </tr>
        </table>
    </form>
</body>

</html>