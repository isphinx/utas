<?php
//database connection
include("db_conn.php");
    
if(isset($_POST['submit'])){
	$name=$_POST['name'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $homepage=$_POST['url'];
    $comments=$_POST['comments'];
    
    //setting the error message
    $error="";
        
    //name validation
    if($name==""){
    	$error.=" Please type your name"."<br>";
    }
    //password validation
    if($password==""){
    	$error.=" Please type the password"."<br>";
    }
    elseif(strlen($password)<6 && strlen($password)>8){
    	//if the password is under 6 and over 8 characters
    	$error.=" The password must be 6-8 characters"."<br>";
    }
    elseif(!preg_match("#[0-9]+#", $password)){
    	//if the password does not include any number
    	$error.="Password must include at least one number!<br>";
	}
 	elseif(!preg_match("#[a-z]+#", $password)){
 		//if the password does not include any letter
		$error.="Password must include at least one letter!<br>";
	}
 	elseif(!preg_match("#[A-Z]+#", $password)){
 		//if the password does not include any uppercase letter
		$error.="Password must include at least one uppercase letter!<br>";
	}
	
	//email validation
	if($email==""){
        $error.=" Please type your email address"."<br>";
	}elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
		//if the email is not proper..(format)
		$error.=" Please type the correct format of email address"."<br>";
    }
    
    //comment validation
    if($comments==""){
    	$error.="Please type the comments"."<br>";
    }
    
    if($error==""){
    	//encrypt password
    	$encrypt_password=MD5($password);
    	//Escapes special characters in a string for use in an SQL statement
    	$comments=$mysqli->real_escape_string($comments);
    	//query for inserting
    	$insertquery="INSERT INTO `guestbook`(`name`, `password`, `email`, `url`, `comments`) VALUES ('$name','$encrypt_password','$email','$homepage','$comments')";
    	//execute the insert query
    	$mysqli->query($insertquery);
    	//automatically go to list.php
        header('location: ./list.php');
    }
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
   			<td class="label">* Name</td>
      		<td><input type="text" name="name"/></td>
      	</tr>
      	
		<!--row for password field (required field). This password is for editing and deleting the comment-->
		<tr>
			<td class="label">* Password</td>
			<td><input name="password" type="password"></td>
		</tr>
	
		<!--row for email field (required field).-->
		<tr>
			<td class="label">* Email</td>
      		<td><input type="text" name="email"></td>
   		</tr>
   		
   		<!--row for homepage field (optional field).-->
   		<tr>
   			<td class="label">Homepage</td>
      		<td><input type="text" name="url"></td>
   		</tr>
   		
   		<!--row for comments field (required field).-->   
   		<tr>
	   		<td class="label">* Comments</td>
    	  	<td><textarea name="comments" cols="50" rows="10"></textarea></td>
   		</tr>
    	
    	<!--row for submit button.-->
    	<tr>
        	<td colspan="2" id="submit"><input type="submit" name="submit" value="Submit"></td>
    	</tr>
    	
    	<!--show error message if there is any.-->
    	<tr>
    		<td colspan="2"><?php echo $error; ?></td>
    	</tr>
	</table>
	</form>
</body>
</html>