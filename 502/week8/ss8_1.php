<?php

if (isset($_POST['submit'])) {
    //get the value of the comment
    $comment = $_POST['comment'];
}
?>
<html>

<head>
    <title>Self Study 8_1</title>
</head>

<body>

    <h1>POST your Comment</h1>

    <form action="" method="post">
        <input type="text" name="comment" />
        <input type="submit" name="submit" value="Submit" />
    </form>
    <hr />

    <?php
//display the comment
if (isset($comment)) {

    // check
    $comment = trim($comment);
    $comment = strip_tags($comment);
    $comment = htmlspecialchars($comment);
    //

    echo $comment;
}
?>
</body>

</html>