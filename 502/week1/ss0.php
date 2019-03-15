<?php
//put the comment
$author = "lucas";
$dataCreater = "4 March 2019";
?>
<!DOCTYPE html>
<html>

<head>
    <title>My First Web - PHP</title>
</head>

<body>
    <h1>hello world!</h1>
    <ul>
        <li>Author:<?php echo $author; ?></li>
        <li>Data updated:<?php echo $dataCreater; ?></li>
    </ul>

    <?php 
    echo "Hello Wrold"."<br/>";
    echo "This is my first PHP code."."<br><br>";
    echo "KIT502 will be super fun!"."<br><br>";
    echo "Date :".date('Y-m-d');
    ?>
</body>

</html>