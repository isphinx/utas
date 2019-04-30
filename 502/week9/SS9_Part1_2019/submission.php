<?php

//After the user click the submit button from HTML Form in tute4.html, the below code will be executed.

//new mysqli(hostname, username, password, databasename);
//mysqli Represents a connection between PHP and a MySQL database
// $mysqli=new mysqli("localhost","xli65","501186","xli65");
$mysqli = new mysqli("localhost", "test", "123", "utas");

//check if the submit button (in the HTML form) was clicked
if (isset($_POST['submit'])) {
    //retrieve the data from the username tag(HTML form in tute4.html)
    $username = $_POST['username'];
    //retrieve the data from the password tag(HTML form in tute4.html)
    $password = $_POST['password'];

    //printing out the username and password
    echo "You have successfully registered your account <br/>";
    echo "Username:  " . $username . "<br/>";
    echo "Password: " . $password . "<br/>";

    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);

    //insert query - query define. (what do we do? inserting the data to the 'users' table)
    $insertquery = "INSERT INTO `users`(`username`, `password`) VALUES ('$username','$password')";
    //connect to the database by using $mysqli
    //execute query by using query() function
    $mysqli->query($insertquery);
}