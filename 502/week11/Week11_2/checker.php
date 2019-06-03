<?php
	include('db_conn.php');
		
	//get the q parameter from URL
	$username=$_GET["username"];
	
    $result=$mysqli->query("SELECT `username` FROM `users` WHERE `username` LIKE '$username'");
    $result_cnt = $result->num_rows;
	if ($result_cnt!=0) {
		echo "username exists";
	} else {
		echo "username available";		
	}

?> 