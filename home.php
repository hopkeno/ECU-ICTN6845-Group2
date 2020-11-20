<?php 
    include("header.php");
?>
	
	<h2>Volunteers page</h2>
    <main>
    <p>In order to sign up for tasks, you need to register first.</p> 
	<p>Already registered, please click <a href="login.php">here and login</a> to your account.</p>
   
   <form action="add_user.php" method="post" id="login_form">
	   <fieldset>
		   <legend>Registration</legend>
		   <label>First Name:</label>
		   <input type="text" name="first_name" required><br><br>
		   <label>Last Name:</label>
		   <input type="text" name="last_name" required><br><br>
		   <label>E-Mail:</label>
		   <input type="email" name="email" required><br><br>
		   <label>Create Username:</label>
		   <input type="text" name="username" required><br><br>
		   <label>Create Password:</label>
		   <input type="password" name="password" required><br><br>	
		   <label>Verify Password:</label>
		   <input type="password" name="password2" required><br><br>	  
		   <input type="submit"  class="button" value="Register"><br><br>
	   </fieldset>
   </form>
	
</main>
	
<?php include("footer.php"); ?>

