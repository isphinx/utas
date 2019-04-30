<?php
//use session
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Captcha</title>
</head>
<body>
<?php
//check whether the submit button is clicked from the HTML form
if(isset($_POST['submit']))
{
   //if the word in the captcha image and the submitted word (user-submitted from the form) are NOT matched
   if($_SESSION['captcha']!=$_POST['captcha']) {
   		//define result message as incorrect (we will print out this message as below) 
        $result_message = "Incorrect";
    } else {
    	//define result message as correct (we will print out this message as below) 
        $result_message = "Correct";
    }
 ?>
	<!-- show result message-->
	<h2><?php echo $result_message; ?></h2>
	<ul>
		<li>Session CAPTCHA:<?php echo $_SESSION['captcha']; ?></li>
		<li>Form CAPTCHA:<?php echo $_POST['captcha']; ?></li>
	</ul>
<?php
	//after checking, destroy the session.
   session_destroy();
}//closing tag for if statement
?>

<!-- form for typing the word in the  captcha image-->
<h1>Submit the word in the image</h1>

<form method="POST">
	<!--image - created by using captcha.php-->
	<img src="captcha.php" id="captcha" /><br>
	<!--textfield for typing the word in the captcha image-->
	<input type="text" name="captcha" id="captcha-form" autocomplete="off" /><br/>
	<input type="submit" name="submit" value="submit" />
</form>
</body>
</html>
