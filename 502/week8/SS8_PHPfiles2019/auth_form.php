<?php
/* NOTE:this file is related to your tutorial 8. This is not the final version.
You should complete the edit and delete function for this web site by using this*/

//put the code for checking whether user clicked 'edit' or 'delete' button from list.php

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
    	<td colspan="2"> Enter the password to 
    	<?php //put the mode here 
    	?> the comment.</td>
  	</tr>
	<tr> 
		<!-- you should show the ID number of the selected comment in the disabled textfield. Disabled textfield is not clickable-->
      	<td class="details">ID</td>
     	<td><input name="id" value="<?php //put the id of selected comments ?>" disabled /></td>
    </tr>
    <tr>
    	<!--password field for authenticating-->
    	<td class="details">Password</td>
      	<td><input name="password" type="password"></td>
    </tr>
    <tr>
   		<td class="submit" colspan="2">
   			<input type="submit" name="submit" value="Submit">
   			<input type="reset" value="Reset">
      	</td>
    </tr>
</table>
</form>
</body>
</html>